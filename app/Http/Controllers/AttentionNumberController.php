<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\AttentionNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttentionNumberController extends Controller
{
    /**
     * Mostrar una lista de recursos.
     */
    public function index()
    {
        $attentionNumbers = AttentionNumber::where("status", 1)->get();
        return view('admin.attencion_numbers.index', compact('attentionNumbers'));
    }

    /**
     * Guardar un nuevo recurso en la base de datos.
     */
    public function update(Request $request)
    {
        $attentionNumbers = json_decode($request->attentionNumbers, true);

        if (!$attentionNumbers) {
            return ApiResponse::error("Validation Error", ["El campo attentionNumbers debe ser un arreglo válido."], 202);
        }

        $rules = [
            'attentionNumbers' => 'required|array',
            'attentionNumbers.*.phone' => 'required|string|max:9',
            'attentionNumbers.*.fullname' => 'required|string|max:255',
            'attentionNumbers.*.id' => 'nullable|integer|exists:attention_numbers,id',
        ];

        $attributes = [
            'attentionNumbers.*.phone' => 'Número de celular',
            'attentionNumbers.*.fullname' => 'Nombres',
            'attentionNumbers.*.id' => 'ID del registro',
        ];

        $validator = Validator::make(['attentionNumbers' => $attentionNumbers], $rules);
        $validator->setAttributeNames($attributes);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return ApiResponse::error("Validation Error", $errors, 202);
        }

        // Obtener los datos validados
        $validatedData = $validator->validated();
        $attentionNumbers = $validatedData['attentionNumbers'];

        // Obtener los IDs enviados para mantenerlos activos
        $activeIds = [];

        foreach ($attentionNumbers as $attentionNumber) {
            if (!empty($attentionNumber['id'])) {
                // Actualizar el registro existente
                $register = AttentionNumber::find($attentionNumber['id']);
                $register->update([
                    'phone_number' => $attentionNumber['phone'],
                    'name' => $attentionNumber['fullname'],
                ]);
                $activeIds[] = $attentionNumber['id'];
            } else {
                // Crear un nuevo registro
                $newRegister = AttentionNumber::create([
                    'phone_number' => $attentionNumber['phone'],
                    'name' => $attentionNumber['fullname'],
                ]);
                $activeIds[] = $newRegister->id;
            }
        }

        // Cambiar a inactivo los registros que no están en la lista enviada
        AttentionNumber::whereNotIn('id', $activeIds)->update(['status' => 0]);

        return ApiResponse::success(null, "Registros actualizados correctamente", 202);
    }
}
