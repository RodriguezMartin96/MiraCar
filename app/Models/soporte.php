<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soporte extends Model
{
    use HasFactory;

    protected $table = 'soportes';

    protected $fillable = [
        'email',
        'asunto',
        'descripcion',
        'estado',
        'respuesta',
        'user_id',
    ];

    /**
     * Obtener el usuario (taller) al que pertenece este soporte.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}