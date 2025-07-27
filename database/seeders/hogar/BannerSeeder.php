<?php

namespace Database\Seeders\hogar;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $companyCode = getCompanyCode();
        $nameStore = 'hogar';
        $origenBasePath = public_path("assets/app/tiendas/$nameStore");
        $destinoPath = "uploads/$companyCode";

        $subcategorias = [
            [
                'filename' => 'banners/banner02.png',
            ],
            [
                'filename' => 'banners/banner01.png',
            ],
        ];

        foreach ($subcategorias as $subcategoria) {
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

            Banner::create([
                'image_name' => $imageName,
            ]);
        }
    }
}
