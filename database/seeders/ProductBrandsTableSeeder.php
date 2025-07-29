<?php

namespace Database\Seeders;

use App\Models\ProductBrand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductBrandsTableSeeder extends Seeder
{
    public function run(): void
    {
        $companyCode = getCompanyCode();
        $origenPath = public_path('assets/app/base/marcas');
        $destinoPath = "uploads/$companyCode";

        $archivos = collect(scandir($origenPath))
            ->filter(fn($file) => !in_array($file, ['.', '..']) && is_file("$origenPath/$file"));

        foreach ($archivos as $archivo) {
            $descripcion = pathinfo($archivo, PATHINFO_FILENAME);
            $contenido = file_get_contents("$origenPath/$archivo");
            $extension = pathinfo($archivo, PATHINFO_EXTENSION);
            $imageName = Str::uuid() . '.' . $extension;

            // Guarda la imagen en la ruta correcta
            Storage::disk('public')->put("$destinoPath/$imageName", $contenido);

            // Crea el registro de la marca
            ProductBrand::create([
                'description' => $descripcion,
                'imagen' => $imageName,
            ]);
        }
    }
}
