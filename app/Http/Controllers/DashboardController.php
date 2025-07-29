<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Helpers\Departments;
use App\Models\CategoryProduct;
use App\Models\EcommerceSaleProduct;
use App\Models\EcommerceSaleProductDetail;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalWebUsers = User::where('user_type', 'web_user')->count();
        $totalProducts = Product::where('status', 1)->count();
        $totalSaleEcommerce = EcommerceSaleProduct::where('status', 'PAID')->count();

        return view('admin.dashboard.home', [
            "totalWebUsers" => $totalWebUsers,
            "totalProducts" => $totalProducts,
            "totalSaleEcommerce" => $totalSaleEcommerce
        ]);
    }


    public function viewSale()
    {
        return view('admin.dashboard.sale');
    }

    public function viewUser()
    {
        return view('admin.dashboard.user');
    }


    public function dataForChartsSales(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $arrayFinal = [];

        $agePercentages = self::getEcommerceSalesByAgePercentiles($startDate, $endDate);
        $departmentPercentages = self::getEcommerceSalesByDepartment($startDate, $endDate);
        $salesByCategory = self::getEcommerceSalesByCategory($startDate, $endDate);
        $salesByProduct = self::getEcommerceSalesByProduct($startDate, $endDate);


        $totalEcommerceSale = EcommerceSaleProduct::whereBetween('created_at', [$startDate, $endDate])->where('status', 'PAID')
            ->sum('total');

        $totalQuantityEcommerceSale = EcommerceSaleProduct::whereBetween('created_at', [$startDate, $endDate])->where('status', 'PAID')
            ->sum('quantity');


        $culqiCommissionPercentage = 3.44 / 100; // 3.44% commission
        $culqiCommissionAmount = $totalEcommerceSale * $culqiCommissionPercentage;

        $totalWithCulqiCommission = number_format($totalEcommerceSale - $culqiCommissionAmount, 2);


        /* $quantityEcommerceSale = DB::table('ecommerce_sale_product_details')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('quantity'); */

        $arrayFinal["age"] = $agePercentages;
        $arrayFinal["department"] = $departmentPercentages;
        $arrayFinal["category"] = $salesByCategory;
        $arrayFinal["product"] = $salesByProduct;
        $arrayFinal["totalEcommerceSales"] = $totalEcommerceSale;
        $arrayFinal["totalWithCulqiCommission"] = $totalWithCulqiCommission;
        $arrayFinal["quantityEcommerceSale"] = $totalQuantityEcommerceSale;

        return ApiResponse::success($arrayFinal, "Consulta exitosa.");
    }

    public function dataForChartsUsers()
    {
        $arrayFinal = [];

        $departmentUsers = self::getUsersByDepartment();
        $salesByUser = self::getEcommerceSalesByUser();


        $totalWebUsers = User::where('user_type', 'web_user')->count();

        $arrayFinal["department"] = $departmentUsers;
        $arrayFinal["salesByUser"] = $salesByUser;
        $arrayFinal["totalWebUsers"] = $totalWebUsers;

        return ApiResponse::success($arrayFinal, "Consulta exitosa.");
    }

    public function getEcommerceSalesByUser()
    {
        $users = User::where('user_type', 'web_user')->get();

        $salesByUser = [];

        foreach ($users as $user) {
            $totalPurchases = 0;
            $totalProductsPurchased = 0;

            // Obtenemos las ventas asociadas al usuario
            $sales = EcommerceSaleProduct::where('user_id', $user->id)
                ->where('status', 'PAID')
                ->get();

            // Sumamos el número de compras y productos comprados
            $totalPurchases = $sales->count();
            $totalProductsPurchased = $sales->sum('quantity'); // Usamos el campo `quantity` para sumar productos comprados

            $salesByUser[] = [
                'full_name' => $user->names . " " . $user->surnames,
                'email' => $user->email,
                'dni' => $user->dni,
                'phone' => $user->phone,
                'department' => $user->department,
                'total_purchases' => $totalPurchases,
                'total_products_purchased' => $totalProductsPurchased,
            ];
        }

        return $salesByUser;
    }

    public static function getUsersByDepartment()
    {
        $departmentsList = Departments::get();

        // Consulta para obtener los usuarios registrados por departamento
        $userData = User::select('department', DB::raw('COUNT(*) as user_count'))
            ->whereIn('department', $departmentsList)
            ->where('user_type', 'web_user')
            ->groupBy('department')
            ->pluck('user_count', 'department')
            ->toArray();

        // Inicializar un array para garantizar que todos los departamentos aparezcan, incluso si no tienen usuarios
        $usersByDepartment = [];
        foreach ($departmentsList as $department) {
            // Asignamos la cantidad de usuarios registrados o 0 si no hay datos
            $usersByDepartment[$department] = $userData[$department] ?? 0;
        }

        return $usersByDepartment;
    }

    public function getEcommerceSalesByProduct($startDate, $endDate)
    {
        // Obtenemos todos los productos
        $products = Product::all();

        // Inicializamos el array para almacenar los resultados
        $salesByProduct = [];

        foreach ($products as $product) {
            // Inicializamos las variables para contar la cantidad de productos vendidos y el total de ventas
            $totalQuantitySold = 0;
            $totalSalesAmount = 0;

            // Obtenemos los detalles de ventas asociados al producto
            $salesDetails = EcommerceSaleProductDetail::whereHas('sale', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
                ->whereHas('productAttribute', function ($query) use ($product) {
                    $query->where('product_id', $product->id);
                })
                ->get();

            // Sumamos las cantidades y los totales
            foreach ($salesDetails as $detail) {
                $totalQuantitySold += $detail->quantity;
                $totalSalesAmount += $detail->subtotal;
            }

            // Almacenamos los resultados por producto si hubo ventas
            $salesByProduct[] = [
                'product' => $product->title,
                'quantity_sold' => number_format($totalQuantitySold, 2),
                'total_sales' => number_format($totalSalesAmount, 2),
            ];
        }

        // Retornamos los resultados
        return $salesByProduct;
    }

    public function getEcommerceSalesByCategory($startDate, $endDate)
    {
        // Obtenemos todas las categorías de productos
        $categories = CategoryProduct::all();

        // Inicializamos el array para almacenar los resultados
        $salesByCategory = [];

        foreach ($categories as $category) {
            // Inicializamos las variables para contar la cantidad de productos vendidos y el total de ventas
            $totalQuantitySold = 0;
            $totalSalesAmount = 0;

            // Obtenemos los productos de la categoría actual
            $products = Product::where('category_product_id', $category->id)
                ->get();

            foreach ($products as $product) {
                // Para cada producto, obtenemos sus detalles de ventas y calculamos la cantidad vendida y el total de ventas
                $salesDetails = EcommerceSaleProductDetail::whereHas('sale', function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                })
                    ->whereHas('productAttribute', function ($query) use ($product) {
                        $query->where('product_id', $product->id);
                    })
                    ->get();

                // Sumamos las cantidades y los totales
                foreach ($salesDetails as $detail) {
                    $totalQuantitySold += $detail->quantity;
                    $totalSalesAmount += $detail->subtotal;
                }
            }

            // Almacenamos los resultados por categoría
            $salesByCategory[] = [
                'category' => $category->description,
                'quantity_sold' => number_format($totalQuantitySold, 2),
                'total_sales' => number_format($totalSalesAmount, 2),
            ];
        }

        // Retornamos los resultados
        return $salesByCategory;
    }

    public static function getEcommerceSalesByAgePercentiles($startDate, $endDate)
    {
        // Obtener los rangos de edad utilizando el método calculatePercentiles
        $ageRanges = self::calculatePercentiles(10);  // Usamos el 10% de incremento para los rangos

        // Obtener el total de ventas en el ecommerce dentro del rango de fechas
        $totalSales = EcommerceSaleProduct::where('status', 'PAID')
            ->whereBetween('ecommerce_sale_products.created_at', [$startDate, $endDate])
            ->count();

        //dd($totalSales);
        //dd($ageRanges);

        // Inicializar el array de porcentajes
        $agePercentages = [];

        // Contamos las ventas para cada rango de edad
        foreach ($ageRanges as $range) {
            list($startAge, $endAge) = explode('-', $range);  // Desglose del rango "inicio-fin"
            $startAge = (int) $startAge;
            $endAge = (int) $endAge;

            // Contamos las ventas que pertenecen a este rango de edad dentro del rango de fechas
            $salesCountInRange = EcommerceSaleProduct::join('users', 'ecommerce_sale_products.user_id', '=', 'users.id')
                ->where('ecommerce_sale_products.status', 'PAID')
                ->whereBetween('ecommerce_sale_products.created_at', [$startDate, $endDate])
                ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, users.date_of_birth, CURDATE())'), [$startAge, $endAge])
                ->count();

            // Calculamos el porcentaje de ventas para este rango de edad
            $agePercentages[$range] = $totalSales > 0 ? number_format($salesCountInRange / $totalSales * 100, 2) : 0;
        }

        return $agePercentages;
    }

    public static function getEcommerceSalesByDepartment($startDate, $endDate)
    {
        // Lista de todos los nombres de departamentos que deseas incluir en el gráfico
        $departmentsList = Departments::get();

        // Consulta para obtener las ventas por departamento en el rango de fechas
        $salesData = EcommerceSaleProduct::join('users', 'ecommerce_sale_products.user_id', '=', 'users.id')
            ->where('ecommerce_sale_products.status', 'PAID') // Solo ventas completadas
            ->whereBetween('ecommerce_sale_products.created_at', [$startDate, $endDate])
            ->select('users.department as department', DB::raw('COUNT(ecommerce_sale_products.id) as sales_count'))
            ->groupBy('users.department')
            ->pluck('sales_count', 'department') // Obtenemos los resultados como un array clave-valor
            ->toArray();

        // Calcular el total de ventas
        $totalSales = array_sum($salesData);

        // Inicializar un array para los porcentajes de ventas por cada departamento
        $salesPercentageByDepartment = [];
        foreach ($departmentsList as $department) {
            // Calcula el porcentaje si hay ventas; si no, asigna 0%
            $departmentSales = $salesData[$department] ?? 0;
            $salesPercentageByDepartment[$department] = $totalSales > 0
                ? number_format(($departmentSales / $totalSales) * 100, 2)
                : 0;
        }

        return $salesPercentageByDepartment;
    }

    public static function calculatePercentiles($percentileStep = 10)
    {
        // Obtén las fechas de nacimiento más antigua y más reciente
        $minDateOfBirth = User::min('date_of_birth');
        $maxDateOfBirth = User::max('date_of_birth');

        // Calcula las edades basadas en las fechas de nacimiento
        $ageMax = Carbon::parse($minDateOfBirth)->age;  // Edad más alta (usuario más viejo)
        $ageMin = Carbon::parse($maxDateOfBirth)->age;  // Edad más baja (usuario más joven)

        //dd($ageMin, $ageMax);

        // Calcular la diferencia total en el rango
        $range = $ageMax - $ageMin;

        // Asegurar que el tamaño del paso sea al menos 1
        $step = max(1, ceil($range * ($percentileStep / 100)));

        // Crear los rangos en base al step
        $percentiles = [];
        for ($start = $ageMin; $start <= $ageMax; $start += $step) {
            $end = min($start + $step - 1, $ageMax); // Asegura que el último rango incluya la edad máxima
            $percentiles[] = "{$start}-{$end}";
            if ($end >= $ageMax) break; // Finalizar si se alcanza el máximo
        }

        return $percentiles;
    }


    public function salesByMonth()
    {
        // Obtener las ventas del año actual
        $currentYear = Carbon::now()->year;

        // Consulta para obtener las ventas agrupadas por mes
        $monthlySales = EcommerceSaleProduct::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total) as total_sales')
        )
            ->whereYear('created_at', $currentYear)
            ->where('status', 'PAID')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        // Inicializar un arreglo con los 12 meses del año y sus valores en 0
        $salesByMonth = array_fill(0, 12, 0);

        // Asignar los totales de ventas al arreglo de acuerdo al mes
        foreach ($monthlySales as $sale) {
            $salesByMonth[$sale->month - 1] = $sale->total_sales;
        }
        return ApiResponse::success($salesByMonth, "Registro encontrado.");
    }
}
