<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\SocialNetwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SocialNetworkController extends Controller
{
    public function index(Request $request)
    {
        $socialNetworks = SocialNetwork::where("status", 1)->get();

        if ($request->expectsJson()) {
            return ApiResponse::success($socialNetworks, "Registro encontrado.");
        }

        return view('admin.social_network.index', compact('socialNetworks'));
    }

    public function update(Request $request)
    {

        $socialNetworks = json_decode($request->socialNetworks, true);

        if (!$socialNetworks) {
            return ApiResponse::error("Validation Error", ["El campo redes sociales debe ser un arreglo válido."], 202);
        }

        $rules = [
            'socialNetworks' => 'required|array',
            'socialNetworks.*.description' => 'required|string',
            'socialNetworks.*.icon' => 'required|string|max:255',
            'socialNetworks.*.link' => 'required|string',
            'socialNetworks.*.id' => 'nullable|integer|exists:social_networks,id',
        ];

        $attributes = [
            'socialNetworks.*.description' => 'Descripción',
            'socialNetworks.*.icon' => 'Icono',
            'socialNetworks.*.link' => 'URL',
            'socialNetworks.*.id' => 'ID del registro',
        ];

        $validator = Validator::make(['socialNetworks' => $socialNetworks], $rules);
        $validator->setAttributeNames($attributes);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return ApiResponse::error("Validation Error", $errors, 202);
        }

        // Obtener los datos validados
        $validatedData = $validator->validated();
        $socialNetworks = $validatedData['socialNetworks'];

        // Obtener los IDs enviados para mantenerlos activos
        $activeIds = [];

        foreach ($socialNetworks as $socialNetwork) {
            if (!empty($attentionNumber['id'])) {
                // Actualizar el registro existente
                $register = SocialNetwork::find($socialNetwork['id']);
                $register->update([
                    'icon_html' => $socialNetwork['icon'],
                    'name' => $socialNetwork['description'],
                    'link' => $socialNetwork['link'],
                ]);
                $activeIds[] = $socialNetwork['id'];
            } else {
                // Crear un nuevo registro
                $newRegister = SocialNetwork::create([
                    'icon_html' => $socialNetwork['icon'],
                    'name' => $socialNetwork['description'],
                    'link' => $socialNetwork['link'], 
                ]);
                $activeIds[] = $newRegister->id;
            }
        }

        // Cambiar a inactivo los registros que no están en la lista enviada
        SocialNetwork::whereNotIn('id', $activeIds)->update(['status' => 0]);

        return ApiResponse::success(null, "Registros actualizados correctamente", 202);
    }
}
