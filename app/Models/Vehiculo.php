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
        'fecha_matriculacion',
        'color',
        'cliente_id',
    ];

    protected $casts = [
        'fecha_matriculacion' => 'date',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function siniestros()
    {
        return $this->hasMany(Siniestro::class);
    }
}