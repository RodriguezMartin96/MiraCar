<?php

namespace App\Http\Controllers;

use App\Models\Siniestro;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SiniestroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Solo mostrar siniestros del usuario autenticado
        $siniestros = Siniestro::where('user_id', Auth::id())->with('vehiculo')->paginate(10);
        return view('siniestros.index', compact('siniestros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Solo mostrar vehículos del usuario autenticado
        $vehiculos = Vehiculo::where('user_id', Auth::id())->with('cliente')->get();
        return view('siniestros.create', compact('vehiculos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'descripcion' => 'required|string',
            'estado' => 'required|string|in:pendiente,en_proceso,finalizado',
            'vehiculo_id' => 'required|exists:vehiculos,id',
        ]);

        try {
            // Verificar que el vehículo pertenece al usuario autenticado
            $vehiculo = Vehiculo::findOrFail($request->vehiculo_id);
            if ($vehiculo->user_id !== Auth::id()) {
                return back()->withErrors(['vehiculo_id' => 'El vehículo seleccionado no es válido.'])->withInput();
            }

            // Asociar el siniestro al usuario autenticado
            $siniestro = new Siniestro($request->all());
            $siniestro->user_id = Auth::id();
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

        // Solo mostrar vehículos del usuario autenticado
        $vehiculos = Vehiculo::where('user_id', Auth::id())->with('cliente')->get();
        return view('siniestros.edit', compact('siniestro', 'vehiculos'));
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
            'fecha' => 'required|date',
            'descripcion' => 'required|string',
            'estado' => 'required|string|in:pendiente,en_proceso,finalizado',
            'vehiculo_id' => 'required|exists:vehiculos,id',
        ]);

        try {
            // Verificar que el vehículo pertenece al usuario autenticado
            $vehiculo = Vehiculo::findOrFail($request->vehiculo_id);
            if ($vehiculo->user_id !== Auth::id()) {
                return back()->withErrors(['vehiculo_id' => 'El vehículo seleccionado no es válido.'])->withInput();
            }

            $siniestro->update($request->all());
            
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
