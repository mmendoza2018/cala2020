<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromotionController extends Controller
{
    function index()
    {
        $promotions = Promotion::where("status", 1)->get();
        return view('admin.promotions.index', [
            "promotions" => $promotions
        ]);
    }   

    public function show(Request $request, $id)
    {
        $promotions = Promotion::find($id);
        $arrayImageDetails = [];
        $imageDirectory = storage_path('app/public/uploads/');
        $imageDetails = pathNameToFile($promotions->image_name, $imageDirectory);
        array_push($arrayImageDetails, $imageDetails);
        $promotions->imageDetail = $arrayImageDetails;
        if ($request->expectsJson()) {
            return ApiResponse::success($promotions, "Registro encontrado.");
        }
        //return view();
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

        $promotion = Promotion::create([
            "image_name" => $imagePath
        ]);

        $promotion = Promotion::latest()->first();

        return ApiResponse::success($promotion, "Agregado con exito");
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

        $promotion = Promotion::findOrFail($id);

        $imagePath = null;
        $image = $request->file('imagen');
        $imagePath = $image->getClientOriginalName();

        // Si la imagen ya existe, actualiza su información
        if ($imagePath != $promotion->image_name) {
            $path = $image->store('uploads/' . getCompanyCode(), 'public');
            $imagePath = basename($path);
        } else {
            $imagePath = $promotion->image_name;
        }

        $data = [
            "image_name" => $imagePath,
            "status" => $validatedData["status"]
        ];

        $promotion->update($data);

        $promotion = $promotion->fresh();

        return ApiResponse::success($promotion, "Agregado con exito");
    }
}
