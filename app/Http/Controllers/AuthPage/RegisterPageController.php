<?php

namespace App\Http\Controllers\AuthPage;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Auth;

class RegisterPageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */


    /** insert new users */
    public function storeUser(Request $request)
    {
        $rules = [
            'names' => 'required|string|max:255',
            'surnames' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ];

        $attributes = [
            'names' => 'Nombres',
            'surnames' => 'Apellidos',
            'email' => 'Correo electronico',
            'phone' => 'Celular',
            'password' => 'Contraseña',
            'password_confirmation' => 'Confimación de contraseña',
        ];

        // Verificar si el usuario ya existe y fue creado con Google
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser && $existingUser->google_id) {
            return ApiResponse::error("Error de validación", ["Este correo ya está registrado a través de Google. Por favor, inicia sesión con Google."], 202);
        }

        // Crear el validador manualmente
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributes);

        // Validar los datos
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return ApiResponse::error("Error de validación", $errors, 202);
        }

        // Si la validación pasa, obtener los datos validados
        $validatedData = $validator->validated();

        $user = User::create([
            'user_id' => Str::random(10),
            "names" => $validatedData["names"],
            "surnames" => $validatedData["surnames"],
            'email' => $validatedData["email"],
            "phone" => $validatedData["phone"],
            "address" => "-",
            'join_date' => now(),
            'status' => 'active',
            'role_name' => 'admin',
            'avatar' => 'default.png',
            'password' => Hash::make($validatedData["password"]),
            'user_type' => 'web_user'
        ]);

        $user->sendEmailVerificationNotification();

        //Auth::guard('web')->login($user);

        return ApiResponse::success([], "Agregado con exito");
    }
}
