<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = ['attribute_group_id', 'status', 'description'];

    // Relación con el grupo de atributos
    public function attributeGroup()
    {
        return $this->belongsTo(AttributeGroup::class);
    }
}
