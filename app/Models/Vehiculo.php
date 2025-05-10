<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

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

    protected $casts = [
        'fecha_matriculacion' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($vehiculo) {
            $validator = Validator::make($vehiculo->toArray(), [
                'matricula' => 'required|string|max:20|unique:vehiculos,matricula,' . $vehiculo->id . ',id,user_id,' . $vehiculo->user_id,
                'bastidor' => $vehiculo->bastidor ? 'nullable|string|unique:vehiculos,bastidor,' . $vehiculo->id . ',id,user_id,' . $vehiculo->user_id : '',
            ]);

            if ($validator->fails()) {
                throw ValidationException::withMessages($validator->errors()->toArray());
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function siniestros()
    {
        return $this->hasMany(Siniestro::class);
    }
    
    public function setMarcaAttribute($value)
    {
        $this->attributes['marca'] = $this->toTitleCase($value);
    }
    
    public function setModeloAttribute($value)
    {
        $this->attributes['modelo'] = $this->toTitleCase($value);
    }
    
    public function setColorAttribute($value)
    {
        $this->attributes['color'] = $this->toTitleCase($value);
    }
    
    public function setMatriculaAttribute($value)
    {
        if ($value) {
            $this->attributes['matricula'] = mb_strtoupper($value, 'UTF-8');
        } else {
            $this->attributes['matricula'] = null;
        }
    }
    
    public function setBastidorAttribute($value)
    {
        if ($value) {
            $this->attributes['bastidor'] = mb_strtoupper($value, 'UTF-8');
        } else {
            $this->attributes['bastidor'] = null;
        }
    }
    
    private function toTitleCase($string)
    {
        if (!$string) {
            return null;
        }
        
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
}