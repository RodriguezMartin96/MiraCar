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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }
    
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = $this->toTitleCase($value);
    }
    
    public function setApellidosAttribute($value)
    {
        $this->attributes['apellidos'] = $this->toTitleCase($value);
    }
    
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = mb_strtolower($value, 'UTF-8');
    }
    
    public function setDniAttribute($value)
    {
        if ($value) {
            $this->attributes['dni'] = mb_strtoupper($value, 'UTF-8');
        } else {
            $this->attributes['dni'] = null;
        }
    }
    
    private function toTitleCase($string)
    {
        $string = mb_strtolower($string, 'UTF-8');
        $words = explode(' ', $string);
        $smallWords = ['de', 'del', 'la', 'las', 'el', 'los', 'y', 'e', 'o', 'u', 'a', 'en', 'con', 'por', 'para'];
        
        foreach ($words as $key => $word) {
            if ($key === 0) {
                $words[$key] = mb_strtoupper(mb_substr($word, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($word, 1, null, 'UTF-8');
                continue;
            }
            
            if (in_array($word, $smallWords)) {
                continue;
            }
            
            if (strpos($word, "'") !== false) {
                $parts = explode("'", $word);
                $parts[1] = mb_strtoupper(mb_substr($parts[1], 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($parts[1], 1, null, 'UTF-8');
                $words[$key] = $parts[0] . "'" . $parts[1];
                continue;
            }
            
            $words[$key] = mb_strtoupper(mb_substr($word, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($word, 1, null, 'UTF-8');
        }
        
        return implode(' ', $words);
    }
    
    public static function boot()
    {
        parent::boot();
        
        static::saving(function ($cliente) {
            if ($cliente->user_id) {
                if ($cliente->dni) {
                    $existsDni = static::where('dni', $cliente->dni)
                        ->where('user_id', $cliente->user_id)
                        ->where('id', '!=', $cliente->id ?: 0)
                        ->exists();
                        
                    if ($existsDni) {
                        Log::warning('Intento de crear cliente con DNI duplicado en el mismo taller', [
                            'dni' => $cliente->dni,
                            'user_id' => $cliente->user_id
                        ]);
                        throw new \Exception('Ya existe un cliente con este DNI en tu taller.');
                    }
                }
                
                $existsEmail = static::where('email', $cliente->email)
                    ->where('user_id', $cliente->user_id)
                    ->where('id', '!=', $cliente->id ?: 0)
                    ->exists();
                    
                if ($existsEmail) {
                    Log::warning('Intento de crear cliente con email duplicado en el mismo taller', [
                        'email' => $cliente->email,
                        'user_id' => $cliente->user_id
                    ]);
                    throw new \Exception('Ya existe un cliente con este email en tu taller.');
                }
            }
        });
    }
}