<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Datos de ejemplo para poblar la tabla categories_products
        $categories = [
            [
                'description' => 'CASCOS',
                'code' => 'TR',
                'status' => 1,
            ],
            [
                'description' => 'GUANTES',
                'code' => 'VC',
                'status' => 1,
            ],
            [
                'description' => 'ACCESORIOS',
                'code' => 'GA',
                'status' => 1,
            ],
        ];

        // Inserta los datos en la tabla
        DB::table('categories_products')->insert($categories);
    }
}
