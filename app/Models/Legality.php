<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legality extends Model
{
    protected $table = 'legalities';
    use HasFactory;
    protected $fillable = [
        'type',
        'description',
    ];
}
