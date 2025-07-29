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

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:PENDING,PAID,CANCELLED',
        ]);

        $order = EcommerceSaleProduct::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return ApiResponse::success($order, "Registro encontrado.");
    }
}
