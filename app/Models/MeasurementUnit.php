<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeasurementUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        "description",
        "status",
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'measurement_unit_id');
    }
}
