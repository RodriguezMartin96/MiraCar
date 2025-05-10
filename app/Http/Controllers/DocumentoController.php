<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    public function index(Request $request)
    {
        $query = Documento::where('user_id', Auth::id());
        
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

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'archivo' => 'required|file|max:10240',
            'otroNombre' => 'required_if:nombre,otro|nullable|string|max:255',
            'otraDescripcion' => 'required_if:descripcion,otro|nullable|string|max:255',
        ]);

        try {
            $extension = $request->file('archivo')->getClientOriginalExtension();
            $rutaArchivo = $request->file('archivo')->store('documentos/' . Auth::id(), 'public');
            
            $documento = new Documento([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'formato' => $extension,
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

    public function show(Documento $documento)
    {
        if ($documento->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver este documento.');
        }

        return view('documentacion.show', compact('documento'));
    }

    public function edit(Documento $documento)
    {
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

    public function update(Request $request, Documento $documento)
    {
        if ($documento->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para actualizar este documento.');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'archivo' => 'nullable|file|max:10240',
            'otroNombre' => 'required_if:nombre,otro|nullable|string|max:255',
            'otraDescripcion' => 'required_if:descripcion,otro|nullable|string|max:255',
        ]);

        try {
            $documento->nombre = $request->nombre;
            $documento->descripcion = $request->descripcion;
            $documento->otro_nombre = $request->nombre === 'otro' ? $request->otroNombre : null;
            $documento->otra_descripcion = $request->descripcion === 'otro' ? $request->otraDescripcion : null;

            if ($request->hasFile('archivo') && $request->file('archivo')->isValid()) {
                $extension = $request->file('archivo')->getClientOriginalExtension();
                $documento->formato = $extension;
                
                if (Storage::disk('public')->exists($documento->ruta_archivo)) {
                    Storage::disk('public')->delete($documento->ruta_archivo);
                }

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

    public function destroy(Documento $documento)
    {
        if ($documento->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar este documento.');
        }

        try {
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

    public function download(Documento $documento)
    {
        if ($documento->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para descargar este documento.');
        }

        if (Storage::disk('public')->exists($documento->ruta_archivo)) {
            $nombreArchivo = ($documento->nombre === 'otro' ? $documento->otro_nombre : $documento->nombre) . '.' . $documento->formato;
            return Storage::disk('public')->download($documento->ruta_archivo, $nombreArchivo);
        }

        return back()->withErrors(['error' => 'El archivo no existe.']);
    }

    public function view(Documento $documento)
    {
        if ($documento->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver este documento.');
        }

        if (Storage::disk('public')->exists($documento->ruta_archivo)) {
            return response()->file(Storage::disk('public')->path($documento->ruta_archivo));
        }

        return back()->withErrors(['error' => 'El archivo no existe.']);
    }
}