<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recambio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'cantidad',
        'siniestro_id',
        'user_id', // Añadido para la relación con el usuario
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
