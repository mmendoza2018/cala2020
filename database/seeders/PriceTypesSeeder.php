<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Datos de ejemplo para poblar la tabla price_types
        $priceTypes = [
            [
                'description' => 'General',
                'status' => true,
            ],
        ];

        // Inserta los datos en la tabla
        DB::table('price_types')->insert($priceTypes);
    }
}
