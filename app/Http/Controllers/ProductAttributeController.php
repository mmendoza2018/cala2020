<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    public function getProductByAttributes(Request $request)
    {
        // Recuperar los datos del request
        $productId = $request->input('idProduct');
        $selectedAttributes = json_decode($request->input('selectedAttributes'), true);

        // Obtener el ProductAttribute que coincide con los atributos seleccionados
        $productAttribute = ProductAttribute::where('product_id', $productId)
            ->whereHas('attributesCombination', function ($query) use ($selectedAttributes) {
                // Usamos whereIn para verificar que cada combinación de atributo está en los seleccionados
                $query->whereIn('attribute_id', $selectedAttributes);
            })
            ->with(['attributesCombination.attribute.attributeGroup'])
            ->get();

        // Filtrar las combinaciones que tienen todos los atributos seleccionados
        $combinationAttribute = $productAttribute->filter(function ($attribute) use ($selectedAttributes) {
            $attributeIds = $attribute->attributesCombination->pluck('attribute_id')->toArray();
            return count(array_diff($selectedAttributes, $attributeIds)) === 0;
        })->first();

        if ($combinationAttribute) {
            return ApiResponse::success($combinationAttribute, "Registro encontrado");
        }

        return ApiResponse::error("Validation Error", ["Combinación no disponible"], 202);
    }
}
