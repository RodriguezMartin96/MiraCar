<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'ruta',
        'tipo',
        'user_id', // Añadido para la relación con el usuario
    ];

    /**
     * Obtener el usuario (taller) al que pertenece este documento.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
