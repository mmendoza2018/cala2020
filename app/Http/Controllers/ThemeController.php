<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\PaymentMethod;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ThemeController extends Controller
{
    public function index(Request $request)
    {
        $themes = Theme::where("status", 1)->first();
        if ($request->expectsJson()) {
            return ApiResponse::success($themes, "Registro encontrado.");
        }

        return view('admin.themes.index', compact('themes'));
    }

    public function update(Request $request)
    {
        $rules = [
            "primary_color" => "required|string|max:10",
            "secondary_color" => "required|string|max:10",
        ];

        // Definir los nombres amigables de los atributos
        $attributes = [
            "primary_color" => "Color primario",
            "secondary_color" => "Color secundario",
        ];

        // Crear el validador manualmente
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributes);

        // Validar los datos
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return ApiResponse::error("Validation Error", $errors, 202);
        }

        $general = Theme::first();

        $validatedData = $validator->validated();



        $data = [
            "primary_color" => $validatedData["primary_color"],
            "secondary_color" => $validatedData["secondary_color"],
        ];

        $general->update($data);
        $lastTheme= Theme::latest()->first();

        return ApiResponse::success($lastTheme, "Registros actualizados correctamente", 202);
    }
}
