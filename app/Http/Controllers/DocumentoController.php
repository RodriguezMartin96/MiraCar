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
    public function index(Request $request)
    {
        // Solo mostrar documentos del usuario autenticado
        $query = Documento::where('user_id', Auth::id());
        
        // Búsqueda
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('descripcion', 'like', "%{$search}%")
                  ->orWhere('otro_nombre', 'like', "%{$search}%")
                  ->orWhere('otra_descripcion', 'like', "%{$search}%");
            });
        }
        
        $documentos = $query->paginate(10);
        return view('documentacion.index', compact('documentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = [
            'Factura',
            'Presupuesto',
            'Informe técnico',
            'Peritaje',
            'Contrato',
            'Seguro',
            'Garantía',
            'Manual',
            'Certificado',
            'otro'
        ];
        
        $descripciones = [
            'Documento de cliente',
            'Documento de vehículo',
            'Documento de siniestro',
            'Documento de recambio',
            'Documento de taller',
            'Documento administrativo',
            'Documento legal',
            'otro'
        ];
        
        return view('documentacion.create', compact('categorias', 'descripciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'archivo' => 'required|file|max:10240', // 10MB máximo
            'otroNombre' => 'required_if:nombre,otro|nullable|string|max:255',
            'otraDescripcion' => 'required_if:descripcion,otro|nullable|string|max:255',
        ]);

        try {
            // Obtener la extensión del archivo
            $extension = $request->file('archivo')->getClientOriginalExtension();
            
            // Guardar el archivo
            $rutaArchivo = $request->file('archivo')->store('documentos/' . Auth::id(), 'public');
            
            // Crear el documento
            $documento = new Documento([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'formato' => $extension, // Guardar la extensión como formato
                'ruta_archivo' => $rutaArchivo,
                'otro_nombre' => $request->nombre === 'otro' ? $request->otroNombre : null,
                'otra_descripcion' => $request->descripcion === 'otro' ? $request->otraDescripcion : null,
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

        return view('documentacion.show', compact('documento'));
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
        
        $categorias = [
            'Factura',
            'Presupuesto',
            'Informe técnico',
            'Peritaje',
            'Contrato',
            'Seguro',
            'Garantía',
            'Manual',
            'Certificado',
            'otro'
        ];
        
        $descripciones = [
            'Documento de cliente',
            'Documento de vehículo',
            'Documento de siniestro',
            'Documento de recambio',
            'Documento de taller',
            'Documento administrativo',
            'Documento legal',
            'otro'
        ];

        return view('documentacion.edit', compact('documento', 'categorias', 'descripciones'));
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
            'descripcion' => 'required|string|max:255',
            'archivo' => 'nullable|file|max:10240', // 10MB máximo
            'otroNombre' => 'required_if:nombre,otro|nullable|string|max:255',
            'otraDescripcion' => 'required_if:descripcion,otro|nullable|string|max:255',
        ]);

        try {
            // Actualizar datos del documento
            $documento->nombre = $request->nombre;
            $documento->descripcion = $request->descripcion;
            $documento->otro_nombre = $request->nombre === 'otro' ? $request->otroNombre : null;
            $documento->otra_descripcion = $request->descripcion === 'otro' ? $request->otraDescripcion : null;

            // Si se ha subido un nuevo archivo
            if ($request->hasFile('archivo') && $request->file('archivo')->isValid()) {
                // Obtener la extensión del nuevo archivo
                $extension = $request->file('archivo')->getClientOriginalExtension();
                
                // Actualizar el formato con la nueva extensión
                $documento->formato = $extension;
                
                // Eliminar el archivo anterior
                if (Storage::disk('public')->exists($documento->ruta_archivo)) {
                    Storage::disk('public')->delete($documento->ruta_archivo);
                }

                // Guardar el nuevo archivo
                $rutaArchivo = $request->file('archivo')->store('documentos/' . Auth::id(), 'public');
                $documento->ruta_archivo = $rutaArchivo;
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
            if (Storage::disk('public')->exists($documento->ruta_archivo)) {
                Storage::disk('public')->delete($documento->ruta_archivo);
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

        if (Storage::disk('public')->exists($documento->ruta_archivo)) {
            $nombreArchivo = ($documento->nombre === 'otro' ? $documento->otro_nombre : $documento->nombre) . '.' . $documento->formato;
            return Storage::disk('public')->download($documento->ruta_archivo, $nombreArchivo);
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

        if (Storage::disk('public')->exists($documento->ruta_archivo)) {
            return response()->file(Storage::disk('public')->path($documento->ruta_archivo));
        }

        return back()->withErrors(['error' => 'El archivo no existe.']);
    }
}