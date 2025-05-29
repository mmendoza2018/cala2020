<?php

namespace Database\Seeders\ropa;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\SubcategoryProduct;

class SubcategoriasRopaSeeder extends Seeder
{
    public function run()
    {
        $companyCode = getCompanyCode();
        $origenPath = storage_path('app/public/app/tiendas/ropa/Subcategorias');
        $destinoPath = "uploads/$companyCode";

        $archivos = collect(scandir($origenPath))
            ->filter(fn($file) => !in_array($file, ['.', '..']) && is_file("$origenPath/$file"));

        foreach ($archivos as $archivo) {
            $descripcion = pathinfo($archivo, PATHINFO_FILENAME);

            // Leer contenido de la imagen original
            $contenido = file_get_contents("$origenPath/$archivo");

            // Obtener la extensión original
            $extension = pathinfo($archivo, PATHINFO_EXTENSION);

            // Generar nombre aleatorio
            $imageName = Str::uuid() . '.' . $extension;

            // Guardar con nombre aleatorio en la ruta pública
            Storage::disk('public')->put("$destinoPath/$imageName", $contenido);

            // Insertar en la base de datos
            SubcategoryProduct::create([
                'description' => $descripcion,
                'code' => Str::slug($descripcion),
                'imagen' => $imageName,
                'status' => 1
            ]);
        }
    }
}
