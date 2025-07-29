<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Mail\CredentialsCreated;
use App\Models\AttentionNumber;
use App\Models\General;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ConfigStoreController extends Controller
{
    public function createStore(Request $request)
    {
        $rules = [
            'name_store'        => 'required|string|max:255',
            'description'       => 'nullable|string|max:500',
            'phone_number'      => 'required|string|max:20', // puedes usar regex si quieres validar formato exacto
            'email'             => 'required|email|max:255',
            'adress'            => 'required|string|max:255',
            'primary_color'     => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'secondary_color'   => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'active_brand'      => 'required|in:0,1',
            'active_subcategory' => 'required|in:0,1',
            'type_store'        => 'required|string', // ajusta según tus opciones válidas
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,bmp,ico,tiff',
        ];

        // Definir los nombres amigables de los atributos
        $attributes = [
            'name_store' => 'Nombre de la tienda',
            'description' => 'Descripción',
            'phone_number' => 'Numero',
            'email' => 'Correo',
            'adress' => 'Direccion',
            'primary_color' => 'Color primario',
            'secondary_color' => 'Color secundario',
            'active_brand' => 'Marca',
            'active_subcategory' => 'Subacategoria',
            'type_store' => 'Tipo de tienda',
            'logo' => 'Logo'
        ];

        // Crear el validador manualmente
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributes);

        // Validar los datos
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return ApiResponse::error("Validation Error", $errors, 202);
        }

        $validatedData = $validator->validated();

        //definimos data en tiempo de ejecucion
        config([
            'tienda.active_brand' => $validatedData['active_brand'] ?? false,
            'tienda.active_subcategory' => $validatedData['active_subcategory'] ?? false,
            'tienda.tipo' => $validatedData['type_store'] ?? null,
        ]);

        //creamos base de  al tienda
        $general = General::create([
            'title' => $validatedData['name_store'],
            'code' => Str::uuid(),
            'business_name' => '-',
            'ruc' => '12345678901',
            'address' => $validatedData['adress'],
            'email' => $validatedData['email'],
            'description' => $validatedData['description'],
            'brand_is_active' => $validatedData['active_brand'],
            'subcategory_is_active' => $validatedData['active_subcategory'],
            'status' => 1,
            'logo' => null, // lo dejamos null temporalmente
        ]);
        
        $passwordRandom = "admin_" .  Str::random(5);
         $user = User::create([
            'user_id' => 'admin',
            'names' => $general->title,
            'surnames' => '',
            'address' => 'admin',
            'phone' => 'admin',
            'email' => $general->email,
            'join_date' => now(),
            'status' => 'active',
            'role_name' => 'admin', // O usa el paquete de roles/permissions si aplicas roles por paquetes
            'avatar' => 'default.png',
            'password' => Hash::make($passwordRandom), // Cambia a una contraseña más segura
            'user_type' => 'admin_panel', // Especificar el tipo de usuario como admin
        ]);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');

            // Usamos el ID o code para crear una carpeta única
            $path = $logo->store('uploads/' . $general->code, 'public');
            $imagePath = basename($path);

            // Actualizamos el campo `logo`
            $general->update(['logo' => $imagePath]);
        }

        //definimos por defecto el numero de telefono ingresado
        AttentionNumber::create([
            'phone_number' => $validatedData['phone_number'],
            'name' => $validatedData['name_store'],
        ]);

        //creamos los themess
        Theme::create([
            'primary_color' => $validatedData['primary_color'],
            'secondary_color' => $validatedData['secondary_color'],
            'product_card_shape' => 'SQUARE',
            'theme_active' => 'THEME_01',
            'status' => 1
        ]);

        // Determinar qué Seeder ejecutar
        $seederClasses = $this->resolverSeeder($validatedData['type_store'], true, true);

        if (!$seederClasses) {
            return response()->json([
                'success' => false,
                'message' => 'La configuración de tienda no está soportada.'
            ], 400);
        }

        // Ejecutar el Seeder correspondiente
        foreach ($seederClasses as $seederClass) {
            Artisan::call('db:seed', [
                '--class' => $seederClass,
                '--force' => true
            ]);
        }

        General::where('id', 1)->update(['config_finished' => 1]);
        $panelUrl = url('/login'); 
        Mail::to($validatedData['email'])->send(new CredentialsCreated($validatedData['email'], $passwordRandom, $panelUrl));

        return response()->json([
            'success' => true,
            'redirect' => url('/tienda'),
            'email' => $validatedData['email'],
            'message' => 'Tienda configurada y estructura generada correctamente.'
        ]);
    }

    private function resolverSeeder($tipo)
    {
        $seeders = [
             'Database\\Seeders\\PaymentMethodTableSeeder'
        ];

        $active_brand = config('tienda.active_brand');
        $active_subcategory = config('tienda.active_subcategory');

        if ($active_brand === "1") {
            array_push($seeders, 'Database\\Seeders\\ProductBrandsTableSeeder');
        }

        // Lógica según tipo de tienda y configuración
        if ($tipo === 'Hogar') {

            if ($active_subcategory === "1") {
                array_push($seeders, 'Database\\Seeders\\hogar\\SubcategoriasSeeder');
            }

            $seeders[] = 'Database\\Seeders\\hogar\\CategoriasSeeder';
            $seeders[] = 'Database\\Seeders\\hogar\\BannerSeeder';

            $seeders[] = 'Database\\Seeders\\hogar\\AttributeGroupSeeder';
            $seeders[] = 'Database\\Seeders\\hogar\\AttributeSeeder';
            $seeders[] = 'Database\\Seeders\\hogar\\ProductoSeeder';

            // Seeders globales al final
            $seeders[] = 'Database\\Seeders\\LegalitySeeder';
            $seeders[] = 'Database\\Seeders\\PromotionsSeeder';

            return $seeders;
        }

        if ($tipo === 'Tecnologia') {

            if ($active_subcategory === "1") {
                array_push($seeders, 'Database\\Seeders\\tecnologia\\SubcategoriasSeeder');
            }

            $seeders[] = 'Database\\Seeders\\tecnologia\\CategoriasSeeder';
            $seeders[] = 'Database\\Seeders\\tecnologia\\BannerSeeder';

            $seeders[] = 'Database\\Seeders\\tecnologia\\AttributeGroupSeeder';
            $seeders[] = 'Database\\Seeders\\tecnologia\\AttributeSeeder';
            $seeders[] = 'Database\\Seeders\\tecnologia\\ProductoSeeder';

            // Seeders globales al final
            $seeders[] = 'Database\\Seeders\\LegalitySeeder';
            $seeders[] = 'Database\\Seeders\\PromotionsSeeder';

            return $seeders;
        }

        if ($tipo === 'Ropa') {

            if ($active_subcategory === "1") {
                array_push($seeders, 'Database\\Seeders\\ropa\\SubcategoriasSeeder');
            }

            $seeders[] = 'Database\\Seeders\\ropa\\CategoriasSeeder';
            $seeders[] = 'Database\\Seeders\\ropa\\BannerSeeder';

            $seeders[] = 'Database\\Seeders\\ropa\\AttributeGroupSeeder';
            $seeders[] = 'Database\\Seeders\\ropa\\AttributeSeeder';
            $seeders[] = 'Database\\Seeders\\ropa\\ProductoSeeder';

            // Seeders globales al final
            $seeders[] = 'Database\\Seeders\\LegalitySeeder';
            $seeders[] = 'Database\\Seeders\\PromotionsSeeder';

            return $seeders;
        }

        // Si no se reconoce el tipo, retornamos null
        return null;
    }

    public function resetConfig(Request $request)
    {
        try {
            // Resetea la base de datos (borra todas las tablas y las vuelve a crear, sin ejecutar seeders)
            Artisan::call('migrate:fresh', [
                '--force' => true
            ]);

            return response()->json([
                'success' => true,
                'message' => 'El sistema ha sido reseteado correctamente. Puedes iniciar la configuración nuevamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al resetear el sistema.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
