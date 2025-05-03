<?php

namespace App\Http\Controllers;

use App\Models\Recambio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RecambioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Solo mostrar recambios del usuario autenticado
        $query = Recambio::where('user_id', Auth::id());
        
        // Búsqueda
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('producto', 'like', "%{$search}%")
                  ->orWhere('referencia', 'like', "%{$search}%")
                  ->orWhere('descripcion', 'like', "%{$search}%");
            });
        }
        
        $recambios = $query->paginate(10);
        return view('recambios.index', compact('recambios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('recambios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'producto' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'referencia' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0.01',
            'descripcion' => 'required|string',
        ], [
            'producto.required' => 'El campo producto es obligatorio.',
            'cantidad.required' => 'El campo cantidad es obligatorio.',
            'cantidad.min' => 'La cantidad debe ser al menos 1.',
            'referencia.required' => 'El campo referencia es obligatorio.',
            'precio.required' => 'El campo precio es obligatorio.',
            'precio.min' => 'El precio debe ser mayor que 0.',
            'descripcion.required' => 'El campo descripción es obligatorio.',
        ]);

        try {
            // Validar que la descripción tenga al menos una palabra de más de un carácter
            $descripcion = trim($request->descripcion);
            $palabras = preg_split('/\s+/', $descripcion);
            $tieneDescripcionValida = false;
            
            foreach ($palabras as $palabra) {
                if (strlen($palabra) > 1) {
                    $tieneDescripcionValida = true;
                    break;
                }
            }
            
            if (!$tieneDescripcionValida) {
                return back()->withErrors(['descripcion' => 'La descripción debe contener al menos una palabra de más de un carácter.'])->withInput();
            }
            
            // Crear el recambio
            $recambio = new Recambio([
                'producto' => $request->producto,
                'cantidad' => $request->cantidad,
                'referencia' => $request->referencia,
                'precio' => $request->precio,
                'descripcion' => $request->descripcion,
                'user_id' => Auth::id(),
            ]);
            
            $recambio->save();

            Log::info('Recambio creado correctamente', ['recambio_id' => $recambio->id, 'user_id' => Auth::id()]);
            return redirect()->route('recambios.index')->with('success', 'Recambio creado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al crear recambio: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al crear el recambio.'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Recambio $recambio)
    {
        // Verificar que el recambio pertenece al usuario autenticado
        if ($recambio->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver este recambio.');
        }

        return view('recambios.show', compact('recambio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recambio $recambio)
    {
        // Verificar que el recambio pertenece al usuario autenticado
        if ($recambio->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar este recambio.');
        }

        return view('recambios.edit', compact('recambio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recambio $recambio)
    {
        // Verificar que el recambio pertenece al usuario autenticado
        if ($recambio->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para actualizar este recambio.');
        }

        $request->validate([
            'producto' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'referencia' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0.01',
            'descripcion' => 'required|string',
        ], [
            'producto.required' => 'El campo producto es obligatorio.',
            'cantidad.required' => 'El campo cantidad es obligatorio.',
            'cantidad.min' => 'La cantidad debe ser al menos 1.',
            'referencia.required' => 'El campo referencia es obligatorio.',
            'precio.required' => 'El campo precio es obligatorio.',
            'precio.min' => 'El precio debe ser mayor que 0.',
            'descripcion.required' => 'El campo descripción es obligatorio.',
        ]);

        try {
            // Validar que la descripción tenga al menos una palabra de más de un carácter
            $descripcion = trim($request->descripcion);
            $palabras = preg_split('/\s+/', $descripcion);
            $tieneDescripcionValida = false;
            
            foreach ($palabras as $palabra) {
                if (strlen($palabra) > 1) {
                    $tieneDescripcionValida = true;
                    break;
                }
            }
            
            if (!$tieneDescripcionValida) {
                return back()->withErrors(['descripcion' => 'La descripción debe contener al menos una palabra de más de un carácter.'])->withInput();
            }
            
            // Actualizar el recambio
            $recambio->update([
                'producto' => $request->producto,
                'cantidad' => $request->cantidad,
                'referencia' => $request->referencia,
                'precio' => $request->precio,
                'descripcion' => $request->descripcion,
            ]);
            
            Log::info('Recambio actualizado correctamente', ['recambio_id' => $recambio->id, 'user_id' => Auth::id()]);
            return redirect()->route('recambios.index')->with('success', 'Recambio actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar recambio: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al actualizar el recambio.'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recambio $recambio)
    {
        // Verificar que el recambio pertenece al usuario autenticado
        if ($recambio->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar este recambio.');
        }

        try {
            $recambio->delete();
            
            Log::info('Recambio eliminado correctamente', ['recambio_id' => $recambio->id, 'user_id' => Auth::id()]);
            return redirect()->route('recambios.index')->with('success', 'Recambio eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar recambio: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al eliminar el recambio.']);
        }
    }
}
