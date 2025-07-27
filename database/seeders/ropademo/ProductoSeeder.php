<?php

namespace Database\Seeders\ropademo;

use Illuminate\Database\Seeder;
use App\Services\ProductImportService;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $nameStore = 'ropa';
        $hombreCategoria = 1;
        $mujerCategoria = 2;
        $ninioCategoria = 3;
        $niniaCategoria = 4;
        $blusasSubcategoria = 1;
        $camisasSubcategoria = 2;
        $deportivosSubcategoria = 3;
        $gorrasSubcategoria = 4;
        $jeansSubcategoria = 5;
        $polosSubcategoria = 6;
        $sacosSubcategoria = 7;
        $tacosSubcategoria = 8;
        $topsSubcategoria = 9;
        $vestidosSubcategoria = 10;
        $zapatosSubcategoria = 11;
        $abrigosSubcategoria = 12;
        $service = new ProductImportService();

        $arrayProducts = [
            [
                'title' => 'Camisa Casual Slim Fit Hombre',
                'code' => 'HOM-174',
                'description' => 'Esta camisa casual Slim Fit para hombre está confeccionada en algodón suave de alta calidad, perfecta para el día a día o salidas informales. Su diseño moderno y ajuste entallado ofrece comodidad y estilo, ideal para combinar con jeans o pantalones chinos. Disponible en varios colores vibrantes.',
                'slug' => 'camisa-casual-slim-fit-hombre',
                'category_product_id' => $hombreCategoria,
                'subcategory_product_id' => $camisasSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['hombre/Camisas/1-1.webp', 'hombre/Camisas/1-2.webp', 'hombre/Camisas/1-3.webp', 'hombre/Camisas/1-4.webp'],
                'stock_range' => [100, 500],
                'price_range' => [50, 100]
            ],
            [
                'title' => 'Camisa Formal de Algodón Hombre',
                'code' => 'HOM-259',
                'description' => 'Camisa formal para hombre, elaborada con algodón 100% premium, ideal para ocasiones laborales y eventos especiales. Su corte clásico y detalles cuidados como botones reforzados y costuras finas, aseguran elegancia y durabilidad. Fácil de combinar con trajes o pantalones formales.',
                'slug' => 'camisa-formal-de-algodon-hombre',
                'category_product_id' => $hombreCategoria,
                'subcategory_product_id' => $camisasSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['hombre/Camisas/2-1.webp', 'hombre/Camisas/2-2.webp', 'hombre/Camisas/2-3.webp', 'hombre/Camisas/2-4.webp'],
                'stock_range' => [150, 400],
                'price_range' => [60, 110]
            ],
            [
                'title' => 'Vivirie Deportivo Hombre - Estilo Activo',
                'code' => 'HOM-1740',
                'description' => 'Vivirie deportivo diseñado para el hombre moderno que busca comodidad y rendimiento. Fabricado en tela transpirable y de secado rápido, ideal para entrenamientos, caminatas o rutinas fitness. Su corte ergonómico y diseño contemporáneo lo convierten en una prenda esencial para cualquier actividad deportiva.',
                'slug' => 'vivirie-deportivo-hombre-estilo-activo',
                'category_product_id' => $hombreCategoria,
                'subcategory_product_id' => $deportivosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['hombre/Deportivos/1-1.webp', 'hombre/Deportivos/1-2.webp', 'hombre/Deportivos/1-3.webp'],
                'stock_range' => [100, 500],
                'price_range' => [50, 100]
            ],
            [
                'title' => 'Vivirie Training Hombre - Performance Fit',
                'code' => 'HOM-2590',
                'description' => 'Vivirie para entrenamiento masculino confeccionado en mezcla de poliéster elástico que permite libertad total de movimiento. Su tecnología de ventilación ayuda a mantener la piel seca incluso en los entrenamientos más exigentes. Un diseño versátil, ideal tanto para el gimnasio como para actividades al aire libre.',
                'slug' => 'vivirie-training-hombre-performance-fit',
                'category_product_id' => $hombreCategoria,
                'subcategory_product_id' => $deportivosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['hombre/Deportivos/2-1.webp', 'hombre/Deportivos/2-2.webp', 'hombre/Deportivos/2-3.webp'],
                'stock_range' => [150, 400],
                'price_range' => [60, 110]
            ],

            [
                'title' => 'Polo Deportivo Hombre Secado Rápido',
                'code' => 'HOM-8137',
                'description' => 'Polo deportivo para hombre elaborado con tejido técnico de secado rápido y tacto suave. Ideal para entrenamientos, caminatas o uso casual con un look fresco y moderno. Su corte regular garantiza libertad de movimiento sin perder estilo.',
                'slug' => 'polo-deportivo-hombre-secado-rapido',
                'category_product_id' => $hombreCategoria,
                'subcategory_product_id' => $polosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['hombre/Polos/1-1.webp', 'hombre/Polos/1-2.webp', 'hombre/Polos/1-3.webp', 'hombre/Polos/1-4.webp'],
                'stock_range' => [150, 400],
                'price_range' => [20, 60]
            ],
            [
                'title' => 'Polo Casual Hombre Estilo Urbano',
                'code' => 'HOM-9291',
                'description' => 'Polo casual con diseño urbano para el hombre moderno. Confeccionado en algodón suave con detalles en contraste en cuello y mangas. Ideal para combinar con jeans o joggers y mantener un look cómodo pero con actitud.',
                'slug' => 'polo-casual-hombre-estilo-urbano',
                'category_product_id' => $hombreCategoria,
                'subcategory_product_id' => $polosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['hombre/Polos/2-1.webp', 'hombre/Polos/2-2.webp'],
                'stock_range' => [100, 500],
                'price_range' => [20, 60]
            ],
            [
                'title' => 'Polo Training Hombre Transpirable',
                'code' => 'HOM-7648',
                'description' => 'Polo para entrenamiento confeccionado en tela transpirable que ayuda a mantener la frescura durante actividades físicas. Con diseño ergonómico y costuras reforzadas, es la prenda ideal para quienes buscan rendimiento sin sacrificar estilo.',
                'slug' => 'polo-training-hombre-transpirable',
                'category_product_id' => $hombreCategoria,
                'subcategory_product_id' => $polosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['hombre/Polos/3-1.webp', 'hombre/Polos/3-2.webp', 'hombre/Polos/3-3.webp', 'hombre/Polos/3-4.webp', 'hombre/Polos/3-5.webp'],
                'stock_range' => [150, 400],
                'price_range' => [20, 60]
            ],


            [
                'title' => 'Saco Casual Hombre Moderno',
                'code' => 'HOM-' . rand(1000, 9999),
                'description' => 'Saco casual para hombre con diseño moderno y corte ajustado. Confeccionado con telas de alta calidad para un look elegante y cómodo, ideal para eventos informales o salidas casuales.',
                'slug' => 'saco-casual-hombre-moderno',
                'category_product_id' => $hombreCategoria,
                'subcategory_product_id' => $sacosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['hombre/Sacos/1-1.webp', 'hombre/Sacos/1-2.webp', 'hombre/Sacos/1-3.webp', 'hombre/Sacos/1-4.webp'],
                'stock_range' => [100, 350],
                'price_range' => [120, 180]
            ],
            [
                'title' => 'Saco Formal Hombre Clásico',
                'code' => 'HOM-' . rand(1000, 9999),
                'description' => 'Saco formal clásico para hombre, ideal para la oficina o eventos especiales. Confeccionado con materiales resistentes y acabado impecable para un estilo sofisticado y profesional.',
                'slug' => 'saco-formal-hombre-clasico',
                'category_product_id' => $hombreCategoria,
                'subcategory_product_id' => $sacosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['hombre/Sacos/2-1.webp', 'hombre/Sacos/2-2.webp', 'hombre/Sacos/2-3.webp', 'hombre/Sacos/2-4.webp'],
                'stock_range' => [80, 300],
                'price_range' => [150, 220]
            ],
            [
                'title' => 'Saco Deportivo Hombre Transpirable',
                'code' => 'HOM-' . rand(1000, 9999),
                'description' => 'Saco deportivo diseñado para hombres activos, confeccionado con tela transpirable y ligera. Perfecto para actividades al aire libre o para un look casual con estilo y comodidad.',
                'slug' => 'saco-deportivo-hombre-transpirable',
                'category_product_id' => $hombreCategoria,
                'subcategory_product_id' => $sacosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['hombre/Sacos/3-1.webp', 'hombre/Sacos/3-2.webp', 'hombre/Sacos/3-3.webp'],
                'stock_range' => [120, 400],
                'price_range' => [100, 150]
            ],




            [
                'title' => 'Zapato Casual Hombre Moderno',
                'code' => 'HOM-' . rand(1000, 9999),
                'description' => 'Zapato casual para hombre con diseño moderno y cómodo. Fabricado con materiales duraderos y acabado impecable, ideal para uso diario o salidas informales.',
                'slug' => 'zapato-casual-hombre-moderno',
                'category_product_id' => $hombreCategoria,
                'subcategory_product_id' => $zapatosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['hombre/Zapatos/1-1.webp', 'hombre/Zapatos/1-2.webp', 'hombre/Zapatos/1-3.webp', 'hombre/Zapatos/1-4.webp', 'hombre/Zapatos/1-4.webp'],
                'stock_range' => [100, 350],
                'price_range' => [120, 180]
            ],
            [
                'title' => 'Zapato Formal Hombre Clásico',
                'code' => 'HOM-' . rand(1000, 9999),
                'description' => 'Zapato formal clásico para hombre, ideal para oficina y eventos especiales. Fabricado con cuero de alta calidad para un acabado elegante y duradero.',
                'slug' => 'zapato-formal-hombre-clasico',
                'category_product_id' => $hombreCategoria,
                'subcategory_product_id' => $zapatosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['hombre/Zapatos/2-1.webp', 'hombre/Zapatos/2-2.webp', 'hombre/Zapatos/2-3.webp'],
                'stock_range' => [80, 300],
                'price_range' => [150, 220]
            ],
            [
                'title' => 'Zapato Deportivo Hombre Ligero',
                'code' => 'HOM-' . rand(1000, 9999),
                'description' => 'Zapato deportivo para hombre, ligero y transpirable. Perfecto para actividades físicas o un estilo casual con comodidad y soporte en cada paso.',
                'slug' => 'zapato-deportivo-hombre-ligero',
                'category_product_id' => $hombreCategoria,
                'subcategory_product_id' => $zapatosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['hombre/Zapatos/3-1.webp', 'hombre/Zapatos/3-2.webp'],
                'stock_range' => [120, 400],
                'price_range' => [100, 150]
            ],


            [
                'title' => 'Abrigo Casual Mujer Moderno',
                'code' => 'MUJ-' . rand(1000, 9999),
                'description' => 'Abrigo casual para mujer con diseño moderno y cómodo. Confeccionado con materiales duraderos y acabado impecable, ideal para uso diario o salidas informales durante el clima frío.',
                'slug' => 'abrigo-casual-mujer-moderno',
                'category_product_id' => $mujerCategoria,
                'subcategory_product_id' => $abrigosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Mujer/Abrigos/1-1.webp', 'Mujer/Abrigos/1-2.webp', 'Mujer/Abrigos/1-3.webp', 'Mujer/Abrigos/1-4.webp', 'Mujer/Abrigos/1-5.webp'],
                'stock_range' => [100, 350],
                'price_range' => [120, 180]
            ],


            [
                'title' => 'Blusa Casual Mujer Elegante',
                'code' => 'MUJ-' . rand(1000, 9999),
                'description' => 'Blusa casual para mujer con diseño elegante y confortable. Ideal para combinar con jeans o faldas, perfecta para un look fresco y moderno en cualquier ocasión.',
                'slug' => 'blusa-casual-mujer-elegante',
                'category_product_id' => $mujerCategoria,
                'subcategory_product_id' => $blusasSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Mujer/Blusas/1-1.webp', 'Mujer/Blusas/1-2.webp', 'Mujer/Blusas/1-3.webp', 'Mujer/Blusas/1-4.webp', 'Mujer/Blusas/1-5.webp'],
                'stock_range' => [100, 350],
                'price_range' => [120, 180]
            ],
            [
                'title' => 'Blusa Formal Mujer Clásica',
                'code' => 'MUJ-' . rand(1000, 9999),
                'description' => 'Blusa formal para mujer con corte clásico y materiales de alta calidad. Ideal para la oficina o eventos formales, con un acabado impecable que resalta elegancia.',
                'slug' => 'blusa-formal-mujer-clasica',
                'category_product_id' => $mujerCategoria,
                'subcategory_product_id' => $blusasSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Mujer/Blusas/2-1.webp', 'Mujer/Blusas/2-2.webp', 'Mujer/Blusas/2-3.webp'],
                'stock_range' => [80, 300],
                'price_range' => [150, 220]
            ],
            [
                'title' => 'Blusa Veraniega Mujer Ligera',
                'code' => 'MUJ-' . rand(1000, 9999),
                'description' => 'Blusa ligera y fresca, perfecta para el verano. Confeccionada en telas transpirables y con diseño ergonómico para máxima comodidad y estilo.',
                'slug' => 'blusa-veraniega-mujer-ligera',
                'category_product_id' => $mujerCategoria,
                'subcategory_product_id' => $blusasSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Mujer/Blusas/3-1.webp', 'Mujer/Blusas/3-2.webp', 'Mujer/Blusas/3-3.webp'],
                'stock_range' => [120, 400],
                'price_range' => [100, 150]
            ],



            [
                'title' => 'Gorra Casual Mujer Ajustable',
                'code' => 'MUJ-' . rand(1000, 9999),
                'description' => 'Gorra casual para mujer con diseño moderno y ajuste regulable. Ideal para proteger del sol con estilo en salidas diarias o actividades al aire libre.',
                'slug' => 'gorra-casual-mujer-ajustable',
                'category_product_id' => $mujerCategoria,
                'subcategory_product_id' => $gorrasSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Mujer/Gorras/1-1.webp', 'Mujer/Gorras/1-2.webp', 'Mujer/Gorras/1-3.webp', 'Mujer/Gorras/1-4.webp'],
                'stock_range' => [100, 350],
                'price_range' => [120, 180]
            ],
            [
                'title' => 'Gorra Deportiva Mujer Transpirable',
                'code' => 'MUJ-' . rand(1000, 9999),
                'description' => 'Gorra deportiva para mujer fabricada con materiales transpirables y livianos. Perfecta para entrenamientos o actividades bajo el sol.',
                'slug' => 'gorra-deportiva-mujer-transpirable',
                'category_product_id' => $mujerCategoria,
                'subcategory_product_id' => $gorrasSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Mujer/Gorras/2-1.webp', 'Mujer/Gorras/2-2.webp', 'Mujer/Gorras/2-3.webp', 'Mujer/Gorras/2-4.webp', 'Mujer/Gorras/2-5.webp'],
                'stock_range' => [80, 300],
                'price_range' => [150, 220]
            ],
            [
                'title' => 'Gorra Estilo Urbano Mujer',
                'code' => 'MUJ-' . rand(1000, 9999),
                'description' => 'Gorra estilo urbano con visera curva y diseño único para mujeres modernas. Ideal para complementar atuendos streetwear con un toque distintivo.',
                'slug' => 'gorra-estilo-urbano-mujer',
                'category_product_id' => $mujerCategoria,
                'subcategory_product_id' => $gorrasSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Mujer/Gorras/3-1.webp', 'Mujer/Gorras/3-2.webp', 'Mujer/Gorras/3-3.webp', 'Mujer/Gorras/3-4.webp'],
                'stock_range' => [120, 400],
                'price_range' => [100, 150]
            ],



            [
                'title' => 'Jeans Skinny Mujer Azul Clásico',
                'code' => 'MUJ-' . rand(1000, 9999),
                'description' => 'Jeans skinny para mujer en color azul clásico. Diseño ceñido que estiliza la figura, ideal para uso diario con cualquier tipo de calzado.',
                'slug' => 'jeans-skinny-mujer-azul-clasicos',
                'category_product_id' => $mujerCategoria,
                'subcategory_product_id' => $jeansSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Mujer/Jeans/1-1.webp', 'Mujer/Jeans/1-2.webp', 'Mujer/Jeans/1-3.webp', 'Mujer/Jeans/1-4.webp'],
                'stock_range' => [100, 350],
                'price_range' => [120, 180]
            ],
            [
                'title' => 'Jeans Mom Fit Mujer Tiro Alto',
                'code' => 'MUJ-' . rand(1000, 9999),
                'description' => 'Jeans estilo mom fit para mujer, tiro alto con corte relajado y moderno. Perfectos para looks casuales con un toque vintage.',
                'slug' => 'jeans-mom-fit-mujer-tiro-alto',
                'category_product_id' => $mujerCategoria,
                'subcategory_product_id' => $jeansSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Mujer/Jeans/2-1.webp', 'Mujer/Jeans/2-2.webp', 'Mujer/Jeans/2-3.webp'],
                'stock_range' => [80, 300],
                'price_range' => [150, 220]
            ],
            [
                'title' => 'Jeans Recto Mujer Lavado Medio',
                'code' => 'MUJ-' . rand(1000, 9999),
                'description' => 'Jeans corte recto para mujer con lavado medio. Comodidad y versatilidad para combinar con camisas o blusas en cualquier temporada.',
                'slug' => 'jeans-recto-mujer-lavado-medio',
                'category_product_id' => $mujerCategoria,
                'subcategory_product_id' => $jeansSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Mujer/Jeans/3-1.webp'],
                'stock_range' => [120, 400],
                'price_range' => [100, 150]
            ],


            [
                'title' => 'Polo Casual Mujer Manga Corta',
                'code' => 'MUJ-' . rand(1000, 9999),
                'description' => 'Polo casual para mujer con manga corta y cuello clásico. Ideal para el día a día, combina estilo y comodidad en un diseño versátil.',
                'slug' => 'polo-casual-mujer-manga-corta',
                'category_product_id' => $mujerCategoria,
                'subcategory_product_id' => $polosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Mujer/Polos/1-1.webp', 'Mujer/Polos/1-2.webp'],
                'stock_range' => [100, 350],
                'price_range' => [120, 180]
            ],
            [
                'title' => 'Polo Deportivo Mujer Secado Rápido',
                'code' => 'MUJ-' . rand(1000, 9999),
                'description' => 'Polo deportivo para mujer con tecnología de secado rápido. Ligero y transpirable, ideal para entrenamientos o actividades al aire libre.',
                'slug' => 'polo-deportivo-mujer-secado-rapido',
                'category_product_id' => $mujerCategoria,
                'subcategory_product_id' => $polosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Mujer/Polos/2-1.webp', 'Mujer/Polos/2-2.webp', 'Mujer/Polos/2-3.webp'],
                'stock_range' => [80, 300],
                'price_range' => [150, 220]
            ],


            [
                'title' => 'Tacones Elegantes Mujer Punta Fina',
                'code' => 'MUJ-' . rand(1000, 9999),
                'description' => 'Tacones elegantes para mujer con diseño de punta fina y acabado sofisticado. Ideales para eventos formales o salidas nocturnas.',
                'slug' => 'tacones-elegantes-mujer-punta-fina',
                'category_product_id' => $mujerCategoria,
                'subcategory_product_id' => $tacosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
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
                'subcategory_product_id' => $tacosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Mujer/Tacos/2-1.webp', 'Mujer/Tacos/2-2.webp', 'Mujer/Tacos/2-3.webp', 'Mujer/Tacos/2-4.webp'],
                'stock_range' => [80, 300],
                'price_range' => [150, 220]
            ],



            [
                'title' => 'Top Casual Mujer Escote Redondo',
                'code' => 'MUJ-' . rand(1000, 9999),
                'description' => 'Top casual para mujer con escote redondo y diseño sencillo. Perfecto para outfits relajados o para combinar con jeans o faldas.',
                'slug' => 'top-casual-mujer-escote-redondo',
                'category_product_id' => $mujerCategoria,
                'subcategory_product_id' => $topsSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
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
                'subcategory_product_id' => $topsSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Mujer/Tops/2-1.webp', 'Mujer/Tops/2-2.webp', 'Mujer/Tops/2-3.webp', 'Mujer/Tops/2-4.webp', 'Mujer/Tops/2-5.webp'],
                'stock_range' => [80, 300],
                'price_range' => [150, 220]
            ],
            [
                'title' => 'Top Elegante Mujer Sin Mangas',
                'code' => 'MUJ-' . rand(1000, 9999),
                'description' => 'Top elegante sin mangas para mujer, ideal para ocasiones especiales o para combinar con blazer y pantalón formal.',
                'slug' => 'top-elegante-mujer-sin-mangas',
                'category_product_id' => $mujerCategoria,
                'subcategory_product_id' => $topsSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Mujer/Tops/3-1.webp', 'Mujer/Tops/3-2.webp', 'Mujer/Tops/3-3.webp', 'Mujer/Tops/3-4.webp'],
                'stock_range' => [120, 400],
                'price_range' => [100, 150]
            ],



            [
                'title' => 'Vestido Casual Mujer Escote',
                'code' => 'MUJ-' . rand(1000, 9999),
                'description' => 'Vestido casual para mujer con escote y diseño fluido. Ideal para un look relajado y cómodo, perfecto para el día a día.',
                'slug' => 'vestido-casual-mujer-escote',
                'category_product_id' => $mujerCategoria,
                'subcategory_product_id' => $vestidosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Mujer/Vestidos/1-1.webp', 'Mujer/Vestidos/1-2.webp', 'Mujer/Vestidos/1-3.webp', 'Mujer/Vestidos/1-4.webp', 'Mujer/Vestidos/1-5.webp'],
                'stock_range' => [100, 350],
                'price_range' => [120, 180]
            ],

            [
                'title' => 'Vestido Casual Niña Estampado Floral',
                'code' => 'NIN-' . rand(1000, 9999),
                'description' => 'Vestido casual para niña con estampado floral y corte cómodo. Ideal para salidas familiares, días soleados o eventos escolares.',
                'slug' => 'vestido-casual-nina-estampado-floral',
                'category_product_id' => $niniaCategoria,
                'subcategory_product_id' => $vestidosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Ninia/Vestidos/1-1.webp', 'Ninia/Vestidos/1-2.webp', 'Ninia/Vestidos/1-3.webp', 'Ninia/Vestidos/2-4.webp', 'Ninia/Vestidos/2-5.webp'],
                'stock_range' => [100, 350],
                'price_range' => [120, 180]
            ],
            [
                'title' => 'Vestido Elegante Niña con Encaje',
                'code' => 'NIN-' . rand(1000, 9999),
                'description' => 'Vestido elegante para niña con detalles de encaje y falda con vuelo. Perfecto para fiestas, cumpleaños o celebraciones especiales.',
                'slug' => 'vestido-elegante-nina-con-encaje',
                'category_product_id' => $niniaCategoria,
                'subcategory_product_id' => $vestidosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Ninia/Vestidos/2-1.webp', 'Ninia/Vestidos/2-2.webp', 'Ninia/Vestidos/2-3.webp', 'Ninia/Vestidos/2-4.webp', 'Ninia/Vestidos/2-5.webp'],
                'stock_range' => [80, 300],
                'price_range' => [150, 220]
            ],



            [
                'title' => 'Polo Niño Casual Manga Corta',
                'code' => 'NIN-' . rand(1000, 9999),
                'description' => 'Polo casual para niño con manga corta y cuello clásico. Ideal para el día a día, combinable con jeans o shorts.',
                'slug' => 'polo-nino-casual-manga-corta',
                'category_product_id' => $ninioCategoria,
                'subcategory_product_id' => $polosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Ninio/Polos/1-1.webp', 'Ninio/Polos/1-2.webp', 'Ninio/Polos/1-3.webp', 'Ninio/Polos/1-4.webp'],
                'stock_range' => [100, 350],
                'price_range' => [120, 180]
            ],
            [
                'title' => 'Polo Niño Deportivo Dry Fit',
                'code' => 'NIN-' . rand(1000, 9999),
                'description' => 'Polo deportivo para niño confeccionado en tela dry fit, perfecta para actividades físicas y juegos al aire libre.',
                'slug' => 'polo-nino-deportivo-dry-fit',
                'category_product_id' => $ninioCategoria,
                'subcategory_product_id' => $polosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Ninio/Polos/2-1.webp', 'Ninio/Polos/2-2.webp', 'Ninio/Polos/2-3.webp'],
                'stock_range' => [80, 300],
                'price_range' => [150, 220]
            ],
            [
                'title' => 'Polo Niño Estilo Clásico con Bolsillo',
                'code' => 'NIN-' . rand(1000, 9999),
                'description' => 'Polo de estilo clásico para niño, con bolsillo frontal y botones. Una opción versátil y cómoda para diversas ocasiones.',
                'slug' => 'polo-nino-estilo-clasico-con-bolsillo',
                'category_product_id' => $ninioCategoria,
                'subcategory_product_id' => $polosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Ninio/Polos/3-1.webp', 'Ninio/Polos/3-2.webp', 'Ninio/Polos/3-3.webp'],
                'stock_range' => [120, 400],
                'price_range' => [100, 150]
            ],


            [
                'title' => 'Zapato Casual Niño con Cierre de Velcro',
                'code' => 'NIN-' . rand(1000, 9999),
                'description' => 'Zapato casual para niño con cierre de velcro para fácil ajuste. Cómodo y resistente, ideal para el uso diario y juegos en exteriores.',
                'slug' => 'zapato-casual-nino-cierre-velcro',
                'category_product_id' => $ninioCategoria,
                'subcategory_product_id' => $zapatosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Ninio/Zapatos/1-1.webp', 'Ninio/Zapatos/1-2.webp'],
                'stock_range' => [100, 350],
                'price_range' => [120, 180]
            ],
            [
                'title' => 'Zapato Deportivo Niño Ligero y Transpirable',
                'code' => 'NIN-' . rand(1000, 9999),
                'description' => 'Zapato deportivo para niño, con diseño ligero y materiales transpirables que garantizan confort en actividades deportivas y recreativas.',
                'slug' => 'zapato-deportivo-nino-ligero-transpirable',
                'category_product_id' => $ninioCategoria,
                'subcategory_product_id' => $zapatosSubcategoria,
                'product_brand_id' => rand(1, 5),
                'measurement_unit_id' => 1,
                'image_names' => ['Ninio/Zapatos/2-1.webp', 'Ninio/Zapatos/2-2.webp'],
                'stock_range' => [80, 300],
                'price_range' => [150, 220]
            ],

        ];

        foreach ($arrayProducts as $product) {
            $service->crearProducto($product, $nameStore);
        }
    }
}
