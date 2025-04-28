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

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'precio' => 'decimal:2',
    ];

    /**
     * Mutador para convertir el producto a title case.
     */
    public function setProductoAttribute($value)
    {
        $this->attributes['producto'] = Str::title($value);
    }

    /**
     * Obtener el usuario (taller) al que pertenece este recambio.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}