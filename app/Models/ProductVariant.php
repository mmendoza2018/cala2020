<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "product_size_id",
        "status"
    ];

    public function productSize()
    {
        return $this->belongsTo(ProductSize::class, 'product_size_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productVariantPrice()
    {
        return $this->hasMany(ProductVariantPrice::class);
    }
}
