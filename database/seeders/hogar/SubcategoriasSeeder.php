<?php

namespace Database\Seeders\hogar;

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
        $nameStore = 'hogar';
        $origenBasePath = public_path("assets/app/tiendas/$nameStore");
        $destinoPath = "uploads/$companyCode";

        $subcategorias = [
            [
                'description' => 'camas',
                'filename' => 'subcategorias/camas.webp',
            ],
            [
                'description' => 'comedores',
                'filename' => 'subcategorias/comedores.webp',
            ],
            [
                'description' => 'sofas',
                'filename' => 'subcategorias/sofas.webp',
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
