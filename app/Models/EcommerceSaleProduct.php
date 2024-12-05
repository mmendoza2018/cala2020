<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcommerceSaleProduct extends Model
{
    use HasFactory;

    // Definir la tabla si no sigue la convención de nombres de Laravel
    protected $table = 'ecommerce_sale_products';

    // Los campos que se pueden llenar de forma masiva
    protected $fillable = [
        'user_id',
        'code',
        'payment_method',
        'quantity',
        'total',
        'status'
    ];

    // Relación con el usuario (cada venta pertenece a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con los detalles de la venta (cada venta tiene múltiples detalles)
    public function details()
    {
        return $this->hasMany(EcommerceSaleProductDetail::class, 'sale_id');
    }

    // Relación con el modelo TicketSale
    public function ticketSales()
    {
        return $this->hasMany(TicketSale::class);
    }
}
