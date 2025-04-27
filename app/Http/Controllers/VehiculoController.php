<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Solo mostrar vehículos del usuario autenticado
        $query = Vehiculo::where('user_id', Auth::id())->with('cliente');
        
        // Búsqueda
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('marca', 'like', "%{$search}%")
                  ->orWhere('modelo', 'like', "%{$search}%")
                  ->orWhere('matricula', 'like', "%{$search}%")
                  ->orWhereHas('cliente', function($q) use ($search) {
                      $q->where('nombre', 'like', "%{$search}%")
                        ->orWhere('apellidos', 'like', "%{$search}%")
                        ->orWhere('dni', 'like', "%{$search}%");
                  });
            });
        }
        
        $vehiculos = $query->paginate(10);
        return view('vehiculos.index', compact('vehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Solo mostrar clientes del usuario autenticado
        $clientes = Cliente::where('user_id', Auth::id())->get();
        return view('vehiculos.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'matricula' => 'required|string|max:20|unique:vehiculos',
            'color' => 'required|string|max:50',
            'cliente_id' => 'required|exists:clientes,id',
            'bastidor' => 'nullable|string|max:255',
            'fecha_matriculacion' => 'nullable|date',
        ]);

        try {
            // Verificar que el cliente pertenece al usuario autenticado
            $cliente = Cliente::findOrFail($request->cliente_id);
            if ($cliente->user_id !== Auth::id()) {
                return back()->withErrors(['cliente_id' => 'El cliente seleccionado no es válido.'])->withInput();
            }

            // Asociar el vehículo al usuario autenticado
            $vehiculo = new Vehiculo($request->all());
            $vehiculo->user_id = Auth::id();
            $vehiculo->save();

            Log::info('Vehículo creado correctamente', ['vehiculo_id' => $vehiculo->id, 'user_id' => Auth::id()]);
            return redirect()->route('vehiculos.index')->with('success', 'Vehículo creado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al crear vehículo: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al crear el vehículo.'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehiculo $vehiculo)
    {
        // Verificar que el vehículo pertenece al usuario autenticado
        if ($vehiculo->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver este vehículo.');
        }

        return view('vehiculos.show', compact('vehiculo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehiculo $vehiculo)
    {
        // Verificar que el vehículo pertenece al usuario autenticado
        if ($vehiculo->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar este vehículo.');
        }

        // Solo mostrar clientes del usuario autenticado
        $clientes = Cliente::where('user_id', Auth::id())->get();
        return view('vehiculos.edit', compact('vehiculo', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        // Verificar que el vehículo pertenece al usuario autenticado
        if ($vehiculo->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para actualizar este vehículo.');
        }

        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'matricula' => 'required|string|max:20|unique:vehiculos,matricula,' . $vehiculo->id,
            'color' => 'required|string|max:50',
            'cliente_id' => 'required|exists:clientes,id',
            'bastidor' => 'nullable|string|max:255',
            'fecha_matriculacion' => 'nullable|date',
        ]);

        try {
            // Verificar que el cliente pertenece al usuario autenticado
            $cliente = Cliente::findOrFail($request->cliente_id);
            if ($cliente->user_id !== Auth::id()) {
                return back()->withErrors(['cliente_id' => 'El cliente seleccionado no es válido.'])->withInput();
            }

            $vehiculo->update($request->all());
            
            Log::info('Vehículo actualizado correctamente', ['vehiculo_id' => $vehiculo->id, 'user_id' => Auth::id()]);
            return redirect()->route('vehiculos.index')->with('success', 'Vehículo actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar vehículo: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al actualizar el vehículo.'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehiculo $vehiculo)
    {
        // Verificar que el vehículo pertenece al usuario autenticado
        if ($vehiculo->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar este vehículo.');
        }

        try {
            $vehiculo->delete();
            
            Log::info('Vehículo eliminado correctamente', ['vehiculo_id' => $vehiculo->id, 'user_id' => Auth::id()]);
            return redirect()->route('vehiculos.index')->with('success', 'Vehículo eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar vehículo: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al eliminar el vehículo.']);
        }
    }
}