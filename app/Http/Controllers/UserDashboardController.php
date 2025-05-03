<?php

namespace App\Http\Controllers;

use App\Models\Siniestro;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserDashboardController extends Controller
{
    /**
     * Verificar que el usuario tiene el rol correcto
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || !Auth::user()->isUser()) {
                abort(403, 'Acceso denegado. Solo los usuarios pueden acceder a esta sección.');
            }
            return $next($request);
        });
    }

    /**
     * Mostrar el dashboard para usuarios normales.
     */
    public function index()
    {
        try {
            $user = Auth::user();
            
            // Buscar vehículos asociados al DNI del usuario
            $vehiculos = Vehiculo::whereHas('cliente', function ($query) use ($user) {
                $query->where('dni', $user->dni);
            })->with(['siniestros', 'cliente.user'])->get();
            
            // Agrupar siniestros por taller
            $siniestrosPorTaller = [];
            
            foreach ($vehiculos as $vehiculo) {
                foreach ($vehiculo->siniestros as $siniestro) {
                    $tallerNombre = $siniestro->user->name ?? 'Taller desconocido';
                    $tallerLogo = $siniestro->user->logo ?? null;
                    
                    if (!isset($siniestrosPorTaller[$siniestro->user_id])) {
                        $siniestrosPorTaller[$siniestro->user_id] = [
                            'taller' => [
                                'id' => $siniestro->user_id,
                                'nombre' => $tallerNombre,
                                'logo' => $tallerLogo
                            ],
                            'siniestros' => []
                        ];
                    }
                    
                    $siniestrosPorTaller[$siniestro->user_id]['siniestros'][] = [
                        'id' => $siniestro->id,
                        'fecha' => $siniestro->fecha_entrada ?? $siniestro->fecha,
                        'descripcion' => $siniestro->descripcion,
                        'estado' => $siniestro->estado,
                        'vehiculo' => [
                            'id' => $vehiculo->id,
                            'marca' => $vehiculo->marca,
                            'modelo' => $vehiculo->modelo,
                            'matricula' => $vehiculo->matricula,
                            'color' => $vehiculo->color,
                            'año' => $vehiculo->año
                        ]
                    ];
                }
            }
            
            Log::info('Dashboard de usuario cargado', [
                'user_id' => $user->id,
                'vehiculos_encontrados' => $vehiculos->count(),
                'talleres_con_siniestros' => count($siniestrosPorTaller)
            ]);
            
            // Actualizado: Cambio de 'user.dashboard' a 'usuario.inicio'
            return view('usuario.inicio', compact('siniestrosPorTaller'));
        } catch (\Exception $e) {
            Log::error('Error al cargar dashboard de usuario: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Actualizado: Cambio de 'user.dashboard' a 'usuario.inicio'
            return view('usuario.inicio', ['error' => 'Ha ocurrido un error al cargar tus siniestros.']);
        }
    }
    
    /**
     * Mostrar detalles de un siniestro específico.
     */
    public function showSiniestro($id)
    {
        try {
            $user = Auth::user();
            
            // Buscar el siniestro y verificar que pertenece a un vehículo del usuario
            $siniestro = Siniestro::with(['vehiculo.cliente', 'user', 'recambios'])
                ->whereHas('vehiculo.cliente', function ($query) use ($user) {
                    $query->where('dni', $user->dni);
                })
                ->findOrFail($id);
            
            // Obtener los recambios asociados al siniestro
            $recambios = $siniestro->recambios;
            
            Log::info('Detalles de siniestro cargados', [
                'user_id' => $user->id,
                'siniestro_id' => $siniestro->id
            ]);
            
            // Actualizado: Cambio de 'user.siniestro' a 'usuario.siniestro'
            return view('usuario.siniestro', compact('siniestro', 'recambios'));
        } catch (\Exception $e) {
            Log::error('Error al cargar detalles de siniestro: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('user.dashboard')->with('error', 'No se encontró el siniestro solicitado.');
        }
    }
}