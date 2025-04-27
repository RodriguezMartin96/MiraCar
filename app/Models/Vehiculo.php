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
        'bastidor',
        'color',
        'fecha_matriculacion',
        'cliente_id',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fecha_matriculacion' => 'date',
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