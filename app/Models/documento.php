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
        'formato',
        'ruta_archivo',
        'otro_nombre',
        'otra_descripcion',
        'user_id',
    ];

    /**
     * Obtener el usuario (taller) al que pertenece este documento.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}