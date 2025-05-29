<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\ropa\CategoriasRopaSeeder;
use Database\Seeders\ropa\SubcategoriasRopaSeeder;
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
            CategoriasRopaSeeder::class,
            SubcategoriasRopaSeeder::class,
            MeasurementUnitsTableSeeder::class,
            ProductBrandsTableSeeder::class,
            AttributeGroupSeeder::class,
            AttributeSeeder::class,
            PriceTypesSeeder::class,
            UserSeeder::class,
            ThemeSeeder::class,
            LegalitySeeder::class
        ]);
    }
}
