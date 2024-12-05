<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Attribute as ModelsAttribute;
use App\Models\AttributeGroup;
use App\Models\ProductAttribute;
use Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{
    public function index(Request $request)
    {
        $idGroupAttribute = $request->query('idGroupAttribute');
        $attributeGroup = AttributeGroup::where("id", $idGroupAttribute)->where("status", 1)->first();
        $attributes = ModelsAttribute::where("attribute_group_id", $idGroupAttribute)->where("status", 1)->get();

        return view("admin.product_attributes.index", compact('attributeGroup', 'attributes'));
    }

    public function show(Request $request, $id)
    {
        $attribute = ModelsAttribute::find($id);

        if ($request->expectsJson()) {
            return ApiResponse::success($attribute, "Registro encontrado.");
        }
    }

    public function store(Request $request)
    {

        $rules = [
            "description" => "required|string|min:1",
            "idGroupAttribute" => "required",
        ];

        // Definir los nombres amigables de los atributos
        $attributes = [
            "description" => "Descripción",
            "idGroupAttribute" => "ID del grupo",
        ];

        // Crear el validador manualmente
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributes);

        // Validar los datos
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return ApiResponse::error("Validation Error", $errors, 202);
        }

        // Si la validación pasa, obtener los datos validados
        $validatedData = $validator->validated();

        $productCategory = ModelsAttribute::create([
            "description" => $validatedData["description"],
            'attribute_group_id' => $validatedData["idGroupAttribute"],
        ]);

        return ApiResponse::success($productCategory, "Agregado con exito");
    }

    public function update(Request $request, $id)
    {

        $rules = [
            "description" => "required|string|min:1",
            "status" => "required",
        ];

        $attributes = [
            "description" => "Descripción",
            "status" => "Estado",
        ];

        // Crear el validador manualmente
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributes);

        // Validar los datos
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return ApiResponse::error("Error de validación", $errors, 202);
        }

        // Si la validación pasa, obtener los datos validados
        $validatedData = $validator->validated();

        $attribute = ModelsAttribute::findOrFail($id);

        $attributeData = [
            "description" => $validatedData["description"],
            "status" => $validatedData["status"]
        ];

        $attribute->update($attributeData);

        $attribute = ModelsAttribute::findOrFail($id);

        return ApiResponse::success($attribute, "Agregado con exito");
    }
}
