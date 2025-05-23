<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    function index()
    {
        $banners = Banner::where("status", 1)->get();
        return view('admin.banners.index', [
            "banners" => $banners
        ]);
    }   

    public function show(Request $request, $id)
    {
        $banners = Banner::find($id);
        $arrayImageDetails = [];
        $imageDirectory = storage_path('app/public/uploads/');
        $imageDetails = pathNameToFile($banners->image_name, $imageDirectory);
        array_push($arrayImageDetails, $imageDetails);
        $banners->imageDetail = $arrayImageDetails;
        if ($request->expectsJson()) {
            return ApiResponse::success($banners, "Registro encontrado.");
        }
    }

    public function store(Request $request)
    {

        $rules = [
            "imagen" => "nullable|file|mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg+xml",
        ];

        // Definir los nombres amigables de los atributos
        $attributes = [
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

        $logo = $request->file('imagen');
        //$imageName = $logo->getClientOriginalName();
        $path = $logo->store('uploads/' . getCompanyCode(), 'public');
        $imagePath = basename($path);

        $banner = Banner::create([
            "image_name" => $imagePath
        ]);

        $banner = Banner::latest()->first();

        return ApiResponse::success($banner, "Agregado con exito");
    }

    public function update(Request $request, $id)
    {

        $rules = [
            "imagen" => "nullable|file|mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg+xml",
            "status" => "required",
        ];

        // Definir los nombres amigables de los atributos
        $attributes = [
            "imagen" => "Imagen",
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

        $banner = Banner::findOrFail($id);

        $imagePath = null;
        $image = $request->file('imagen');
        $imagePath = $image->getClientOriginalName();

        // Si la imagen ya existe, actualiza su información
        if ($imagePath != $banner->image_name) {
            $path = $image->store('uploads/' . getCompanyCode(), 'public');
            $imagePath = basename($path);
        } else {
            $imagePath = $banner->image_name;
        }

        $categoryData = [
            "image_name" => $imagePath,
            "status" => $validatedData["status"]
        ];

        $banner->update($categoryData);

        $banner = $banner->fresh();

        return ApiResponse::success($banner, "Agregado con exito");
    }
}
