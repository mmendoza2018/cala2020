<?php

namespace Database\Seeders;

use App\Models\General;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GeneralSeeder extends Seeder
{
   
    public function run()
    {

        $nombre = config('tienda.name');
        $description = config('tienda.description');
        $usarMarcas = config('tienda.active_brand');
        $usarSubcategorias = config('tienda.active_subcategory');
        $address = config('tienda.address');
        $email = config('tienda.email');
        $imagePath = config('tienda.logo_path');

        General::create([
            'title' => $nombre,
            'code' => Str::uuid(),
            'business_name' => '-',
            'ruc' => '12345678901',
            'address' => $address,
            'email' => $email,
            'description' => $description,
            'brand_is_active' => $usarMarcas,
            'subcategory_is_active' => $usarSubcategorias,
            'status' => 1,
            "logo" => $imagePath
        ]);
    }
}
