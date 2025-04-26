<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca',
        'modelo',
        'matricula',
        'color',
        'año',
        'cliente_id',
        'user_id', // Añadido para la relación con el usuario
    ];

    /**
     * Obtener el usuario (taller) al que pertenece este vehículo.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener el cliente al que pertenece este vehículo.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Obtener los siniestros asociados a este vehículo.
     */
    public function siniestros()
    {
        return $this->hasMany(Siniestro::class);
    }
}
