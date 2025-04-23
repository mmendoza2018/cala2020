<?php

namespace App\Http\Controllers;

use App\Models\Legality;
use Illuminate\Http\Request;

class LegalityController extends Controller
{
    function politicasReembolso()
    {
        $politica = Legality::where("status", 1)->where("type", "POLITICAS_DE_REEMBOLSO")->first();
        return view('admin.refund_policies.index', [
            "politicas" => $politica
        ]); 
    }

    function terminosCondiciones()
    {
        $terminos = Legality::where("status", 1)->where("type", "TERMINOS_Y_CONDICIONES")->first();
        return view('admin.terms_conditions.index', [
            "terminos" => $terminos
        ]);
    }
}
