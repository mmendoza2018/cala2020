<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{
    function index()
    {
        $categories = CategoryProduct::where("status", 1)->get();
        return view('admin.product_category.index', [
            "categories" => $categories
        ]);
    }

    public function show(Request $request, $id)
    {
        $categories = CategoryProduct::find($id);
        $arrayImageDetails = [];
        $imageDirectory = storage_path('app/public/uploads/');
        $imageDetails = pathNameToFile($categories->imagen, $imageDirectory);
        array_push($arrayImageDetails, $imageDetails);
        $categories->imageDetail = $arrayImageDetails;
        if ($request->expectsJson()) {
            return ApiResponse::success($categories, "Registro encontrado.");
        }
        //return view();
    }

    public function store(Request $request)
    {

        $rules = [
            "description" => "required|string|min:2",
            "code" => "required",
            "imagen" => "nullable|file|mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg+xml",
        ];

        // Definir los nombres amigables de los atributos
        $attributes = [
            "description" => "Descripción",
            "code" => "Código",
            'imagen' => 'Imagen'
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
        //$imageName = $logo->getClientOriginalName();
        $path = $logo->store('uploads/' . getCompanyCode(), 'public');
        $imagePath = basename($path);

        $productCategory = CategoryProduct::create([
            "description" => $validatedData["description"],
            "code" => $validatedData["code"],
            "imagen" => $imagePath
        ]);

        $productCategory = CategoryProduct::latest()->first();

        return ApiResponse::success($productCategory, "Agregado con exito");
    }

    public function update(Request $request, $id)
    {

        $rules = [
            "description" => "required|string|min:2",
            "code" => "required",
            "status" => "required",
        ];

        // Definir los nombres amigables de los atributos
        $attributes = [
            "description" => "Descripción",
            "code" => "Código",
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

        $productCategory = CategoryProduct::findOrFail($id);

        $imagePath = null;
        $image = $request->file('imagen');
        $imagePath = $image->getClientOriginalName();

        // Si la imagen ya existe, actualiza su información
        if ($imagePath != $productCategory->imagen) {
            $path = $image->store('uploads/' . getCompanyCode(), 'public');
            $imagePath = basename($path);
        } else {
            $imagePath = $productCategory->imagen;
        }

        $categoryData = [
            "description" => $validatedData["description"],
            "code" => $validatedData["code"],
            "imagen" => $imagePath,
            "status" => $validatedData["status"]
        ];

        $productCategory->update($categoryData);

        $productCategory = $productCategory->fresh();

        return ApiResponse::success($productCategory, "Agregado con exito");
    }
}
