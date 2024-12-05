<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributePrice extends Model
{
    use HasFactory;

    // Especificar la tabla si el nombre no sigue la convención
    protected $table = 'product_attribute_prices';

    // Los atributos que son asignables masivamente
    protected $fillable = [
        'product_attribute_id',
        'price_type_id',
        'price',
    ];

    // Definir la relación con el modelo ProductAttribute
    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }

    // Definir la relación con el modelo PriceType
    public function priceType()
    {
        return $this->belongsTo(PriceType::class);
    }
}
