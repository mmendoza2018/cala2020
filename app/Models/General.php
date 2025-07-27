<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'code',
        'business_name',
        'ruc',
        'address',
        'email',
        'description',
        'logo',
        'favicon',
        'brand_is_active',
        'subcategory_is_active',
        'status',
        'config_finished'
    ];

}
