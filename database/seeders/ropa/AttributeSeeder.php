<?php

namespace Database\Seeders\ropa;

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

            ['attribute_group_id' => 1, 'description' => 'Importado', 'status' => true],
            ['attribute_group_id' => 1, 'description' => 'Nacional', 'status' => true],
            
            ['attribute_group_id' => 2, 'description' => 'S', 'status' => true],
            ['attribute_group_id' => 2, 'description' => 'M', 'status' => true],
        ]);
    }

}
