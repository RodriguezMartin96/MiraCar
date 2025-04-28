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
        'color',
        'fecha_matriculacion',
        'cliente_id',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fecha_matriculacion' => 'date',
    ];

    /**
     * Obtener el usuario (taller) al que pertenece este vehículo.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener el cliente al que pertenece este vehículo.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Obtener los siniestros asociados a este vehículo.
     */
    public function siniestros()
    {
        return $this->hasMany(Siniestro::class);
    }
    
    /**
     * Mutador para el atributo marca.
     * Convierte la marca a Title Case (primera letra de cada palabra en mayúscula).
     */
    public function setMarcaAttribute($value)
    {
        $this->attributes['marca'] = $this->toTitleCase($value);
    }
    
    /**
     * Mutador para el atributo modelo.
     * Convierte el modelo a Title Case (primera letra de cada palabra en mayúscula).
     */
    public function setModeloAttribute($value)
    {
        $this->attributes['modelo'] = $this->toTitleCase($value);
    }
    
    /**
     * Mutador para el atributo color.
     * Convierte el color a Title Case (primera letra de cada palabra en mayúscula).
     */
    public function setColorAttribute($value)
    {
        $this->attributes['color'] = $this->toTitleCase($value);
    }
    
    /**
     * Mutador para el atributo matricula.
     * Convierte la matrícula a mayúsculas.
     */
    public function setMatriculaAttribute($value)
    {
        if ($value) {
            $this->attributes['matricula'] = mb_strtoupper($value, 'UTF-8');
        } else {
            $this->attributes['matricula'] = null;
        }
    }
    
    /**
     * Mutador para el atributo bastidor.
     * Convierte el bastidor a mayúsculas.
     */
    public function setBastidorAttribute($value)
    {
        if ($value) {
            $this->attributes['bastidor'] = mb_strtoupper($value, 'UTF-8');
        } else {
            $this->attributes['bastidor'] = null;
        }
    }
    
    /**
     * Convierte un texto a formato Title Case (primera letra de cada palabra en mayúscula)
     * con manejo especial para palabras con apóstrofes y preposiciones.
     */
    private function toTitleCase($string)
    {
        if (!$string) {
            return null;
        }
        
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
}