<?php

namespace App\Http\Controllers;

use App\Models\Siniestro;
use App\Models\Vehiculo;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SiniestroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Solo mostrar siniestros del usuario autenticado
        $query = Siniestro::where('user_id', Auth::id())
            ->with(['vehiculo', 'cliente']);
        
        // Búsqueda
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('numero', 'like', "%{$search}%")
                  ->orWhere('estado', 'like', "%{$search}%")
                  ->orWhereHas('vehiculo', function($q) use ($search) {
                      $q->where('matricula', 'like', "%{$search}%")
                        ->orWhere('marca', 'like', "%{$search}%")
                        ->orWhere('modelo', 'like', "%{$search}%");
                  })
                  ->orWhereHas('cliente', function($q) use ($search) {
                      $q->where('nombre', 'like', "%{$search}%")
                        ->orWhere('apellidos', 'like', "%{$search}%")
                        ->orWhere('dni', 'like', "%{$search}%");
                  });
            });
        }
        
        $siniestros = $query->paginate(10);
        return view('siniestros.index', compact('siniestros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Solo mostrar vehículos y clientes del usuario autenticado
        $vehiculos = Vehiculo::where('user_id', Auth::id())->with('cliente')->get();
        $clientes = Cliente::where('user_id', Auth::id())->get();
        return view('siniestros.create', compact('vehiculos', 'clientes'));
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
            'estado' => 'required|in:Pendiente,En proceso,Finalizado',
            'descripcion' => 'nullable|string',
        ]);

        try {
            // Verificar que el vehículo y cliente pertenecen al usuario autenticado
            $vehiculo = Vehiculo::findOrFail($request->vehiculo_id);
            $cliente = Cliente::findOrFail($request->cliente_id);
            
            if ($vehiculo->user_id !== Auth::id() || $cliente->user_id !== Auth::id()) {
                return back()->withErrors(['error' => 'El vehículo o cliente seleccionado no es válido.'])->withInput();
            }

            // Generar número de siniestro único
            $numero = 'S-' . date('Ymd') . '-' . strtoupper(Str::random(5));
            
            // Crear el siniestro
            $siniestro = new Siniestro([
                'numero' => $numero,
                'cliente_id' => $request->cliente_id,
                'vehiculo_id' => $request->vehiculo_id,
                'fecha_entrada' => $request->fecha_entrada,
                'fecha_salida' => $request->fecha_salida,
                'estado' => $request->estado,
                'descripcion' => $request->descripcion,
                'user_id' => Auth::id(),
            ]);
            
            $siniestro->save();

            Log::info('Siniestro creado correctamente', ['siniestro_id' => $siniestro->id, 'user_id' => Auth::id()]);
            return redirect()->route('siniestros.index')->with('success', 'Siniestro creado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al crear siniestro: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al crear el siniestro.'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Siniestro $siniestro)
    {
        // Verificar que el siniestro pertenece al usuario autenticado
        if ($siniestro->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver este siniestro.');
        }

        // Cargar relaciones
        $siniestro->load(['vehiculo', 'cliente']);
        
        return view('siniestros.show', compact('siniestro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siniestro $siniestro)
    {
        // Verificar que el siniestro pertenece al usuario autenticado
        if ($siniestro->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar este siniestro.');
        }

        // Solo mostrar vehículos y clientes del usuario autenticado
        $vehiculos = Vehiculo::where('user_id', Auth::id())->with('cliente')->get();
        $clientes = Cliente::where('user_id', Auth::id())->get();
        
        return view('siniestros.edit', compact('siniestro', 'vehiculos', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siniestro $siniestro)
    {
        // Verificar que el siniestro pertenece al usuario autenticado
        if ($siniestro->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para actualizar este siniestro.');
        }

        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'nullable|date|after_or_equal:fecha_entrada',
            'estado' => 'required|in:Pendiente,En proceso,Finalizado',
            'descripcion' => 'nullable|string',
        ]);

        try {
            // Verificar que el vehículo y cliente pertenecen al usuario autenticado
            $vehiculo = Vehiculo::findOrFail($request->vehiculo_id);
            $cliente = Cliente::findOrFail($request->cliente_id);
            
            if ($vehiculo->user_id !== Auth::id() || $cliente->user_id !== Auth::id()) {
                return back()->withErrors(['error' => 'El vehículo o cliente seleccionado no es válido.'])->withInput();
            }

            // Actualizar el siniestro
            $siniestro->update([
                'cliente_id' => $request->cliente_id,
                'vehiculo_id' => $request->vehiculo_id,
                'fecha_entrada' => $request->fecha_entrada,
                'fecha_salida' => $request->fecha_salida,
                'estado' => $request->estado,
                'descripcion' => $request->descripcion,
            ]);
            
            Log::info('Siniestro actualizado correctamente', ['siniestro_id' => $siniestro->id, 'user_id' => Auth::id()]);
            return redirect()->route('siniestros.index')->with('success', 'Siniestro actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar siniestro: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al actualizar el siniestro.'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siniestro $siniestro)
    {
        // Verificar que el siniestro pertenece al usuario autenticado
        if ($siniestro->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar este siniestro.');
        }

        try {
            $siniestro->delete();
            
            Log::info('Siniestro eliminado correctamente', ['siniestro_id' => $siniestro->id, 'user_id' => Auth::id()]);
            return redirect()->route('siniestros.index')->with('success', 'Siniestro eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar siniestro: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al eliminar el siniestro.']);
        }
    }
}