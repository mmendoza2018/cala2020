<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\AttentionNumber;
use App\Models\EcommerceSaleProduct;
use App\Models\EcommerceSaleProductDetail;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShoppingCartProductController extends Controller
{
    public function addRemoveProduct(Request $request)
    {
        $idProductAttribute = $request->input('idProductAttribute');
        $quantity = intval($request->input('quantity', 1));
        $type = $request->input('type');

        $productVariant = ProductAttribute::with(['attributesCombination.attribute.attributeGroup'])->where("id", $idProductAttribute)->first();

        //dd($productVariant);

        if (!$productVariant) {
            return ApiResponse::error("Validation Error", ["La combinacion no esta disponible"], 202);
        }

        //dd($ProductVariant);
        if ($quantity <= 0) {
            return ApiResponse::error("Validation Error", ["La cantidad debe ser mayor que cero"], 202);
        }

        if ($productVariant->stock < $quantity) {
            return ApiResponse::error("Validation Error", ["Producto agotado"], 202);
        }

        // Obtener el carrito de la sesión del vendedor
        $shoppingCart = session()->get('shoppingCartProducts', []);

        // Verificar si el producto ya está en el carrito del POS
        //dd($shoppingCart);
        if (isset($shoppingCart[$productVariant->id])) {
            //dd($productVariant->stock, $shoppingCart[$productVariant->id]['quantity'] + $quantity);
            if ($type === "plus") {
                if ($productVariant->stock < $shoppingCart[$productVariant->id]['quantity'] + $quantity) {
                    return ApiResponse::error("Validation Error", ["La cantidad supera al stock actual"], 202);
                }
                $shoppingCart[$productVariant->id]['quantity'] += $quantity;
            } else {
                $shoppingCart[$productVariant->id]['quantity'] -= $quantity;
            }


            $shoppingCart[$productVariant->id]['subtotal'] = $shoppingCart[$productVariant->id]['quantity'] * $shoppingCart[$productVariant->id]['price'];
        } else {
            if ($productVariant->stock < $quantity) {
                return ApiResponse::error("Validation Error", ["La cantidad supera al stock actual"], 202);
            }
            $product = Product::with('productBrand', 'productImages')->where("status", 1)->where("status_on_website", 1)->where("id", $productVariant->product_id)->first();
            $imageMain = null;
            foreach ($product->productImages as $image) {
                if ($image->is_main) {
                    $imageMain = $image->image_name;
                }
            }

            $shoppingCart[$productVariant->id] = [
                'productId' => $product->id,
                'productAttribute' => $productVariant->id,
                'isDigitalProduct' => $product->raffle_id ? true : false,
                'raffleId' => $product->raffle_id,
                'title' => $product->title,
                'image' => $imageMain,
                'brand' => $product->productBrand->description ?? '', // Si hay un campo brand
                'slug' => $product->slug ?? '', // Si hay un campo brand
                'attributes_combination' => $productVariant->attributesCombination,
                'price' => intval($productVariant->default_price),
                'quantity' => $quantity,
                'subtotal' => $quantity * $productVariant->default_price, // Calcular el subtotal
            ];
        }

        // Guardar el carrito en la sesión
        session()->put('shoppingCartProducts', $shoppingCart);

        // Retornar el carrito actualizado junto con el producto añadido
        return ApiResponse::success($shoppingCart, "Acción realizada con éxito");
    }

    // Mostrar el carrito del POS
    public function showCart()
    {
        $shoppingCart = session()->get('shoppingCartProducts', []);
        return ApiResponse::success($shoppingCart, "Acción realizada con éxito");
    }

    public static function clearCart()
    {
        session()->forget('shoppingCartProducts');
        return ApiResponse::success([], "Acción realizada con éxito");
    }

    // Eliminar un producto específico del carrito (sesión del POS)
    public function removeProduct($idProductAttribute)
    {
        $shoppingCart = session()->get('shoppingCartProducts', []);

        // Verificar si el producto está en el carrito
        if (isset($shoppingCart[$idProductAttribute])) {
            // Eliminar el producto del carrito
            unset($shoppingCart[$idProductAttribute]);
            session()->put('shoppingCartProducts', $shoppingCart);

            return ApiResponse::success($shoppingCart, "Producto eliminado con éxito");
        }

        // Si el producto no está en el carrito, devolver un mensaje de error
        return ApiResponse::error("Validation Error", ["El producto no se encuentra en el carrito"], 202);
    }

    public static function isValidProductSession()
    {
        $shoppingCartProducts = session('shoppingCartProducts', []);

        if (count($shoppingCartProducts) === 0) {
            return response()->json([
                'status' => 'error',
                'data' => [
                    "user_message" => "Debe existir al menos un producto en el carrito de compras",
                    "object" => "error"
                ]
            ], 200);
        }

        return null; // Indica que todo está correcto.
    }

    public function store(Request $request)
    {
        //crear la orden
        $existError = ShoppingCartProductController::isValidProductSession();
        if ($existError) {
            return $existError;
        }

        $rules = [
            "first_name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "phone_number" => "required|string|max:20",
            "alternate_phone_number" => "nullable|string|max:20",
            "email" => "required|email|max:255",
            "address" => "required|string|max:500",
            "state" => "required|string|max:255",
            "city" => "required|string|max:255",
            "district" => "required|string|max:255",
        ];

        // Definir los nombres amigables de los atributos
        $attributes = [
            "first_name" => "Nombres",
            "last_name" => "Apellidos",
            "phone_number" => "Celular",
            "alternate_phone_number" => "Celular alternativo",
            "email" => "Correo",
            "address" => "Dirección",
            "state" => "Provincia",
            "city" => "Departamento",
            "district" => "distrito"
        ];

        // Crear el validador manualmente
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributes);

        // Validar los datos
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return ApiResponse::error("Validation Error", $errors, 202);
        }

        $validatedData = $validator->validated();
        //creamos la venta con estado pendiente a la espera de la confirmacion (IPN)
        $shoppingCartProducts = session('shoppingCartProducts', []);

        $total = 0;
        $total = array_reduce(session('shoppingCartProducts'), function ($carry, $product) {
            return $carry + ($product['price'] * $product['quantity']);
        }, 0);

        //sumamos cantidades
        $totalQuantityProduct = 0;
        foreach ($shoppingCartProducts as $product) {
            $totalQuantityProduct += $product['quantity'];
        }

        $ecommerceSaleInsert = EcommerceSaleProduct::create([
            "code" => '-',
            "payment_method" => "",
            "quantity" => $totalQuantityProduct,
            "total" => $total,
            "status" => "PENDING",
            "first_name" => $validatedData["first_name"],
            "last_name" => $validatedData["last_name"],
            "phone_number" => $validatedData["phone_number"],
            "alternate_phone_number" => $validatedData["alternate_phone_number"],
            "email" => $validatedData["email"],
            "address" => $validatedData["address"],
            "state" => $validatedData["state"],
            "city" => $validatedData["city"],
            "district" => $validatedData["district"]
        ]);

        foreach (session('shoppingCartProducts') as $product) {

            $descripctionProduct = $product['title'] . ' | ' . $product['brand'];

            EcommerceSaleProductDetail::create([
                "sale_id" => $ecommerceSaleInsert->id,
                "product_attribute_id" => $product["productAttribute"],
                "product_name" => $descripctionProduct,
                "price" => $product["price"],
                "quantity" => $product["quantity"],
                "subtotal" => $product["subtotal"],
            ]);
        }

        $linkWhatsapp = $this->sendOrderWhatsApp($validatedData, $shoppingCartProducts);

        // Limpiamos el carrito
        session()->forget('shoppingCartProducts');

        return ApiResponse::success([
            "whatsapp_link" => $linkWhatsapp
        ], "Orden generada con éxito");
    }

    private function sendOrderWhatsApp($data, $products)
    {
        $attentionNumbers = AttentionNumber::where("status", 1)->pluck('phone_number')->toArray();

        if (empty($attentionNumbers)) {
            throw new \Exception("No hay números activos de atención configurados.");
        }

        $empresaPhone = $attentionNumbers[array_rand($attentionNumbers)];

        $message = "*NUEVA ORDEN RECIBIDA*\n";

        $message .= "━━━━━━━━━━━━━━━━━━━\n\n";

        $message .= "*CLIENTE:*\n";
        $message .= "Nombre: {$data['first_name']} {$data['last_name']}\n";
        $message .= "Teléfono: {$data['phone_number']}\n";

        if (!empty($data['alternate_phone_number'])) {
            $message .= "Teléfono Alternativo: {$data['alternate_phone_number']}\n";
        }

        $message .= "Correo: {$data['email']}\n\n";
        $message .= "*DIRECCIÓN DE ENTREGA:*\n";
        $message .= "Departamento: {$data['state']}\n";
        $message .= "Ciudad: {$data['city']}\n";
        $message .= "Distrito: {$data['district']}\n";
        $message .= "Dirección: {$data['address']}\n\n";
        $message .= "*DETALLE DE LOS PRODUCTOS:*\n";

        $message .= "━━━━━━━━━━━━━━━━━━━\n\n";

        $totalGeneral = 0;
        $totalCantidad = 0;
        $contadorProducts = 1;
        foreach ($products as $index => $product) {
            $message .= $contadorProducts . ". *{$product['title']}*\n";
            $message .= "Marca: {$product['brand']}\n";

            if (!empty($product['attributes_combination']) && $product['attributes_combination'] instanceof \Illuminate\Support\Collection) {
                $message .= "Atributos:\n";
                foreach ($product['attributes_combination'] as $attributeCombination) {
                    $grupo = $attributeCombination->attribute->attributeGroup->description ?? '';
                    $valor = $attributeCombination->attribute->description ?? '';
                    $message .= "- {$grupo}: {$valor}\n";
                }
            }

            $message .= "Precio Unitario: S/ {$product['price']}\n";
            $message .= "Cantidad: {$product['quantity']}\n";
            $message .= "Subtotal: S/ {$product['subtotal']}\n\n";

            $totalGeneral += $product['subtotal'];
            $totalCantidad += $product['quantity'];
            $contadorProducts ++;
        }

        $message .= "*RESUMEN DE LA ORDEN:*\n";

        $message .= "━━━━━━━━━━━━━━━━━━━\n\n";

        $message .= "Total de Productos: {$totalCantidad}\n";
        $message .= "Total a Pagar: *S/ {$totalGeneral}*\n\n";
        $message .= "Método de Pago: A coordinar\n";
        $message .= "Estado: PENDIENTE\n";

        $urlWhatsapp = "https://wa.me/{$empresaPhone}?text=" . rawurlencode($message);

        return $urlWhatsapp;
    }
}
