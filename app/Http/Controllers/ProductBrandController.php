<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductBrandController extends Controller
{
    function index()
    {
        $productBrands = ProductBrand::where("status", 1)->get();
        return view('admin.product_brand.index', [
            "productBrands" => $productBrands
        ]);
    }

    public function show(Request $request, $id)
    {
        $productBrand = ProductBrand::find($id);
        $arrayImageDetails = [];
        $imageDirectory = storage_path('app/public/uploads/') . getCompanyCode() . '/';
        $imageDetails = pathNameToFile($productBrand->imagen, $imageDirectory);
        array_push($arrayImageDetails, $imageDetails);
        $productBrand->imageDetail = $arrayImageDetails;

        if ($request->expectsJson()) {
            return ApiResponse::success($productBrand, "Registro encontrado.");
        }
        //return view();
    }

    public function store(Request $request)
    {

        $rules = [
            "description" => "required|string|min:2",
            "imagen" => "nullable|file|mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg+xml",
        ];

        // Definir los nombres amigables de los atributos
        $attributes = [
            "description" => "Descripción",
            "imagen" => "Imagen",
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

        $logo = $request->file('imagen');
        $path = $logo->store('uploads/' . getCompanyCode(), 'public');
        $imagePath = basename($path);

        $productCategory = ProductBrand::create([
            "description" => $validatedData["description"],
            "imagen" => $imagePath
        ]);

        $productCategory = ProductBrand::latest()->first();

        return ApiResponse::success($productCategory, "Agregado con exito");
    }

    public function update(Request $request, $id)
    {

        $rules = [
            "description" => "required|string|min:2",
            "imagen" => "nullable|file|mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg+xml",
            "status" => "required",
        ];

        // Definir los nombres amigables de los atributos
        $attributes = [
            "description" => "Descripción",
            "status" => "Estado",
            "imagen" => "Imagen",
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

        $imagePath = null;
        $image = $request->file('imagen');
        $imagePath = $image->getClientOriginalName();

        // Si la imagen ya existe, actualiza su información
        if ($imagePath != $productBrand->imagen) {
            $path = $image->store('uploads/' . getCompanyCode(), 'public');
            $imagePath = basename($path);
        } else {
            $imagePath = $productBrand->imagen;
        }

        $categoryData = [
            "description" => $validatedData["description"],
            "imagen" => $imagePath,
            "status" => $validatedData["status"]
        ];

        $productBrand->update($categoryData);

        $productBrand = $productBrand->fresh();

        return ApiResponse::success($productBrand, "Agregado con exito");
    }
}
