<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
    use HasFactory;

    protected $fillable = [
        "description",
        "status",
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'product_brand_id');
    }
}
