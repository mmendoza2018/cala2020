<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\EcommerceSaleProduct;
use Illuminate\Http\Request;

class OrderSaleProductsController extends Controller
{
    public function index()
    {
        $orders = EcommerceSaleProduct::all();

        return view('admin.orders.index', [
            "orders" => $orders,
        ]);
    }

    public function show(Request $request, $id)
    {
        $orders = EcommerceSaleProduct::with(['details'])->find($id);

        if ($request->expectsJson()) {
            return ApiResponse::success($orders, "Registro encontrado.");
        }
    }
}
