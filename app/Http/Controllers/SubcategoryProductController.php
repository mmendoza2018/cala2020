<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\SubcategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubcategoryProductController extends Controller
{
    function index()
    {
        $subCategories = SubcategoryProduct::where("status", 1)->get();
        return view('admin.product_subcategory.index', [
            "subCategories" => $subCategories
        ]);
        
    }

    public function show(Request $request, $id)
    {
        $subCategories = SubcategoryProduct::find($id);
        $arrayImageDetails = [];
        $imageDirectory = storage_path('app/public/uploads/');
        $imageDetails = pathNameToFile($subCategories->imagen, $imageDirectory);
        array_push($arrayImageDetails, $imageDetails);
        $subCategories->imageDetail = $arrayImageDetails;
        if ($request->expectsJson()) {
            return ApiResponse::success($subCategories, "Registro encontrado.");
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
        $path = $logo->store('uploads/' . getCompanyCode(), 'public');
        $imagePath = basename($path);

        $productsubCategory = SubcategoryProduct::create([
            "description" => $validatedData["description"],
            "code" => $validatedData["code"],
            "imagen" => $imagePath
        ]);

        $productsubCategory = SubcategoryProduct::latest()->first();

        return ApiResponse::success($productsubCategory, "Agregado con exito");
    }

    public function update(Request $request, $id)
    {

        $rules = [
            "description" => "required|string|min:2",
            "code" => "required",
            "imagen" => "nullable|file|mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg+xml",
            "status" => "required",
        ];

        // Definir los nombres amigables de los atributos
        $attributes = [
            "description" => "Descripción",
            "code" => "Código",
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

        $productCategory = SubcategoryProduct::findOrFail($id);

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

        $productCategory = SubcategoryProduct::latest()->first();

        return ApiResponse::success($productCategory, "Agregado con exito");
    }
}
