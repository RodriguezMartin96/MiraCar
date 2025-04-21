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
        'direccion',
        'telefono',
        'email',
        'cif',
        'direccion_juridica',
    ];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }

    public function siniestros()
    {
        return $this->hasMany(Siniestro::class);
    }
}