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
            'Aviagen',
            'Nutripac',
            'Innova',
            'Cipral',
            'Cornat',
            'Agrovet Market',
            'Elanco',
            'Nutriave',
            'Industrias San Miguel (ISM)',
            'Leche Gloria'
        ];

        foreach ($brands as $brand) {
            ProductBrand::create([
                'description' => $brand,
            ]);
        }
    }
}
