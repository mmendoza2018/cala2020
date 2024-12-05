<?php

namespace App\Exports;

use App\Models\EcommerceSaleProduct;
use App\Models\EcommerceSaleProductDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EcommerceSalesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $startDate;
    protected $endDate;

    // Constructor para recibir el rango de fechas desde el controlador
    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * Devuelve la colección de datos a exportar
     */
    public function collection()
    {
        return EcommerceSaleProduct::join('users', 'ecommerce_sale_products.user_id', '=', 'users.id')
        ->whereBetween('ecommerce_sale_products.created_at', [$this->startDate, $this->endDate])
        ->where('ecommerce_sale_products.status', 'PAID')
        ->select([
            \Illuminate\Support\Facades\DB::raw("CONCAT('HC-', ecommerce_sale_products.id) as Cod_Transaccion"),
            'ecommerce_sale_products.quantity as Cantidad_productos',
            'ecommerce_sale_products.total as Total',
            'ecommerce_sale_products.created_at as Fecha_compra',
            'users.names as Nombres_Cliente',
            'users.surnames as Apellidos_Cliente',
            'users.dni as DNI',
            'users.department as Ubicacion',
            \Illuminate\Support\Facades\DB::raw('YEAR(CURDATE()) - YEAR(users.date_of_birth) as Edad') // Calculamos la edad
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
            'Cod de transacción',
            'Cantidad productos',
            'Total (S/)',
            'Fecha compra',
            'Nombres Cliente',
            'Apellidos Cliente',
            'DNI',
            'Ubicación',
            'Edad'
        ];
    }

    /**
     * Estilos para el archivo Excel
     */
    public function styles(Worksheet $sheet)
    {
        // Aplicar estilo a la cabecera
        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => '000000'], // Texto negro
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => 'E0E0E0'], // Fondo gris claro
            ],
        ]);

        // Ajustar alineación del texto
        $sheet->getStyle('A1:I1')->getAlignment()->setHorizontal('center');

        return [
            1 => ['font' => ['bold' => true]]
        ];
    }
}
