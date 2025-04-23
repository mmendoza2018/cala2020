<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $table = 'themes'; // Nombre de la tabla en la BD

    protected $fillable = [
        'primary_color',
        'secondary_color',
        'product_card_shape',
        'theme_active',
        'status',
    ];
}
