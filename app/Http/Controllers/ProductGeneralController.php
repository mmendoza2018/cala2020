<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductGeneralController extends Controller
{
    function index()
    {
        return view('admin.product_general.index');
    }

    public function show(Request $request, $id)
    {
        $productBrand = ProductBrand::find($id);

        if ($request->expectsJson()) {
            return ApiResponse::success($productBrand, "Registro encontrado.");
        }
        //return view();
    }

    public function store(Request $request)
    {

        $rules = [
            "description" => "required|string|min:2",
        ];

        // Definir los nombres amigables de los atributos
        $attributes = [
            "description" => "Descripción",
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

        $productCategory = ProductBrand::create([
            "description" => $validatedData["description"],
        ]);

        $productCategory = ProductBrand::latest()->first();

        return ApiResponse::success($productCategory, "Agregado con exito");
    }

    public function update(Request $request, $id)
    {

        $rules = [
            "description" => "required|string|min:2",
            "status" => "required",
        ];

        // Definir los nombres amigables de los atributos
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
            return ApiResponse::error("Validation Error", $errors, 202);
        }

        // Si la validación pasa, obtener los datos validados
        $validatedData = $validator->validated();

        $productBrand = ProductBrand::findOrFail($id);

        $categoryData = [
            "description" => $validatedData["description"],
            "status" => $validatedData["status"]
        ];

        $productBrand->update($categoryData);

        $productBrand = ProductBrand::latest()->first();

        return ApiResponse::success($productBrand, "Agregado con exito");
    }
}
