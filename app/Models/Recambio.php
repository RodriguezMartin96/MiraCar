<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recambio extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto',
        'cantidad',
        'referencia',
        'precio',
        'descripcion',
    ];
}