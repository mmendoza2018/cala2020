<?php

namespace App\Http\Controllers;

use App\Models\AttentionNumber;
use Illuminate\Http\Request;

class AttentionNumberController extends Controller
{
    /**
     * Mostrar una lista de recursos.
     */
    public function index()
    {
        return view('admin.attencion_numbers.index');
    }

    /**
     * Guardar un nuevo recurso en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'type' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        $number = AttentionNumber::create($validated);

        return response()->json($number, 201);
    }

    /**
     * Mostrar un recurso específico.
     */
    public function show($id)
    {
        $number = AttentionNumber::findOrFail($id);
        return response()->json($number);
    }

    /**
     * Actualizar un recurso existente en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'type' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        $number = AttentionNumber::findOrFail($id);
        $number->update($validated);

        return response()->json($number);
    }

}
