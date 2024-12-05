<?php

namespace App\Http\Controllers;

use App\Exports\EcommerceSalesExport;
use App\Exports\RaffleExport;
use App\Exports\SalesByProductExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelController extends Controller
{
    public function exportRaffleData(Request $request)
    {
        // Validar que el ID del sorteo sea enviado
        $request->validate([
            'raffle_id' => 'required|integer|exists:raffles,id',
        ]);

        $raffleId = $request->input('raffle_id');

        // Generar y descargar el archivo Excel
        return Excel::download(new RaffleExport($raffleId), 'TicketsVendidos.xlsx');
    }

    public function exportEcommerceSaleTransaction(Request $request)
    {
        // Validar que el ID del sorteo sea enviado
        $request->validate([
            'star_date' => 'required|date|before_or_equal:end_date', // La fecha inicial debe ser válida y menor o igual que la fecha final
            'end_date' => 'required|date|after_or_equal:start_date', // La fecha final debe ser válida y mayor o igual que la fecha inicial
        ]);

        $startDate = $request->input('star_date');
        $endDate = $request->input('end_date');

        // Generar y descargar el archivo Excel
        return Excel::download(new EcommerceSalesExport($startDate, $endDate), 'Transacciones.xlsx');
    }

    public function exportSalesByProduct(Request $request)
    {
        $startDate = $request->input('star_date');
        $endDate = $request->input('end_date');
        return Excel::download(new SalesByProductExport($startDate, $endDate), 'Ventas por producto.xlsx');
    }
}
