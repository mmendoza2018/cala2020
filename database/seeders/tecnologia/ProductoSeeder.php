<?php

namespace Database\Seeders\tecnologia;

use Illuminate\Database\Seeder;
use App\Services\ProductImportService;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $active_brand = config('tienda.active_brand');
        $active_subcategory = config('tienda.active_subcategory');

        $nameStore = 'tecnologia';
        $accesoriosCategoria = 1;
        $equiposCategoria = 2;

        $computadorasSubcategorias = 1;
        $laptopsSubcategorias = 2;
        $tecladosSubcategorias = 3;

        $service = new ProductImportService();

        $arrayProducts = [
            [
                'title' => 'Computadora Gamer Ryzen 7 con Tarjeta Gráfica RTX 4060',
                'code' => 'TEC-EQU-COM-001',
                'description' => 'Estación de juego de alto rendimiento equipada con procesador AMD Ryzen 7, tarjeta gráfica NVIDIA RTX 4060, 32GB de RAM y SSD de 1TB. Ideal para gaming extremo, streaming y edición de video profesional.',
                'slug' => 'computadora-gamer-ryzen7-rtx4060',
                'category_product_id' => $equiposCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $computadorasSubcategorias : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['computadoras/1-1.webp', 'computadoras/1-2.webp', 'computadoras/1-3.webp'],
                'stock_range' => [5, 15],
                'price_range' => [4800, 6200]
            ],
            [
                'title' => 'PC de Oficina Intel Core i5 con Monitor 22"',
                'code' => 'TEC-EQU-COM-002',
                'description' => 'Computadora de escritorio pensada para oficinas y uso diario. Incluye procesador Intel Core i5, 8GB de RAM, disco SSD de 256GB y monitor de 22 pulgadas. Bajo consumo de energía y excelente rendimiento multitarea.',
                'slug' => 'pc-oficina-intel-i5-monitor-22',
                'category_product_id' => $equiposCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $computadorasSubcategorias : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['computadoras/2-1.webp', 'computadoras/2-2.webp', 'computadoras/2-3.webp', 'computadoras/2-4.webp', 'computadoras/2-5.webp'],
                'stock_range' => [10, 25],
                'price_range' => [1500, 2200]
            ],




            [
                'title' => 'Laptop Ultrabook Intel Evo i5 13.3" Full HD',
                'code' => 'TEC-EQU-LAP-001',
                'description' => 'Elegante ultrabook con procesador Intel Evo i5 de 11ª generación, pantalla de 13.3" Full HD, 8GB de RAM y SSD de 512GB. Ideal para profesionales que buscan portabilidad y velocidad.',
                'slug' => 'laptop-ultrabook-intel-evo-i5',
                'category_product_id' => $equiposCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $laptopsSubcategorias : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['laptops/1-1.webp', 'laptops/1-2.webp',  'laptops/1-3.webp', 'laptops/1-4.webp', 'laptops/1-5.webp'],
                'stock_range' => [8, 20],
                'price_range' => [3200, 4200]
            ],
            [
                'title' => 'Laptop Gamer Ryzen 9 con Gráfica RTX 4070',
                'code' => 'TEC-EQU-LAP-002',
                'description' => 'Laptop de alto rendimiento para gamers exigentes, con procesador AMD Ryzen 9, GPU NVIDIA RTX 4070, pantalla 16" QHD a 165Hz y 32GB de RAM. Diseño robusto y refrigeración avanzada.',
                'slug' => 'laptop-gamer-ryzen9-rtx4070',
                'category_product_id' => $equiposCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $laptopsSubcategorias : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['laptops/2-1.webp', 'laptops/2-2.webp', 'laptops/2-3.webp', 'laptops/2-4.webp'],
                'stock_range' => [3, 10],
                'price_range' => [6800, 8200]
            ],
            [
                'title' => 'Laptop Lenovo IdeaPad 3 Ryzen 5',
                'code' => 'TEC-EQU-LAP-003',
                'description' => 'Laptop versátil con procesador Ryzen 5, 12GB de RAM y SSD de 256GB. Ideal para estudiantes, trabajo remoto y entretenimiento multimedia. Pantalla de 15.6" HD antirreflejo.',
                'slug' => 'laptop-lenovo-ideapad-ryzen5',
                'category_product_id' => $equiposCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $laptopsSubcategorias : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['laptops/3-1.webp', 'laptops/3-2.webp', 'laptops/3-3.webp', 'laptops/3-4.webp', 'laptops/3-5.webp'],
                'stock_range' => [15, 35],
                'price_range' => [1800, 2400]
            ],



            [
                'title' => 'Teclado Mecánico RGB Retroiluminado',
                'code' => 'TEC-ACC-TEC-001',
                'description' => 'Teclado mecánico profesional con retroiluminación RGB personalizable, switches azules para una escritura táctil y precisa, ideal para gamers y programadores. Construcción robusta con reposamuñecas desmontable.',
                'slug' => 'teclado-mecanico-rgb-retroiluminado',
                'category_product_id' => $accesoriosCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $tecladosSubcategorias : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['teclados/1-1.webp', 'teclados/1-2.webp', 'teclados/1-3.webp'], 'teclados/1-4.webp',
                'stock_range' => [20, 60],
                'price_range' => [150, 280]
            ],
            [
                'title' => 'Teclado Inalámbrico Slim con Touchpad',
                'code' => 'TEC-ACC-TEC-002',
                'description' => 'Teclado inalámbrico ultra delgado con diseño compacto y touchpad integrado. Ideal para smart TVs, tablets o presentaciones. Conectividad vía Bluetooth y batería recargable de larga duración.',
                'slug' => 'teclado-inalambrico-slim-touchpad',
                'category_product_id' => $accesoriosCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $tecladosSubcategorias : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['teclados/2-1.webp', 'teclados/2-2.webp'],
                'stock_range' => [15, 40],
                'price_range' => [90, 160]
            ]
        ];

        foreach ($arrayProducts as $product) {
            $service->crearProducto($product, $nameStore, "Estandar", "Gamer");
        }
    }
}
