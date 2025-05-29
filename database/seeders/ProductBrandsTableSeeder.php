<?php

namespace Database\Seeders;

use App\Models\ProductBrand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductBrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['description' => 'Kkostpa', 'image' => 'marca1'],
            ['description' => 'Lukki', 'image' => 'marca2'],
            ['description' => 'Kopor', 'image' => 'marca3'],
            ['description' => 'Kodak', 'image' => 'marca4'],
            ['description' => 'Rom', 'image' => 'marca5']
        ];

        foreach ($brands as $brand) {
            ProductBrand::create([
                'description' => $brand,
                'imagen' => $brand,
            ]);
        }
    }
}
