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
     * Mutador para el atributo nombre.
     * Convierte el nombre a Title Case (primera letra de cada palabra en mayúscula).
     */
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = $this->toTitleCase($value);
    }
    
    /**
     * Mutador para el atributo apellidos.
     * Convierte los apellidos a Title Case (primera letra de cada palabra en mayúscula).
     */
    public function setApellidosAttribute($value)
    {
        $this->attributes['apellidos'] = $this->toTitleCase($value);
    }
    
    /**
     * Mutador para el atributo email.
     * Convierte el email a minúsculas.
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = mb_strtolower($value, 'UTF-8');
    }
    
    /**
     * Mutador para el atributo dni.
     * Convierte el DNI a mayúsculas.
     */
    public function setDniAttribute($value)
    {
        if ($value) {
            $this->attributes['dni'] = mb_strtoupper($value, 'UTF-8');
        } else {
            $this->attributes['dni'] = null;
        }
    }
    
    /**
     * Convierte un texto a formato Title Case (primera letra de cada palabra en mayúscula)
     * con manejo especial para palabras con apóstrofes y preposiciones.
     */
    private function toTitleCase($string)
    {
        // Primero convertimos todo a minúsculas
        $string = mb_strtolower($string, 'UTF-8');
        
        // Dividimos el string en palabras
        $words = explode(' ', $string);
        
        // Lista de palabras que no deberían capitalizarse (preposiciones, artículos, etc.)
        $smallWords = ['de', 'del', 'la', 'las', 'el', 'los', 'y', 'e', 'o', 'u', 'a', 'en', 'con', 'por', 'para'];
        
        foreach ($words as $key => $word) {
            // La primera palabra siempre se capitaliza
            if ($key === 0) {
                $words[$key] = mb_strtoupper(mb_substr($word, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($word, 1, null, 'UTF-8');
                continue;
            }
            
            // Si la palabra está en la lista de palabras pequeñas, no la capitalizamos
            if (in_array($word, $smallWords)) {
                continue;
            }
            
            // Manejo especial para palabras con apóstrofe
            if (strpos($word, "'") !== false) {
                $parts = explode("'", $word);
                $parts[1] = mb_strtoupper(mb_substr($parts[1], 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($parts[1], 1, null, 'UTF-8');
                $words[$key] = $parts[0] . "'" . $parts[1];
                continue;
            }
            
            // Capitalizar la primera letra de la palabra
            $words[$key] = mb_strtoupper(mb_substr($word, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($word, 1, null, 'UTF-8');
        }
        
        // Unimos las palabras de nuevo
        return implode(' ', $words);
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