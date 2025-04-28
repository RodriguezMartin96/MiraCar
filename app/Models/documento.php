<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
     * Mutador para convertir el nombre a title case.
     */
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = $value;
    }

    /**
     * Mutador para convertir otro_nombre a title case.
     */
    public function setOtroNombreAttribute($value)
    {
        if ($value) {
            $this->attributes['otro_nombre'] = Str::title($value);
        } else {
            $this->attributes['otro_nombre'] = null;
        }
    }

    /**
     * Obtener el usuario (taller) al que pertenece este documento.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}