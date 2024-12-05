<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    // Especificar la tabla si el nombre no sigue la convención
    protected $table = 'product_attributes';

    // Los atributos que son asignables masivamente
    protected $fillable = [
        'product_id',
        'reference',
        'stock',
        'default_price',
        'is_default'
    ];

    // Definir la relación con el modelo Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Definir la relación con el modelo PriceType si decides implementarlo
    public function prices()
    {
        return $this->hasMany(ProductAttributePrice::class);
    }

    public function attributesCombination()
    {
        return $this->hasMany(ProductAttributeCombination::class);
    }
}
