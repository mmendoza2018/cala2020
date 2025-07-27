<?php

namespace Database\Seeders\ropademo;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\SubcategoryProduct;

class SubcategoriasSeeder extends Seeder
{
    public function run()
    {
        $companyCode = getCompanyCode();
        $nameStore = 'ropa';
        $origenBasePath = public_path("storage/app/tiendas/$nameStore");
        $destinoPath = "uploads/$companyCode";

        $subcategorias = [
            [
                'description' => 'Blusas',
                'filename' => 'Subcategorias/Blusas.webp',
            ],
            [
                'description' => 'Camisas',
                'filename' => 'Subcategorias/Camisas.webp',
            ],
            [
                'description' => 'Deportivos',
                'filename' => 'Subcategorias/Deportivos.webp',
            ],
            [
                'description' => 'Gorras',
                'filename' => 'Subcategorias/Gorras.webp',
            ],
            [
                'description' => 'Jeans',
                'filename' => 'Subcategorias/Jeans.webp',
            ],
            [
                'description' => 'Polos',
                'filename' => 'Subcategorias/Polos.webp',
            ],
            [
                'description' => 'Sacos',
                'filename' => 'Subcategorias/Sacos.webp',
            ],
            [
                'description' => 'Tacos',
                'filename' => 'Subcategorias/Tacos.webp',
            ],
            [
                'description' => 'Tops',
                'filename' => 'Subcategorias/Tops.webp',
            ],
            [
                'description' => 'Vestidos',
                'filename' => 'Subcategorias/Vestidos.webp',
            ],
            [
                'description' => 'Zapatos',
                'filename' => 'Subcategorias/Zapatos.webp',
            ],
                        [
                'description' => 'Abrigos',
                'filename' => 'Subcategorias/Abrigos.webp',
            ],
        ];


        foreach ($subcategorias as $subcategoria) {
            $descripcion = $subcategoria['description'];
            $archivo = $subcategoria['filename'];
            $origenPath = "$origenBasePath/$archivo";

            if (!File::exists($origenPath)) {
                echo "❌ Imagen no encontrada: $archivo\n";
                continue;
            }

            $contenido = file_get_contents($origenPath);
            $extension = pathinfo($archivo, PATHINFO_EXTENSION);
            $imageName = Str::uuid() . '.' . $extension;

            Storage::disk('public')->put("$destinoPath/$imageName", $contenido);

            SubcategoryProduct::create([
                'description' => $descripcion,
                'code' => Str::slug($descripcion),
                'imagen' => $imageName,
                'status' => 1,
            ]);
        }
    }
}
