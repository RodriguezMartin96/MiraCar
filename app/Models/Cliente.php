<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellidos',
        'dni',
        'email',
        'telefono',
        'direccion',
        'user_id', // Añadido para la relación con el usuario
    ];

    /**
     * Obtener el usuario (taller) al que pertenece este cliente.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener los vehículos asociados a este cliente.
     */
    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }
}
