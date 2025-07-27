<?php

namespace Database\Seeders\tecnologia;

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
            // Atributos para el grupo "Estandar"
            ['attribute_group_id' => 1, 'description' => 'Gama Alta', 'status' => true],
            ['attribute_group_id' => 1, 'description' => 'Gama Baja', 'status' => true],
            

            // Atributos para el grupo "Gamer"
            ['attribute_group_id' => 2, 'description' => 'Especial', 'status' => true],
            ['attribute_group_id' => 2, 'description' => 'Personalizada', 'status' => true],
        ]);
    }

}
