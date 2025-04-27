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
        'siniestro_id',
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
     * Obtener el usuario (taller) al que pertenece este recambio.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener el siniestro asociado a este recambio.
     */
    public function siniestro()
    {
        return $this->belongsTo(Siniestro::class);
    }
}