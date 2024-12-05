<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'quantity',
        'status',
        'ecommerce_sale_product_id',
    ];

    // Definimos la relación con el modelo Raffle
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tickets()
    {
        return $this->hasMany(TicketSalesDetail::class, 'ticket_sale_id');
    }

    // Relación con el modelo EcommerceSaleProduct
    public function ecommerceSaleProduct()
    {
        return $this->belongsTo(EcommerceSaleProduct::class);
    }
}
