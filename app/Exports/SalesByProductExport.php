<?php

namespace App\Exports;

use App\Models\EcommerceSaleProduct;
use App\Models\EcommerceSaleProductDetail;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SalesByProductExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
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
        $salesData = EcommerceSaleProductDetail::join('product_attributes', 'ecommerce_sale_product_details.product_attribute_id', '=', 'product_attributes.id')
        ->join('products', 'product_attributes.product_id', '=', 'products.id')
        ->join('categories_products', 'products.category_product_id', '=', 'categories_products.id')
        ->select(
            'products.title as product_name',
            'categories_products.description as category_name',
            'ecommerce_sale_product_details.quantity as quantity',
            \Illuminate\Support\Facades\DB::raw("CONCAT('HC-', ecommerce_sale_product_details.sale_id) as Cod_Transaccion"),
        )
        ->whereBetween('ecommerce_sale_product_details.created_at', [$this->startDate, $this->endDate])
        ->orderBy('ecommerce_sale_product_details.sale_id')
        ->get();

        return $salesData;
    }

    /**
     * Encabezados del archivo Excel
     */
    public function headings(): array
    {
        return [
            'Producto',
            'Categoria',
            'Cantidad',
            'Cod.boleta',
        ];
    }

    /**
     * Estilos para el archivo Excel
     */
    public function styles(Worksheet $sheet)
    {
        // Aplicar estilo a la cabecera
        $sheet->getStyle('A1:D1')->applyFromArray([
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
        $sheet->getStyle('A1:D1')->getAlignment()->setHorizontal('center');

        return [
            1 => ['font' => ['bold' => true]]
        ];
    }
}
