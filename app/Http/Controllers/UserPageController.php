<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Customer;
use App\Models\EcommerceSale;
use App\Models\EcommerceSaleDetail;
use App\Models\EcommerceSaleProduct;
use App\Models\EcommerceSaleProductDetail;
use App\Models\EcommerceSaleRaffle;
use App\Models\LogisticsMovement;
use App\Models\LogisticsMovementDetail;
use App\Models\TicketSalesDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserPageController extends Controller
{

    public function ticketsView(Request $request)
    {

        $user = Auth::guard('web')->user();
        $userId = $user->id;

        $tickets = TicketSalesDetail::with(['raffle'])
            ->whereHas('ticketSale', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();

        return view('webpage.user.raffle_orders', [
            "tickets" => $tickets,
            "activeScroll" => false,
        ]);
    }

    public function productsView(Request $request)
    {

        $user = Auth::guard('web')->user();

        $orders = EcommerceSaleProduct::with(['details'])->where('user_id', $user->id)->get();

        return view('webpage.user.product_orders', [
            "orders" => $orders,
            "activeScroll" => false,
        ]);
    }

    public function profileView(Request $request)
    {
        return view('webpage.user.profile', [
            "activeScroll" => false,
        ]);
    }

    public function update(Request $request, $id)
    {

        $rules = [
            "names" => "required|string|max:255",
            "surnames" => "required|string|max:255",
            "phone" => "nullable|string|max:255",
            "dni" => "required|string|max:8",
            "department" => "required|string|max:255",
            "date_of_birth" => "required|date|before_or_equal:" . now()->subYears(18)->format('Y-m-d'),
            "gender" => "required|string|in:Masculino,Femenino",
        ];

        $attributes = [
            "names" => "Nombres",
            "surnames" => "Apellidos",
            "phone" => "Teléfono",
            "dni" => "DNI",
            "department" => "Ciudad o departamento",
            "date_of_birth" => "Fecha de nacimiento",
            "gender" => "Género",
        ];

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

        $customer = User::findOrFail($id);

        $userData = [
            "names" => $validatedData["names"],
            "surnames" => $validatedData["surnames"],
            "phone" => $validatedData["phone"],
            "dni" => $validatedData["dni"],
            "department" => $validatedData["department"],
            "date_of_birth" => $validatedData["date_of_birth"],
            "gender" => $validatedData["gender"],
        ];

        $customer->update($userData);

        $reponseUpdate = User::findOrFail($id);

        return ApiResponse::success($reponseUpdate, "Actualizado con exito");
    }

    public function getOrderDetails(Request $request, $idSale)
    {
        $orders = EcommerceSaleProductDetail::where("sale_id", $idSale)->get();

        if ($request->expectsJson()) {
            return ApiResponse::success($orders, "Registro encontrado");
        }
    }
}
