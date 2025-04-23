<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentMethodController extends Controller
{
    public function index(Request $request)
    {
        $paymentMethods = PaymentMethod::where("status", 1)->get();
        // Definir el directorio de imágenes
        $imageDirectory = storage_path('app/public/uploads/');

        foreach ($paymentMethods as $paymentMethod) {

            $filePath = $imageDirectory . $paymentMethod->image;

            if (file_exists($filePath)) {
                $paymentMethod->size = filesize($filePath);
            } else {
                $paymentMethod->size = null;
            }
            
        }

        if ($request->expectsJson()) {
            return ApiResponse::success($paymentMethods, "Registro encontrado.");
        }

        return view('admin.payment_method.index', compact('paymentMethods'));
    }

    public function update(Request $request)
    {
        //dd($request->all());
        $paymentMethods = json_decode($request->paymentMethods, true);

        if (!$paymentMethods) {
            return ApiResponse::error("Validation Error", ["El campo redes sociales debe ser un arreglo válido."], 202);
        }

        $rules = [
            'paymentMethods' => 'required|array',
            'paymentMethods.*.description' => 'required|string',
            'paymentMethods.*.id' => 'nullable|integer|exists:payment_methods,id',
        ];

        $attributes = [
            'paymentMethods.*.description' => 'Descripción',
            'paymentMethods.*.id' => 'ID del registro',
        ];

        $validator = Validator::make(['paymentMethods' => $paymentMethods], $rules);
        $validator->setAttributeNames($attributes);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return ApiResponse::error("Validation Error", $errors, 202);
        }

        // Obtener los datos validados
        $validatedData = $validator->validated();
        $uploadedImages = $request->file('images');
        /* echo "<pre>";
        var_dump($uploadedImages);
        echo "<pre>"; */
        $paymentMethods = $validatedData['paymentMethods'];

        // Obtener los IDs enviados para mantenerlos activos
        $activeIds = [];
        $contador = 0;

        foreach ($paymentMethods as $paymentMethod) {
            if (!empty($paymentMethod['id'])) {
                // Actualizar el registro existente
                $register = PaymentMethod::find($paymentMethod['id']);
                $fileName = $register->image;
                
                if ($register->image != $uploadedImages[$contador]->getClientOriginalName()) {
                    $newPath = $uploadedImages[$contador]->store('uploads', 'public');
                    $fileName = basename($newPath);
                }
                
                $register->update([
                    'image' => $fileName,
                    'description' => $paymentMethod['description'],
                ]);
                
                $activeIds[] = $paymentMethod['id'];
            } else {
                // Crear un nuevo registro
                $newPath = $uploadedImages[$contador]->store('uploads', 'public');
                $fileName = basename($newPath);

                $newRegister = PaymentMethod::create([
                    'image' => $fileName,
                    'description' => $paymentMethod['description'],
                ]);

                $activeIds[] = $newRegister->id;
            }

            $contador ++;
        }

        // Cambiar a inactivo los registros que no están en la lista enviada
        PaymentMethod::whereNotIn('id', $activeIds)->update(['status' => 0]);

        return ApiResponse::success(null, "Registros actualizados correctamente", 202);
    }
}
