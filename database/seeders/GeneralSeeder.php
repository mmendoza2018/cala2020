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
        General::create([
            'title' => 'Mimesoft',
            'code' => Str::uuid(),
            'business_name' => 'Mimesoft Technologies',
            'ruc' => '12345678901',
            'address' => '123 Calle Principal, Ciudad Ejemplo',
            'email' => 'contacto@mimesoft.com',
            'description' => 'Mimesoft es una empresa innovadora que desarrolla soluciones tecnológicas avanzadas para sus clientes.',
            'brand_is_active' => true,
            'subcategory_is_active' => true,
            'status' => 1,
        ]);
    }
}
