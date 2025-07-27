<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         $primary_color = config('tienda.primary_color');
         $secondary_color = config('tienda.secondary_color');

        DB::table('themes')->insert([
            'primary_color' => $primary_color, // Color primario
            'secondary_color' => $secondary_color, // Color secundario
            'product_card_shape' => 'SQUARE', // Forma de la card
            'theme_active' => 'THEME_01', // Tema activo
            'status' => 1, // Activo
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
