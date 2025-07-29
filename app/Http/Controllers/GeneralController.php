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
        $arrayImageDetails = [];
        $imageDirectory = storage_path('app/public/uploads/') . getCompanyCode() . '/';
        $imageDetails = pathNameToFile($generalInfo->logo, $imageDirectory);
        array_push($arrayImageDetails, $imageDetails);
        $generalInfo->logo_file  = $arrayImageDetails;

        return ApiResponse::success($generalInfo, "Petición exitosa");
    }


    public function update(Request $request, $id)
    {
        $rules = [
            "title" => "sometimes|string|max:255",
            "business_name" => "sometimes|string|max:255",
            "ruc" => "sometimes|string|max:20",
            "address" => "sometimes|string|max:255",
            "email" => "sometimes|email|max:255",
            "description" => "sometimes|nullable|string",
            'logo' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'subcategory_is_active' => 'sometimes|in:0,1',
            'brand_is_active' => 'sometimes|in:0,1',
        ];

        $attributes = [
            "title" => "Título",
            "business_name" => "Razón social",
            "ruc" => "RUC",
            "address" => "Dirección",
            "email" => "Correo electrónico",
            "description" => "Descripción",
            "logo" => "Imagen",
            "subcategory_is_active" => "Subcategoria check",
            "brand_is_active" => "Marca check",
        ];

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributes);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return ApiResponse::error("Validation Error", $errors, 202);
        }

        $general = General::findOrFail($id);
        $validatedData = $validator->validated();

        // Si se envió logo, procesarlo
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $path = $logo->store('uploads/' . getCompanyCode(), 'public');
            $validatedData['logo'] = basename($path);
        }

        $general->update($validatedData);

        return ApiResponse::success($general->fresh(), "Actualizado con éxito");
    }
}
