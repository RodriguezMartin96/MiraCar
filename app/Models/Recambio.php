<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Recambio extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto',
        'cantidad',
        'referencia',
        'precio',
        'descripcion',
        'user_id',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
    ];

    public function setProductoAttribute($value)
    {
        $this->attributes['producto'] = Str::title($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}