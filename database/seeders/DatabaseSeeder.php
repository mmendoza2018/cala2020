<?php

namespace Database\Seeders;

use App\Models\User;
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
            CategoriesProductsSeeder::class,
            MeasurementUnitsTableSeeder::class,
            ProductBrandsTableSeeder::class,
            AttributeGroupSeeder::class,
            AttributeSeeder::class,
            PriceTypesSeeder::class,
            UserSeeder::class
        ]);
    }
}
