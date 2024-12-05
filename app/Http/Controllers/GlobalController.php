<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GlobalController extends Controller
{
    public function setSesionSidebar()
    {
        // Asigna la sección que quieres mantener abierta
        session(['IdItemActive' => 'products']);
        return view('yourview');
    }
}
