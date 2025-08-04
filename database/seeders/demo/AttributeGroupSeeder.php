<?php

namespace Database\Seeders\demo;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Insertar grupos de atributos
        DB::table('attribute_groups')->insert([
            ['description' => 'Calidad', 'status' => true],
            ['description' => 'Tamaño', 'status' => true],
        ]);
    }
}
