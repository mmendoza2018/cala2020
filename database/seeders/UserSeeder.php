<?php

namespace Database\Seeders;

use App\Models\Campus;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear un usuario con el rol de admin
        $user = User::create([
            'user_id' => 'admin',
            'names' => 'admin',
            'surnames' => 'admin',
            'address' => 'admin',
            'phone' => 'admin',
            'email' => 'admin-catalogo@gmail.com',
            'join_date' => now(),
            'status' => 'active',
            'role_name' => 'admin', // O usa el paquete de roles/permissions si aplicas roles por paquetes
            'avatar' => 'default.png',
            'password' => Hash::make("admin"), // Cambia a una contraseña más segura
            'user_type' => 'admin_panel', // Especificar el tipo de usuario como admin
        ]);

    }
}
