<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Solo mostrar documentos del usuario autenticado
        $documentos = Documento::where('user_id', Auth::id())->paginate(10);
        return view('documentos.index', compact('documentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('documentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'archivo' => 'required|file|max:10240', // 10MB máximo
        ]);

        try {
            // Guardar el archivo
            $ruta = $request->file('archivo')->store('documentos/' . Auth::id(), 'public');
            $tipo = $request->file('archivo')->getClientOriginalExtension();

            // Asociar el documento al usuario autenticado
            $documento = new Documento([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'ruta' => $ruta,
                'tipo' => $tipo,
                'user_id' => Auth::id(),
            ]);
            $documento->save();

            Log::info('Documento creado correctamente', ['documento_id' => $documento->id, 'user_id' => Auth::id()]);
            return redirect()->route('documentos.index')->with('success', 'Documento creado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al crear documento: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al crear el documento.'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Documento $documento)
    {
        // Verificar que el documento pertenece al usuario autenticado
        if ($documento->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver este documento.');
        }

        return view('documentos.show', compact('documento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Documento $documento)
    {
        // Verificar que el documento pertenece al usuario autenticado
        if ($documento->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar este documento.');
        }

        return view('documentos.edit', compact('documento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Documento $documento)
    {
        // Verificar que el documento pertenece al usuario autenticado
        if ($documento->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para actualizar este documento.');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'archivo' => 'nullable|file|max:10240', // 10MB máximo
        ]);

        try {
            $documento->nombre = $request->nombre;
            $documento->descripcion = $request->descripcion;

            // Si se ha subido un nuevo archivo
            if ($request->hasFile('archivo') && $request->file('archivo')->isValid()) {
                // Eliminar el archivo anterior
                if (Storage::disk('public')->exists($documento->ruta)) {
                    Storage::disk('public')->delete($documento->ruta);
                }

                // Guardar el nuevo archivo
                $ruta = $request->file('archivo')->store('documentos/' . Auth::id(), 'public');
                $tipo = $request->file('archivo')->getClientOriginalExtension();

                $documento->ruta = $ruta;
                $documento->tipo = $tipo;
            }

            $documento->save();
            
            Log::info('Documento actualizado correctamente', ['documento_id' => $documento->id, 'user_id' => Auth::id()]);
            return redirect()->route('documentos.index')->with('success', 'Documento actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar documento: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al actualizar el documento.'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documento $documento)
    {
        // Verificar que el documento pertenece al usuario autenticado
        if ($documento->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar este documento.');
        }

        try {
            // Eliminar el archivo
            if (Storage::disk('public')->exists($documento->ruta)) {
                Storage::disk('public')->delete($documento->ruta);
            }

            $documento->delete();
            
            Log::info('Documento eliminado correctamente', ['documento_id' => $documento->id, 'user_id' => Auth::id()]);
            return redirect()->route('documentos.index')->with('success', 'Documento eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar documento: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al eliminar el documento.']);
        }
    }

    /**
     * Download the specified resource.
     */
    public function download(Documento $documento)
    {
        // Verificar que el documento pertenece al usuario autenticado
        if ($documento->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para descargar este documento.');
        }

        if (Storage::disk('public')->exists($documento->ruta)) {
            return Storage::disk('public')->download($documento->ruta, $documento->nombre . '.' . $documento->tipo);
        }

        return back()->withErrors(['error' => 'El archivo no existe.']);
    }

    /**
     * View the specified resource.
     */
    public function view(Documento $documento)
    {
        // Verificar que el documento pertenece al usuario autenticado
        if ($documento->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver este documento.');
        }

        if (Storage::disk('public')->exists($documento->ruta)) {
            return response()->file(Storage::disk('public')->path($documento->ruta));
        }

        return back()->withErrors(['error' => 'El archivo no existe.']);
    }
}
