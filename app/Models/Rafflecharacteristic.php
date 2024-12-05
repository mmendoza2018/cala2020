<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rafflecharacteristic extends Model
{
    use HasFactory;
    
    protected $table = 'raffle_characteristics';
    
    protected $fillable = [
        "raffle_id",
        "image_name",
        "title",
        "description"
    ];

    public function raffle()
    {
        return $this->belongsTo(Raffle::class, 'raffle_id');
    }
}
