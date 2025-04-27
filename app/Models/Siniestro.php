<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siniestro extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'cliente_id',
        'vehiculo_id',
        'fecha_entrada',
        'fecha_salida',
        'estado',
        'descripcion',
        'daños',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fecha_entrada' => 'date',
        'fecha_salida' => 'date',
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
     * Obtener el cliente asociado a este siniestro.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Obtener los recambios asociados a este siniestro.
     */
    public function recambios()
    {
        return $this->hasMany(Recambio::class);
    }
}