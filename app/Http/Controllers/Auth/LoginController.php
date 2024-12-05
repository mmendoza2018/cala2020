<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;


class LoginController extends Controller
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
    protected $redirectTo = '/dashboards';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /** index login page */
    public function login()
    {
        return view('auth.login');
    }

    /** login page to check database table users */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);
        try {
            $toastTr = Toastr();
            $username = $request->email;
            $password = $request->password;

            $dt         = Carbon::now();
            $todayDate  = $dt->toDayDateTimeString();

            if (Auth::guard('admin')->attempt(['email' => $username, 'password' => $password])) {
                //dd("hola");
                $user = Auth::guard('admin')->user();
                // Actualizar la última fecha de inicio de sesión
                $updateLastLogin = ['last_login' => $todayDate];
                User::where('email', $username)->update($updateLastLogin);

                // Redirigir al panel de administración
                if ($user->user_type === 'admin_panel') {
                    $toastTr->success('Acceso permitido', 'Success');
                    return redirect()->intended('admin/dashboards');
                } else {
                    Auth::guard('admin')->logout(); // Cerrar sesión si no tiene acceso válido
                    $toastTr->error('Acceso denegado por tipo de usuario no válido', 'Error');
                    return redirect('login');
                }

                $updateLastLogin = ['last_login' => $todayDate,];
                User::where('email', $username)->update($updateLastLogin);
                $toastTr->success('Login successfully :)', 'Success');
                return redirect()->intended('admin.dashboards');
            } else {
                $toastTr->error('Error al inciar sesion, usuario o contraseña incorrectos', 'Error');
                return redirect('login');
            }
        } catch (\Exception $e) {
            dd($e);
            Log::info($e);
            DB::rollback();
            $toastTr->error('Error al iniciar sesion:)', 'Error');
            return redirect()->back();
        }
    }

    public function logoutPage()
    {
        return view('auth.logout');
    }

    public function logout(Request $request)
    {
        $toastTr = Toastr();
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $toastTr->success('Se cerro sesion con exito', 'Success');
        return redirect('logout/page');
    }
}
