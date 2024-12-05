<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

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
            $product = Product::with('productBrand')->where("status", 1)->where("status_on_website", 1)->where("id", $productVariant->product_id)->first();
            $imageProduct = json_decode($product->images)[0];
            $shoppingCart[$productVariant->id] = [
                'productId' => $product->id,
                'productAttribute' => $productVariant->id,
                'isDigitalProduct' => $product->raffle_id ? true : false,
                'raffleId' => $product->raffle_id,
                'title' => $product->title,
                'image' => $imageProduct,
                'brand' => $product->productBrand->description ?? '', // Si hay un campo brand
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
}
