<?php

namespace Database\Seeders;

use Database\Seeders\ropa\CategoriasSeeder;
use Database\Seeders\ropa\SubcategoriasSeeder;
use Database\Seeders\ropa\AttributeSeeder;
use Database\Seeders\ropa\AttributeGroupSeeder;
use Database\Seeders\ropa\ProductoSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            GeneralSeeder::class,
            UserSeeder::class,
            AttributeGroupSeeder::class,
            AttributeSeeder::class,
            CategoriasSeeder::class,
            SubcategoriasSeeder::class,
            MeasurementUnitsTableSeeder::class,
            ProductBrandsTableSeeder::class,
            ProductoSeeder:: class,
            PriceTypesSeeder::class,
            ThemeSeeder::class,
            LegalitySeeder::class
        ]);
    }
}
