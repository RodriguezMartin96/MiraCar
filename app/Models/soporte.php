<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soporte extends Model
{
    use HasFactory;

    protected $table = 'soportes';

    protected $fillable = [
        'asunto',
        'mensaje',
        'email_from',
        'email_to',
        'estado',
        'user_id', // Añadido para la relación con el usuario
    ];

    /**
     * Obtener el usuario (taller) al que pertenece este soporte.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
