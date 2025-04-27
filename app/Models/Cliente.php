<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

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
        'cif',
        'direccion_juridica',
        'user_id',
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
    
    /**
     * Definir las reglas de unicidad para el modelo.
     * La unicidad del DNI y email se aplica solo dentro del contexto de cada taller.
     */
    public static function boot()
    {
        parent::boot();
        
        static::saving(function ($cliente) {
            // Solo verificar si user_id está establecido
            if ($cliente->user_id) {
                // Verificar si ya existe un cliente con el mismo DNI para este taller
                if ($cliente->dni) {
                    $existsDni = static::where('dni', $cliente->dni)
                        ->where('user_id', $cliente->user_id)
                        ->where('id', '!=', $cliente->id ?: 0)
                        ->exists();
                        
                    if ($existsDni) {
                        Log::warning('Intento de crear cliente con DNI duplicado', [
                            'dni' => $cliente->dni,
                            'user_id' => $cliente->user_id
                        ]);
                        throw new \Exception('Ya existe un cliente con este DNI en tu taller.');
                    }
                }
                
                // Verificar si ya existe un cliente con el mismo email para este taller
                $existsEmail = static::where('email', $cliente->email)
                    ->where('user_id', $cliente->user_id)
                    ->where('id', '!=', $cliente->id ?: 0)
                    ->exists();
                    
                if ($existsEmail) {
                    Log::warning('Intento de crear cliente con email duplicado', [
                        'email' => $cliente->email,
                        'user_id' => $cliente->user_id
                    ]);
                    throw new \Exception('Ya existe un cliente con este email en tu taller.');
                }
            }
        });
    }
}