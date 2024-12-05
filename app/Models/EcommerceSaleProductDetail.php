<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcommerceSaleProductDetail extends Model
{
    use HasFactory;

    // Definir la tabla si no sigue la convención de nombres de Laravel
    protected $table = 'ecommerce_sale_product_details';

    // Los campos que se pueden llenar de forma masiva
    protected $fillable = [
        'sale_id',
        'product_attribute_id',
        'product_name',
        'price',
        'quantity',
        'subtotal'
    ];

    // Relación con la venta (cada detalle pertenece a una venta)
    public function sale()
    {
        return $this->belongsTo(EcommerceSaleProduct::class, 'sale_id');
    }

    // Relación con el producto (cada detalle hace referencia a un atributo de producto)
    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id');
    }
}
