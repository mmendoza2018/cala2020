<?php

namespace Database\Seeders;

use App\Models\MeasurementUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeasurementUnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            'Kilogramo',
            'Litro',
            'Unidad',
            'Gramo',
            'Mililitro',
            'Metro Cúbico',
            'Metro Cuadrado',
            'Centímetro',
            'Metro',
            'Libra'
        ];

        foreach ($units as $unit) {
            MeasurementUnit::create([
                'description' => $unit,
            ]);
        }
    }
}
