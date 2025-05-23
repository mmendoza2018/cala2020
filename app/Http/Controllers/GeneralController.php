<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\General;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GeneralController extends Controller
{
    function index()
    {
        return view('admin.store_general.index');
    }

    function show()
    {
        $generalInfo = General::first();

        $imageDirectory = storage_path('app/public/uploads/') . getCompanyCode();

        $imageDetails = pathNameToFile($generalInfo->logo, $imageDirectory);

        $generalInfo->logo_file  = $imageDetails ? $imageDetails : null;

        return ApiResponse::success($generalInfo, "Petición exitosa");
    }


    public function update(Request $request, $id)
    {

        $rules = [
            "title" => "required|string|max:255",
            "business_name" => "required|string|max:255",
            "ruc" => "required|string|max:20",
            "address" => "required|string|max:255",
            "email" => "required|email|max:255",
            "description" => "nullable|string",
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];

        // Definir los nombres amigables de los atributos
        $attributes = [
            "title" => "Titulo",
            "business_name" => "Razón social",
            "ruc" => "RUC",
            "address" => "Dirección",
            "email" => "Correo electronico",
            "description" => "Descripción",
            "logo" => "Imagen",
        ];

        // Crear el validador manualmente
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributes);

        // Validar los datos
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return ApiResponse::error("Validation Error", $errors, 202);
        }

        $general = General::first();

        $validatedData = $validator->validated();

        $logoPath = null;
        $logo = $request->file('logo');
        $path = $logo->getClientOriginalName();

        // Si la imagen ya existe, actualiza su información
        if ($path != $general->logo) {
            $path = $logo->store('uploads/' . getCompanyCode(), 'public');
            $logoPath = basename($path);
        } else {
            $logoPath = $general->logo;
        }

        $generalData = [
            "title" => $validatedData["title"],
            "business_name" => $validatedData["business_name"],
            "ruc" => $validatedData["ruc"],
            "address" => $validatedData["address"],
            "email" => $validatedData["email"],
            "description" => $validatedData["description"],
            "logo" => $logoPath,
        ];

        $general->update($generalData);

        $general = General::latest()->first();

        return ApiResponse::success($general, "Agregado con exito");
    }
}
