<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeCombination;
use App\Models\Attribute;

class ProductImportService
{
    protected function getCompanyCode(): string
    {
        // Puedes reemplazar esto si tienes un helper global
        return getCompanyCode(); 
    }

    public function crearProducto(array $data, string $nameStore, string $descriptionAtributte1 = "Calidad", string $descriptionAtributte2 = "Tamaño"): void
    {
        $companyCode = $this->getCompanyCode();

        $product = Product::create([
            'title' => $data['title'],
            'code' => $data['code'],
            'description' => $data['description'],
            'slug' => $data['slug'],
            'category_product_id' => $data['category_product_id'],
            'subcategory_product_id' => $data['subcategory_product_id'],
            'product_brand_id' => $data['product_brand_id'],
            'measurement_unit_id' => $data['measurement_unit_id'],
            'min_stock' => 100,
            'featured' => rand(1, 100) <= 30, // 30% de probabilidad de ser true
            'user_id' => 1,
            'status' => 1,
        ]);

        // Guardar imágenes
        $origenBasePath = public_path("storage/app/tiendas/$nameStore");
        $destinoPath = "uploads/{$companyCode}";
        $yaTienePrincipal = false;

        foreach ($data['image_names'] as $archivo) {
            $extension = pathinfo($archivo, PATHINFO_EXTENSION);
            $imageName = Str::uuid() . '.' . $extension;
            $contenido = file_get_contents("{$origenBasePath}/{$archivo}");

            Storage::disk('public')->put("{$destinoPath}/{$imageName}", $contenido);

            $esPrincipal = !$yaTienePrincipal && rand(0, 1) === 1;
            if ($esPrincipal) $yaTienePrincipal = true;

            ProductImage::create([
                'product_id' => $product->id,
                'image_name' => $imageName,
                'is_main' => $esPrincipal,
            ]);
        }

        // Si ninguna imagen fue principal, hacer la primera como principal
        if (!$yaTienePrincipal) {
            $firstImage = $product->productImages()->first();
            if ($firstImage) {
                $firstImage->update(['is_main' => true]);
            }
        }

        // Obtener atributos de Calidad y Tamaño
        $calidad = Attribute::whereHas('attributeGroup', fn ($q) => $q->where('description', $descriptionAtributte1))->get();
        $tamanios = Attribute::whereHas('attributeGroup', fn ($q) => $q->where('description', $descriptionAtributte2))->get();

        // Generar combinaciones
        $yaTieneDefault = false;
        foreach ($calidad as $c) {
            foreach ($tamanios as $t) {
                $price = rand($data['price_range'][0] * 100, $data['price_range'][1] * 100) / 100;
                $stock = rand($data['stock_range'][0], $data['stock_range'][1]);
                $isDefault = !$yaTieneDefault && rand(0, 1) === 1;
                if ($isDefault) $yaTieneDefault = true;

                $productAttribute = ProductAttribute::create([
                    'product_id' => $product->id,
                    'reference' => 'REF-' . strtoupper(Str::random(5)),
                    'stock' => $stock,
                    'default_price' => $price,
                    'is_default' => $isDefault,
                ]);

                ProductAttributeCombination::create([
                    'product_attribute_id' => $productAttribute->id,
                    'attribute_id' => $c->id,
                ]);

                ProductAttributeCombination::create([
                    'product_attribute_id' => $productAttribute->id,
                    'attribute_id' => $t->id,
                ]);
            }
        }

        // Si ninguna combinación fue por defecto, marcar la primera
        if (!$yaTieneDefault) {
            $first = $product->productAttributes()->first();
            if ($first) {
                $first->update(['is_default' => true]);
            }
        }
    }
}
