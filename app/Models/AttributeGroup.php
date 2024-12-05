<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    use HasFactory;

    protected $fillable = ['description'];

    // Relación con la tabla de atributos (que crearemos después)
    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
}
