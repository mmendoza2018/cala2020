<?php

namespace Database\Seeders;

use Database\Seeders\ropademo\CategoriasSeeder;
use Database\Seeders\ropademo\SubcategoriasSeeder;
use Database\Seeders\ropademo\AttributeSeeder;
use Database\Seeders\ropademo\AttributeGroupSeeder;
use Database\Seeders\ropademo\ProductoSeeder;
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
