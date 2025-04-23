<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcategoryProduct extends Model
{
    use HasFactory;

    protected $table = 'subcategories_products';

    protected $fillable = [
        'description',
        'code',
        'status',
        'imagen'
    ];
}
