<?php

namespace Database\Seeders\hogar;

use Illuminate\Database\Seeder;
use App\Services\ProductImportService;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $active_brand = config('tienda.active_brand');
        $active_subcategory = config('tienda.active_subcategory');

        $nameStore = 'hogar';
        $decoracionCategoria = 1;
        $mueblesCategoria = 2;

        $camasSubcategoria = 1;
        $comedoresSubcategoria = 2;
        $sofasSubcategoria = 3;

        $service = new ProductImportService();

        $arrayProducts = [
            [
                'title' => 'Cama Queen Con Cajones de Almacenamiento',
                'code' => 'HOG-DEC-CAM-001',
                'description' => 'Cama tamaño Queen fabricada en melamina de alta resistencia, con cuatro amplios cajones de almacenamiento laterales. Diseño moderno y funcional, ideal para optimizar el espacio del dormitorio.',
                'slug' => 'cama-queen-cajones-almacenamiento',
                'category_product_id' => $mueblesCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $camasSubcategoria : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['camas/1-1.webp', 'camas/1-2.webp', 'camas/1-3.webp', 'camas/1-4.webp'],
                'stock_range' => [5, 20],
                'price_range' => [1200, 1800]
            ],
            [
                'title' => 'Cama Matrimonial Minimalista Madera Natural',
                'code' => 'HOG-DEC-CAM-002',
                'description' => 'Cama matrimonial de diseño minimalista, elaborada en madera maciza con acabado natural. Estructura sólida y elegante, perfecta para ambientes modernos o rústicos.',
                'slug' => 'cama-matrimonial-minimalista-madera',
                'category_product_id' => $mueblesCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $camasSubcategoria : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['camas/2-1.webp', 'camas/2-2.webp', 'camas/2-3.webp', 'camas/2-4.webp'],
                'stock_range' => [8, 25],
                'price_range' => [900, 1400]
            ],
            [
                'title' => 'Cama Individual con Cajón y Respaldo',
                'code' => 'HOG-DEC-CAM-003',
                'description' => 'Cama individual ideal para habitaciones juveniles o de huéspedes. Incluye práctico cajón inferior y respaldo tapizado en tela gris. Diseño compacto y funcional.',
                'slug' => 'cama-individual-cajon-respaldo',
                'category_product_id' => $mueblesCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $camasSubcategoria : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['camas/3-1.webp', 'camas/3-2.webp', 'camas/3-3.webp'],
                'stock_range' => [10, 30],
                'price_range' => [700, 1100]
            ],
            [
                'title' => 'Cama King Tapizada con Respaldo Acolchado',
                'code' => 'HOG-DEC-CAM-004',
                'description' => 'Cama tamaño King con estructura tapizada en tela suave y respaldo acolchado de gran tamaño. Ideal para dormitorios amplios que buscan estilo y confort.',
                'slug' => 'cama-king-tapizada-respaldo-acolchado',
                'category_product_id' => $mueblesCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $camasSubcategoria : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['camas/4-1.webp', 'camas/4-2.webp', 'camas/4-3.webp', 'camas/4-4.webp'],
                'stock_range' => [3, 12],
                'price_range' => [1500, 2200]
            ],
            [
                'title' => 'Cama Moderna con Base Flotante',
                'code' => 'HOG-DEC-CAM-005',
                'description' => 'Cama de diseño moderno con base flotante y estructura en acabado mate. Genera un efecto visual elegante y minimalista. Disponible en tamaño matrimonial y Queen.',
                'slug' => 'cama-moderna-base-flotante',
                'category_product_id' => $mueblesCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $camasSubcategoria : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['camas/5-1.webp', 'camas/5-2.webp', 'camas/5-3.webp'],
                'stock_range' => [6, 20],
                'price_range' => [1000, 1600]
            ],


            [
                'title' => 'Sofá 3 Plazas Tapizado en Lino Gris',
                'code' => 'HOG-MUE-SOF-001',
                'description' => 'Sofá de 3 plazas con estructura reforzada y tapizado en lino gris de alta resistencia. Diseño moderno y elegante, ideal para salas de estar o living rooms.',
                'slug' => 'sofa-3-plazas-tapizado-lino-gris',
                'category_product_id' => $mueblesCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $sofasSubcategoria : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['sofas/1-1.webp', 'sofas/1-2.webp', 'sofas/1-3.webp', 'sofas/1-4.webp', 'sofas/1-5.webp'],
                'stock_range' => [8, 20],
                'price_range' => [1200, 1900]
            ],
            [
                'title' => 'Sofá Reclinable 2 Plazas Confort Relax',
                'code' => 'HOG-MUE-SOF-002',
                'description' => 'Sofá reclinable de 2 plazas, con mecanismo manual de reclinación y acolchado ergonómico. Perfecto para disfrutar de momentos de descanso en casa.',
                'slug' => 'sofa-reclinable-2-plazas-confort-relax',
                'category_product_id' => $mueblesCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $sofasSubcategoria : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['sofas/2-1.webp', 'sofas/2-2.webp', 'sofas/2-3.webp', 'sofas/2-4.webp'],
                'stock_range' => [5, 15],
                'price_range' => [1400, 2200]
            ],
            [
                'title' => 'Sofá Esquinero Modular con Chaise Longue',
                'code' => 'HOG-MUE-SOF-003',
                'description' => 'Sofá esquinero modular con chaise longue, ideal para espacios amplios. Tapizado en tela antimanchas y estructura de madera maciza. Diseño versátil y moderno.',
                'slug' => 'sofa-esquinero-modular-chaise-longue',
                'category_product_id' => $mueblesCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $sofasSubcategoria : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['sofas/3-1.webp', 'sofas/3-2.webp', 'sofas/3-3.webp', 'sofas/3-4.webp', 'sofas/3-5.webp', 'sofas/3-6.webp'],
                'stock_range' => [3, 10],
                'price_range' => [2000, 3200]
            ],
            [
                'title' => 'Sofá 2 Plazas Vintage Cuero Sintético',
                'code' => 'HOG-MUE-SOF-004',
                'description' => 'Sofá de 2 plazas estilo vintage, tapizado en cuero sintético de alta calidad. Aporta un toque retro y elegante a la sala o estudio.',
                'slug' => 'sofa-2-plazas-vintage-cuero-sintetico',
                'category_product_id' => $mueblesCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $sofasSubcategoria : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['sofas/4-1.webp', 'sofas/4-2.webp'],
                'stock_range' => [7, 18],
                'price_range' => [1100, 1700]
            ],



            [
                'title' => 'Centro de Mesa Decorativo Mármol Blanco',
                'code' => 'HOG-DEC-COM-001',
                'description' => 'Centro de mesa decorativo elaborado en mármol blanco con detalles metálicos dorados. Ideal para darle un toque elegante y sofisticado a tu comedor.',
                'slug' => 'centro-mesa-decorativo-marmol-blanco',
                'category_product_id' => $decoracionCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $comedoresSubcategoria : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['comedores/1-1.webp', 'comedores/1-2.webp', 'comedores/1-3.webp', 'comedores/1-4.webp'],
                'stock_range' => [15, 50],
                'price_range' => [180, 350]
            ],
            [
                'title' => 'Cuadro Decorativo Tríptico Abstracto',
                'code' => 'HOG-DEC-COM-002',
                'description' => 'Set de tres cuadros decorativos con diseño abstracto en tonos neutros, perfecto para realzar la pared del comedor y darle un aire moderno al ambiente.',
                'slug' => 'cuadro-decorativo-triptico-abstracto',
                'category_product_id' => $decoracionCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $comedoresSubcategoria : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['comedores/2-1.webp', 'comedores/2-2.webp', 'comedores/2-3.webp'],
                'stock_range' => [10, 40],
                'price_range' => [300, 600]
            ],
            [
                'title' => 'Camino de Mesa Tejido Natural',
                'code' => 'HOG-DEC-COM-003',
                'description' => 'Camino de mesa elaborado en fibras naturales, ideal para mesas de comedor rectangulares o redondas. Aporta calidez y estilo rústico al espacio.',
                'slug' => 'camino-mesa-tejido-natural',
                'category_product_id' => $decoracionCategoria,
                'subcategory_product_id' => $active_subcategory === "1" ? $comedoresSubcategoria : null,
                'product_brand_id' => $active_brand === "1" ? rand(1, 5) : null,
                'measurement_unit_id' => null,
                'image_names' => ['comedores/3-1.webp', 'comedores/3-2.webp', 'comedores/3-3.webp', 'comedores/3-4.webp', 'comedores/3-5.webp'],
                'stock_range' => [25, 80],
                'price_range' => [90, 180]
            ],
        ];

        foreach ($arrayProducts as $product) {
            $service->crearProducto($product, $nameStore, "Calidad", "Dimensión");
        }
    }
}
