<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Insertar atributos
        DB::table('attributes')->insert([
            // Atributos para el grupo "Tamaño"
            ['attribute_group_id' => 1, 'description' => 'S', 'status' => true],
            ['attribute_group_id' => 1, 'description' => 'M', 'status' => true],
            

            // Atributos para el grupo "Color"
            ['attribute_group_id' => 2, 'description' => 'Rojo', 'status' => true],
            ['attribute_group_id' => 2, 'description' => 'Azul', 'status' => true],
        ]);
    }

}
