<?php

namespace Database\Seeders\ropa;

use Illuminate\Database\Seeder;
use App\Services\ProductImportService;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $active_brand = config('tienda.active_brand');
        $active_subcategory = config('tienda.active_subcategory');

        $nameStore = 'ropa';

        $hombreCategoria = 1;
        $mujerCategoria = 2;
        $ninioCategoria = 3;
        $niniaCategoria = 4;

        $topsSubcategoria = 1;
        $blusasSubcategoria = 2;
        $tacosSubcategoria = 3;
        $zapatosSubcategoria = 4;
        $camisasSubcategoria = 5;

        $service = new ProductImportService();

        $arrayProducts = [
            [
                'title' => 'Camisa Casual Slim Fit Hombre',
                'code' => 'HOM-174',
                'description' => 'Esta camisa casual Slim Fit para hombre está confeccionada en algodón suave de alta calidad, perfecta para el día a día o salidas informales. Su diseño moderno y ajuste entallado ofrece comodidad y estilo, ideal para combinar con jeans o pantalones chinos. Disponible en varios colores vibrantes.',
                'slug' => 'camisa-casual-slim-fit-hombre',
                'category_product_id' => $hombreCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $camisasSubcategoria : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['hombres/Camisas/1-1.webp', 'hombre/Camisas/1-2.webp', 'hombre/Camisas/1-3.webp', 'hombre/Camisas/1-4.webp'],
                'stock_range' => [100, 500],
                'price_range' => [50, 100]
            ],
            [
                'title' => 'Camisa Formal de Algodón Hombre',
                'code' => 'HOM-259',
                'description' => 'Camisa formal para hombre, elaborada con algodón 100% premium, ideal para ocasiones laborales y eventos especiales. Su corte clásico y detalles cuidados como botones reforzados y costuras finas, aseguran elegancia y durabilidad. Fácil de combinar con trajes o pantalones formales.',
                'slug' => 'camisa-formal-de-algodon-hombre',
                'category_product_id' => $hombreCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $camisasSubcategoria : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['hombre/Camisas/2-1.webp', 'hombre/Camisas/2-2.webp', 'hombre/Camisas/2-3.webp', 'hombre/Camisas/2-4.webp'],
                'stock_range' => [150, 400],
                'price_range' => [60, 110]
            ],

            [
                'title' => 'Top Casual Mujer Escote Redondo',
                'code' => 'MUJ-' . rand(1000, 9999),
                'description' => 'Top casual para mujer con escote redondo y diseño sencillo. Perfecto para outfits relajados o para combinar con jeans o faldas.',
                'slug' => 'top-casual-mujer-escote-redondo',
                'category_product_id' => $mujerCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $topsSubcategoria : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['Mujer/Tops/1-1.png', 'Mujer/Tops/1-2.png', 'Mujer/Tops/1-3.png'],
                'stock_range' => [100, 350],
                'price_range' => [120, 180]
            ],
            [
                'title' => 'Top Deportivo Mujer Tirantes Anchos',
                'code' => 'MUJ-' . rand(1000, 9999),
                'description' => 'Top deportivo con tirantes anchos para mujer. Su diseño brinda soporte y confort para entrenamientos de intensidad media a alta.',
                'slug' => 'top-deportivo-mujer-tirantes-anchos',
                'category_product_id' => $mujerCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $topsSubcategoria : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['Mujer/Tops/2-1.webp', 'Mujer/Tops/2-2.webp', 'Mujer/Tops/2-3.webp', 'Mujer/Tops/2-4.webp', 'Mujer/Tops/2-5.webp'],
                'stock_range' => [80, 300],
                'price_range' => [150, 220]
            ],
            [
                'title' => 'Tacones Elegantes Mujer Punta Fina',
                'code' => 'MUJ-' . rand(1000, 9999),
                'description' => 'Tacones elegantes para mujer con diseño de punta fina y acabado sofisticado. Ideales para eventos formales o salidas nocturnas.',
                'slug' => 'tacones-elegantes-mujer-punta-fina',
                'category_product_id' => $mujerCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $tacosSubcategoria : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['Mujer/Tacos/1-1.webp', 'Mujer/Tacos/1-2.webp', 'Mujer/Tacos/1-3.webp', 'Mujer/Tacos/1-4.webp'],
                'stock_range' => [100, 350],
                'price_range' => [120, 180]
            ],
            [
                'title' => 'Tacos Altos Mujer Plataforma Cómoda',
                'code' => 'MUJ-' . rand(1000, 9999),
                'description' => 'Tacos altos con plataforma y diseño cómodo para mujer. Perfectos para lucir más alta sin sacrificar confort en el uso prolongado.',
                'slug' => 'tacos-altos-mujer-plataforma-comoda',
                'category_product_id' => $mujerCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $tacosSubcategoria : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['Mujer/Tacos/2-1.webp', 'Mujer/Tacos/2-2.webp', 'Mujer/Tacos/2-3.webp', 'Mujer/Tacos/2-4.webp'],
                'stock_range' => [80, 300],
                'price_range' => [150, 220]
            ],

            [
                'title' => 'Blusa Casual Mujer Elegante',
                'code' => 'MUJ-' . rand(1000, 9999),
                'description' => 'Blusa casual para mujer con diseño elegante y confortable. Ideal para combinar con jeans o faldas, perfecta para un look fresco y moderno en cualquier ocasión.',
                'slug' => 'blusa-casual-mujer-elegante',
                'category_product_id' => $mujerCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $blusasSubcategoria : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['Mujer/Blusas/1-1.webp', 'Mujer/Blusas/1-2.webp', 'Mujer/Blusas/1-3.webp', 'Mujer/Blusas/1-4.webp', 'Mujer/Blusas/1-5.webp'],
                'stock_range' => [100, 350],
                'price_range' => [120, 180]
            ],
            [
                'title' => 'Polo Niño Casual Manga Corta',
                'code' => 'NIN-' . rand(1000, 9999),
                'description' => 'Polo casual para niño con manga corta y cuello clásico. Ideal para el día a día, combinable con jeans o shorts.',
                'slug' => 'polo-nino-casual-manga-corta',
                'category_product_id' => $ninioCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $camisasSubcategoria : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['Ninio/Polos/1-1.webp', 'Ninio/Polos/1-2.webp', 'Ninio/Polos/1-3.webp', 'Ninio/Polos/1-4.webp'],
                'stock_range' => [100, 350],
                'price_range' => [120, 180]
            ],
        ];

        foreach ($arrayProducts as $product) {
            $service->crearProducto($product, $nameStore, "Calidad", "Tamaño");
        }
    }
}
