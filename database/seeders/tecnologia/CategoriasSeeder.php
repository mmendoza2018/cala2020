<?php

namespace Database\Seeders\tecnologia;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\CategoryProduct;

class CategoriasSeeder extends Seeder
{
    public function run()
    {
        $companyCode = getCompanyCode();
        $nameStore = 'tecnologia';
        $origenBasePath = public_path("assets/app/tiendas/$nameStore");
        $destinoPath = "uploads/$companyCode";

        $categorias = [
            [
                'description' => 'accesorios',
                'filename' => 'categorias/accesorios.webp',
            ],
            [
                'description' => 'equipos',
                'filename' => 'categorias/equipos.webp',
            ],
        ];

        foreach ($categorias as $categoria) {
            $descripcion = $categoria['description'];
            $archivo = $categoria['filename'];
            $origenPath = "$origenBasePath/$archivo";

            if (!File::exists($origenPath)) {
                echo $origenPath;
                echo "❌ Imagen no encontrada: $archivo\n";
                continue;
            }

            $contenido = file_get_contents($origenPath);
            $extension = pathinfo($archivo, PATHINFO_EXTENSION);
            $imageName = Str::uuid() . '.' . $extension;

            Storage::disk('public')->put("$destinoPath/$imageName", $contenido);

            CategoryProduct::create([
                'description' => $descripcion,
                'code' => Str::slug($descripcion),
                'imagen' => $imageName,
                'status' => 1
            ]);
        }
    }
}
