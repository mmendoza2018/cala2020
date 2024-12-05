<?php

namespace Database\Seeders;

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
            ['description' => 'Tamaño', 'status' => true],
            ['description' => 'Color', 'status' => true],
        ]);
    }
}
