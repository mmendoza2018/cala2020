<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "slug",
        "end_date",
        "ticket_price",
        "images",
        "is_visible",
        "total_tickets",
        "tickets_sold",
        "draw_date",
        "winner_id",
        "winner_image",
        "created_by",
        "status"
    ]; 

    protected $casts = [
        'draw_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }

    public function raffleCharasteristics()
    {
        return $this->hasMany(Rafflecharacteristic::class);
    }
}
