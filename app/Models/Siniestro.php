<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siniestro extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'descripcion',
        'estado',
        'vehiculo_id',
        'user_id', // Añadido para la relación con el usuario
    ];

    /**
     * Obtener el usuario (taller) al que pertenece este siniestro.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener el vehículo asociado a este siniestro.
     */
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    /**
     * Obtener los recambios asociados a este siniestro.
     */
    public function recambios()
    {
        return $this->hasMany(Recambio::class);
    }
}
