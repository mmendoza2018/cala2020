<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        "price",
        "product_variant_id",
        "price_type_id"
    ];

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, "product_variant_id");
    }
}
