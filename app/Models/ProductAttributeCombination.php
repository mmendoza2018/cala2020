<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeCombination extends Model
{
    use HasFactory;

    // Especificar la tabla si el nombre no sigue la convención
    protected $table = 'product_attribute_combinations';

    // Los atributos que son asignables masivamente
    protected $fillable = [
        'product_attribute_id',
        'attribute_id',
    ];

    // Definir la relación con ProductAttribute
    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }

    // Definir la relación con Attribute
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
