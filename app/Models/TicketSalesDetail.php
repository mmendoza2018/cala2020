<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketSalesDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'raffle_id',
        'ticket_sale_id',
        'ticket_code',
        'ticket_price',
    ];

    // Definimos la relación con el modelo TicketSale
    public function ticketSale()
    {
        return $this->belongsTo(TicketSale::class);
    }

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }
}
