<?php

namespace App\Exports;

use App\Models\TicketSale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RaffleExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $raffleId;

    // Constructor para recibir el ID del sorteo desde el controlador
    public function __construct($raffleId)
    {
        $this->raffleId = $raffleId;
    }

    /**
     * Devuelve la colección de datos a exportar
     */
    public function collection()
    {
        return TicketSale::join('ticket_sales_details', 'ticket_sales.id', '=', 'ticket_sales_details.ticket_sale_id')
            ->join('raffles', 'ticket_sales_details.raffle_id', '=', 'raffles.id')
            ->join('ecommerce_sale_products', 'ticket_sales.ecommerce_sale_product_id', '=', 'ecommerce_sale_products.id')
            ->join('users', 'ticket_sales.user_id', '=', 'users.id')
            ->where('ticket_sales_details.raffle_id', $this->raffleId)
            ->select([
                \Illuminate\Support\Facades\DB::raw("CONCAT('HC-', ecommerce_sale_products.id) as Cod_Transaccion"),
                'ticket_sales_details.ticket_code as Nro_de_tique',
                'raffles.title as Nombre_rifa',
                'ticket_sales_details.ticket_code as Codigo_rifa',
                'ticket_sales.status as Estado',
                'ticket_sales.created_at as Fecha_compra',
                'users.names as Nombres',
                'users.surnames as Apellidos',
                'users.dni as DNI',
                'users.department as Ubicacion',
                'users.email as Correo',
                'users.phone as Celular'
            ])
            ->orderBy('ecommerce_sale_products.id')
            ->get();
    }

    /**
     * Encabezados del archivo Excel
     */
    public function headings(): array
    {
        return [
            'Cod. Transacción',
            'Nro de tique',
            'Nombre rifa',
            'Codigo rifa',
            'Estado',
            'Fecha compra',
            'Nombres',
            'Apellidos',
            'DNI',
            'Ubicación',
            'Correo',
            'Celular'
        ];
    }

    public function styles(Worksheet $sheet)
    {   
        // Aplicar estilo a la cabecera
        $sheet->getStyle('A1:L1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => '000000'], // Texto blanco
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => 'E0E0E0'], // Fondo celeste
            ],
        ]);

        // Ajustar alineación del texto
        $sheet->getStyle('A1:L1')->getAlignment()->setHorizontal('center');

        return [
            1 => ['font' => ['bold' => true]], // Fila de encabezados en negrita
        ];
    }
}
