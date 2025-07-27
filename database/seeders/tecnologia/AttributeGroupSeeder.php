<?php

namespace Database\Seeders\tecnologia;

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
            ['description' => 'Estandar', 'status' => true],
            ['description' => 'Gamer', 'status' => true],
        ]);
    }
}
