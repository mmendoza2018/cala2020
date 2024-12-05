<?php

namespace App\Http\Controllers\AuthPage;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    use VerifiesEmails;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function verify(Request $request, $id) // Acepta el ID del usuario como parámetro
    {
        // Cargar al usuario usando el ID de la ruta
        $user = User::findOrFail($id); // Si no se encuentra, lanzará una excepción

        // Verifica el correo electrónico del usuario
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            Auth::guard('web')->login($user);

            if (session('from_checkout')) {
                return redirect('/checkout-productos')->with('verified', true);
            }
        }

        return redirect($this->redirectTo)->with('verified', true); // O lo que quieras hacer después
    }
}
