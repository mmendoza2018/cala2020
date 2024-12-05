<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\ComplaintsBook;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\Raffle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WebPageController extends Controller
{

    public function checkoutProducts()
    {
        $total = 0;

        if (session()->has('shoppingCartProducts')) {
            $total = array_reduce(session('shoppingCartProducts'), function ($carry, $product) {
                return $carry + ($product['price'] * $product['quantity']);
            }, 0);
        }

        return view('webpage.checkout_products', [
            "total" => $total,
            "activeScroll" => false,
        ]);
    }


    public function shoppingCartProducts()
    {
        return view('webpage.shopping_cart_products', [
            "activeScroll" => false,
        ]);
    }


    public function product(Product $product)
    {
        $product->load(['productAttributes.attributesCombination', 'productBrand']);
        $defaultProductAttribute = $product->productAttributes->firstWhere('is_default', 1);

        $groupedAttributes = [];
        $defaultAttributes = []; // Para almacenar la combinación por defecto, si existe

        // Iterar sobre los atributos del producto
        foreach ($product->productAttributes as $attribute) {
            foreach ($attribute->attributesCombination as $combination) {
                // Obtener el tipo y el valor del atributo
                $attributeType = $combination->attribute->attributeGroup->description; // "Tamaño" o "Color"
                $attributeValue = $combination->attribute->description; // "Rojo", "M"
                $attributeId = $combination->attribute->id; // ID del atributo

                // Verificar si el tipo de atributo ya está en el arreglo
                if (!isset($groupedAttributes[$attributeType])) {
                    // Inicializar la estructura para el tipo de atributo
                    $groupedAttributes[$attributeType] = [
                        'description' => $attributeType,
                        'attributes' => [], // Inicializar el arreglo de atributos
                    ];
                }

                // Verificar si el valor ya está en el arreglo de atributos
                if (!in_array($attributeValue, array_column($groupedAttributes[$attributeType]['attributes'], 'value'))) {
                    // Agregar el valor y el ID al arreglo de atributos
                    $groupedAttributes[$attributeType]['attributes'][] = [
                        'id' => $attributeId,
                        'value' => $attributeValue,
                    ];
                }

                // Si el atributo actual es el valor por defecto, almacenarlo
                if ($attribute->is_default) {
                    $defaultAttributes[$attributeType] = $attributeId;
                }
            }
        }

        // Convertir el arreglo a la forma deseada (sin llaves, solo índices numéricos)
        $finalGroupedAttributes = [];
        foreach ($groupedAttributes as $attributeType => $data) {
            $finalGroupedAttributes[] = [
                'description' => $data['description'],
                'attributes' => $data['attributes'], // Arreglo de atributos con ID y valor
            ];
        }
        /* dd($product);
        dd($finalGroupedAttributes, $defaultAttributes); */
        //dd(session('shoppingCartProducts'));
        return view('webpage.product', [
            "product" => $product,
            "activeScroll" => false,
            "finalGroupedAttributes" => $finalGroupedAttributes,
            "defaultAttributes" => $defaultAttributes,
            "defaultProductAttribute" => $defaultProductAttribute
        ]);
    }

    public function register($fromCheckout = false)
    {

        if ($fromCheckout) {
            //creamos sesion para mostrar la ruta checkout mas adelante
            session(['from_checkout' => true]);
        }

        return view('webpage.register', ["activeScroll" => false]);
    }

    public function login()
    {
        return view('webpage.login', ["activeScroll" => false]);
    }

    public function social(Request $request)
    {
        return view('webpage.social', ["activeScroll" => true]);
    }

    public function termsAndConditions(Request $request)
    {
        return view('webpage.terms_and_conditions', ["activeScroll" => false]);
    }

    public function complaintsBook(Request $request)
    {
        $lastComplaint = ComplaintsBook::latest()->first();
        $nextId = 1;
        if ($lastComplaint) {
            $lastComplaint->id + 1;
        }
        return view('webpage.complaints_book', ["activeScroll" => false, "lastComplaint" => $nextId]);
    }

    public function changePolicies(Request $request)
    {
        return view('webpage.change_policies', ["activeScroll" => false]);
    }
    
    public function store(Request $request)
    {
        $categories = CategoryProduct::where("status", 1)->get();
        $brands = ProductBrand::where("status", 1)->get();
        $products = Product::where("status_on_website", 1)->where("status", 1)->paginate(4);

        $productsQuery = $this->applyProductFilters($request);

        $products = $productsQuery->paginate(9);

        if (request()->ajax()) {

            return view('webpage.components.products', compact('products'))->render();
        }

        return view('webpage.store', [
            "products" => $products,
            "brands" => $brands,
            "categories" => $categories,
            "activeScroll" => false
        ]);
    }

    public function viewProductsCategory(Request $request, CategoryProduct $categoryProduct)
    {
        $categories = CategoryProduct::where("status", 1)->get();
        $brands = ProductBrand::where("status", 1)->get();
        $products = Product::where("status_on_website", 1)->where("status", 1)->paginate(4);

        // Aplicar filtros
        $productsQuery = $this->applyProductFilters($request);
        $productsQuery->where('category_product_id', $categoryProduct->id);
        // Paginación
        $products = $productsQuery->paginate(9);

        if (request()->ajax()) {
            return view('webpage.components.products', compact('products'))->render();
        }

        return view('webpage.products_category', [
            "products" => $products,
            "brands" => $brands,
            "categories" => $categories,
            "activeScroll" => false
        ]);
    }

    public function about(Request $request)
    {
        return view('webpage.about', ["activeScroll" => true]);
    }

    public function home(Request $request)
    {
        return view('webpage.home', [
            "activeScroll" => true,
        ]);
    }

    private function applyProductFilters(Request $request)
    {
        // Iniciar la consulta de productos con las relaciones necesarias
        $productsQuery = Product::with([
            'productAttributes.prices', // Relación de los precios de las variantes
            'productAttributes.attributesCombination', // Relación con las combinaciones de atributos
            'productBrand'
        ])
            ->where('products.status', 1)
            ->where("status_on_website", 1);

        // Filtros de búsqueda
        if ($request->has('search') && !empty($request->search)) {
            $productsQuery->where('products.title', 'LIKE', '%' . $request->search . '%');
        }

        // Filtros de marcas
        if ($request->has('brands') && !empty($request->brands)) {
            $productsQuery->whereIn('products.product_brand_id', $request->brands);
        }

        // Ordenamiento
        if ($request->has('order') && !empty($request->order)) {
            switch ($request->order) {
                case 'price_desc':
                    $productsQuery->join('product_attributes', 'products.id', '=', 'product_attributes.product_id')
                        ->orderBy('product_attributes.default_price', 'desc')
                        ->distinct('products.id')
                        ->select('products.*');
                    break;

                case 'price_asc':
                    $productsQuery->join('product_attributes', 'products.id', '=', 'product_attributes.product_id')
                        ->orderBy('product_attributes.default_price', 'asc')
                        ->distinct('products.id')
                        ->select('products.*');
                    break;

                case 'newest':
                    $productsQuery->orderBy('products.created_at', 'desc');
                    break;

                case 'oldest':
                    $productsQuery->orderBy('products.created_at', 'asc');
                    break;
            }
        }

        return $productsQuery;
    }
}
