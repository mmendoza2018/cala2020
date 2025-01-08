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
        $rules = [
            'socialNetworks' => 'required|array',
            'socialNetworks.*.id' => 'nullable|integer|exists:social_networks,id',
            'socialNetworks.*.name' => 'required|string|max:255',
            'socialNetworks.*.icon_html' => 'required|string',
            'socialNetworks.*.link' => 'required|url',
            'socialNetworks.*.status' => 'nullable|integer|in:0,1',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->input('socialNetworks');

        foreach ($data as $item) {
            if (isset($item['id'])) {
                // Actualizar registro existente
                $socialNetwork = SocialNetwork::find($item['id']);
                $socialNetwork->update($item);
            } else {
                // Crear nuevo registro
                SocialNetwork::create($item);
            }
        }

        // Cambiar estado de redes sociales no enviadas a 0
        $existingIds = collect($data)->pluck('id')->filter()->toArray();
        SocialNetwork::whereNotIn('id', $existingIds)->update(['status' => 0]);

        return response()->json(['message' => 'Social networks updated successfully.']);
    }
}
