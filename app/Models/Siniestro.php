<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Siniestro extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'cliente_id',
        'vehiculo_id',
        'fecha_entrada',
        'fecha_salida',
        'estado',
        'descripcion',
        'daños',
        'user_id',
    ];

    protected $casts = [
        'fecha_entrada' => 'date',
        'fecha_salida' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($siniestro) {
            if (!$siniestro->numero) {
                $fecha = Carbon::now()->format('Ymd');
                
                $ultimoSiniestro = static::where('numero', 'like', $fecha . '-%')
                    ->where('user_id', $siniestro->user_id)
                    ->orderBy('id', 'desc')
                    ->first();
                
                if ($ultimoSiniestro) {
                    $partes = explode('-', $ultimoSiniestro->numero);
                    $secuencial = intval(end($partes)) + 1;
                } else {
                    $secuencial = 1;
                }
                
                $siniestro->numero = $fecha . '-' . $secuencial;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function recambios()
    {
        return $this->hasMany(Recambio::class);
    }
    
    public function getEstadoColorClass()
    {
        switch ($this->estado) {
            case 'Finalizado':
                return 'estado-finalizado';
            case 'En proceso':
                return 'estado-proceso';
            case 'Pendiente':
            default:
                return 'estado-pendiente';
        }
    }
    
    public function getEstadoBadgeClass()
    {
        switch ($this->estado) {
            case 'Finalizado':
                return 'badge-finalizado';
            case 'En proceso':
                return 'badge-proceso';
            case 'Pendiente':
            default:
                return 'badge-pendiente';
        }
    }
    
    public function getEstadoColor()
    {
        switch ($this->estado) {
            case 'Finalizado':
                return '#4caf50';
            case 'En proceso':
                return '#ff9800';
            case 'Pendiente':
            default:
                return '#f44336';
        }
    }
}