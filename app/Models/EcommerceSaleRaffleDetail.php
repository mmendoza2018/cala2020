<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcommerceSaleRaffleDetail extends Model
{
    use HasFactory;
    // Definir la tabla si no sigue la convención de nombres de Laravel
    protected $table = 'ecommerce_sale_raffle_details';

    // Los campos que se pueden llenar de forma masiva
    protected $fillable = [
        'sale_id',
        'raffle_id',
        'raffle_name',
        'price',
        'quantity',
        'subtotal'
    ];

    // Relación con la venta (cada detalle pertenece a una venta)
    public function sale()
    {
        return $this->belongsTo(EcommerceSaleRaffle::class, 'sale_id');
    }

    // Relación con el producto (cada detalle hace referencia a un atributo de producto)
    public function raffle()
    {
        return $this->belongsTo(Raffle::class, 'raffle_id');
    }
}
