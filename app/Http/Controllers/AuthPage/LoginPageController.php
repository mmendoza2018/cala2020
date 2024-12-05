<?php

namespace App\Http\Controllers\AuthPage;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Campus;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Brian2694\Toastr\Toastr as ToastrToastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Validator;

class LoginPageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function authenticate(Request $request)
    {
        try {
            $rules = [
                'email'    => 'required|email',
                'password' => 'required|string',
            ];

            $attributes = [
                'email' => 'Correo electronico',
                'password' => 'Contraseña',
            ];

            // Crear el validador manualmente
            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attributes);

            // Validar los datos
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return ApiResponse::error("Validation Error", $errors, 202);
            }

            // Si la validación pasa, obtener los datos validados
            $validatedData = $validator->validated();

            // Verificar si el usuario existe en la base de datos
            $user = User::where('email', $validatedData['email'])->first();

            // Si el usuario existe, verificar si se registró con Google
            if ($user) {
                // Si el usuario tiene google_id, informarle que debe iniciar sesión con Google
                if ($user->google_id) {
                    return ApiResponse::error("Error de autenticación", ["Este correo está registrado mediante Google. Por favor, utiliza el inicio de sesión con Google."], 202);
                }
            }

            // Intentar autenticar al usuario con el guard 'web'
            if (Auth::guard('web')->attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {
                $user = Auth::guard('web')->user();

                // Verificar si el email ha sido validado
                if (is_null($user->email_verified_at)) {
                    Auth::guard('web')->logout(); // Cerrar sesión si no ha verificado el email
                    return ApiResponse::error("Error de autenticación", ["Debes verificar tu correo electrónico antes de iniciar sesión, revisa tu correo en la bandeja de entrada o en SPAM"], 202);
                }

                // Actualizar la última fecha de inicio de sesión
                $dt = Carbon::now();
                $todayDate = $dt->toDayDateTimeString();
                User::where('email', $validatedData['email'])->update(['last_login' => $todayDate]);

                // Redirigir al panel de administración
                if ($user->user_type === 'web_user') {
                    return ApiResponse::success([], "Inicio de sesión exitoso");
                } else {
                    Auth::guard('web')->logout(); // Cerrar sesión si no tiene acceso válido
                    return ApiResponse::error("Error de autenticación", ["Tipo de usuario incorrecto"], 202);
                }
            } else {
                return ApiResponse::error("Error de autenticación", ["Usuario o contraseña inválidos"], 202);
            }
        } catch (\Exception $e) {
            return ApiResponse::error("Error de autenticación", ["Error fatal al loguearse"], 202);
        }
    }


    /** logout and forget session */
    public function logout(Request $request)
    {
        $toastTr = Toastr();
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redireccionar al usuario después de cerrar sesión (ej. a la página de inicio)
        $toastTr->success('Se cerro sesion con exito', 'Success');
        return redirect('/');
    }
}
