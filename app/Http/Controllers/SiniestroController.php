<?php

namespace App\Http\Controllers;

use App\Models\Siniestro;
use App\Models\Cliente;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class SiniestroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Siniestro::with(['cliente', 'vehiculo']);
        
        // Si hay un término de búsqueda, filtramos los resultados
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('numero', 'LIKE', "%{$search}%")
                  ->orWhere('estado', 'LIKE', "%{$search}%")
                  ->orWhere('descripcion', 'LIKE', "%{$search}%")
                  ->orWhereHas('cliente', function($q) use ($search) {
                      $q->where('nombre', 'LIKE', "%{$search}%")
                        ->orWhere('apellidos', 'LIKE', "%{$search}%")
                        ->orWhere('dni', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('vehiculo', function($q) use ($search) {
                      $q->where('matricula', 'LIKE', "%{$search}%")
                        ->orWhere('marca', 'LIKE', "%{$search}%")
                        ->orWhere('modelo', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        // Ordenamos por fecha de entrada descendente y paginamos los resultados
        $siniestros = $query->orderBy('fecha_entrada', 'desc')->paginate(10);
        
        return view('siniestros.index', compact('siniestros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $vehiculos = Vehiculo::all();
        return view('siniestros.create', compact('clientes', 'vehiculos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'nullable|date|after_or_equal:fecha_entrada',
            'estado' => 'nullable|string|max:50',
            'descripcion' => 'nullable|string',
        ]);

        // Generar número de siniestro automáticamente
        $ultimoSiniestro = Siniestro::orderBy('id', 'desc')->first();
        $anioActual = date('Y');
        
        if ($ultimoSiniestro) {
            // Extraer el número del último siniestro
            $partes = explode('-', $ultimoSiniestro->numero);
            $anioUltimoSiniestro = isset($partes[0]) ? $partes[0] : $anioActual;
            $numeroUltimoSiniestro = isset($partes[1]) ? intval($partes[1]) : 0;
            
            // Si es un nuevo año, reiniciar el contador
            if ($anioUltimoSiniestro != $anioActual) {
                $nuevoNumero = 1;
            } else {
                $nuevoNumero = $numeroUltimoSiniestro + 1;
            }
        } else {
            $nuevoNumero = 1;
        }
        
        // Formatear el número de siniestro: YYYY-XXXX (año-número secuencial)
        $numeroSiniestro = $anioActual . '-' . str_pad($nuevoNumero, 4, '0', STR_PAD_LEFT);
        
        // Crear el siniestro con los datos del formulario y el número generado
        $siniestro = new Siniestro($request->all());
        $siniestro->numero = $numeroSiniestro;
        $siniestro->save();

        return redirect()->route('siniestros.index')
            ->with('success', 'Siniestro creado correctamente con número: ' . $numeroSiniestro);
    }

    /**
     * Display the specified resource.
     */
    public function show(Siniestro $siniestro)
    {
        $siniestro->load(['cliente', 'vehiculo']);
        return view('siniestros.show', compact('siniestro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siniestro $siniestro)
    {
        $clientes = Cliente::all();
        $vehiculos = Vehiculo::all();
        return view('siniestros.edit', compact('siniestro', 'clientes', 'vehiculos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siniestro $siniestro)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'nullable|date|after_or_equal:fecha_entrada',
            'estado' => 'nullable|string|max:50',
            'descripcion' => 'nullable|string',
        ]);

        // Mantener el número de siniestro original
        $datosActualizados = $request->all();
        unset($datosActualizados['numero']); // Eliminar el número del request para que no se actualice
        
        $siniestro->update($datosActualizados);

        return redirect()->route('siniestros.index')
            ->with('success', 'Siniestro actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siniestro $siniestro)
    {
        $siniestro->delete();

        return redirect()->route('siniestros.index')
            ->with('success', 'Siniestro eliminado correctamente.');
    }
}