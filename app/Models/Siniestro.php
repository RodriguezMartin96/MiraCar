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

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fecha_entrada' => 'date',
        'fecha_salida' => 'date',
    ];

    /**
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();
        
        // Antes de crear un nuevo siniestro, generamos el número automáticamente
        static::creating(function ($siniestro) {
            if (!$siniestro->numero) {
                $fecha = Carbon::now()->format('Ymd');
                
                // Buscar el último siniestro con la fecha actual
                $ultimoSiniestro = static::where('numero', 'like', $fecha . '-%')
                    ->orderBy('id', 'desc')
                    ->first();
                
                if ($ultimoSiniestro) {
                    // Extraer el número secuencial del último siniestro
                    $partes = explode('-', $ultimoSiniestro->numero);
                    $secuencial = intval(end($partes)) + 1;
                } else {
                    $secuencial = 1;
                }
                
                // Generar el nuevo número de siniestro
                $siniestro->numero = $fecha . '-' . $secuencial;
            }
        });
    }

    /**
     * Obtener el usuario (taller) al que pertenece este siniestro.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener el vehículo asociado a este siniestro.
     */
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    /**
     * Obtener el cliente asociado a este siniestro.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Obtener los recambios asociados a este siniestro.
     */
    public function recambios()
    {
        return $this->hasMany(Recambio::class);
    }
    
    /**
     * Obtener el color de fondo según el estado del siniestro.
     */
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
    
    /**
     * Obtener la clase de badge según el estado del siniestro.
     */
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
    
    /**
     * Obtener el color de fondo según el estado del siniestro.
     */
    public function getEstadoColor()
    {
        switch ($this->estado) {
            case 'Finalizado':
                return '#4caf50'; // Verde
            case 'En proceso':
                return '#ff9800'; // Naranja
            case 'Pendiente':
            default:
                return '#f44336'; // Rojo
        }
    }
}