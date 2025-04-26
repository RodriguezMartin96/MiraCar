<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Documento::query();
        
        // Si hay un término de búsqueda, filtramos los resultados
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('descripcion', 'LIKE', "%{$search}%")
                  ->orWhere('otro_nombre', 'LIKE', "%{$search}%")
                  ->orWhere('otra_descripcion', 'LIKE', "%{$search}%");
            });
        }
        
        // Obtenemos todos los documentos
        $documentos = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('documentacion.index', compact('documentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener las categorías disponibles para el dropdown
        $categorias = Documento::select('nombre')
            ->where('nombre', '!=', 'otro')
            ->distinct()
            ->pluck('nombre')
            ->toArray();
            
        // Si no hay categorías, añadimos algunas por defecto
        if (empty($categorias)) {
            $categorias = ['Nóminas', 'Alta Taller', 'Documentación Legal', 'Facturas', 'Contratos'];
        }
        
        // Obtener las descripciones disponibles para el dropdown
        $descripciones = Documento::select('descripcion')
            ->where('descripcion', '!=', 'otro')
            ->distinct()
            ->pluck('descripcion')
            ->toArray();
            
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
            'formato' => 'required|string|max:50',
            'archivo' => 'required|file|max:10240', // Máximo 10MB
            'otroNombre' => 'nullable|string|max:255',
            'otraDescripcion' => 'nullable|string|max:255',
        ]);

        $documento = new Documento();
        $documento->nombre = $request->nombre;
        $documento->descripcion = $request->descripcion;
        $documento->formato = $request->formato;
        
        // Guardar valores personalizados si se seleccionó "otro"
        if ($request->nombre == 'otro' && $request->filled('otroNombre')) {
            $documento->otro_nombre = $request->otroNombre;
        }
        
        if ($request->descripcion == 'otro' && $request->filled('otraDescripcion')) {
            $documento->otra_descripcion = $request->otraDescripcion;
        }
        
        // Si se ha subido un archivo, lo guardamos
        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
            $ruta = $archivo->storeAs('documentos', $nombreArchivo, 'public');
            $documento->ruta_archivo = $ruta;
        }
        
        $documento->save();

        return redirect()->route('documentos.index')
            ->with('success', 'Documento agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Documento $documento)
    {
        return view('documentacion.show', compact('documento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Documento $documento)
    {
        // Obtener las categorías disponibles para el dropdown
        $categorias = Documento::select('nombre')
            ->where('nombre', '!=', 'otro')
            ->distinct()
            ->pluck('nombre')
            ->toArray();
            
        // Si no hay categorías, añadimos algunas por defecto
        if (empty($categorias)) {
            $categorias = ['Nóminas', 'Alta Taller', 'Documentación Legal', 'Facturas', 'Contratos'];
        }
        
        // Obtener las descripciones disponibles para el dropdown
        $descripciones = Documento::select('descripcion')
            ->where('descripcion', '!=', 'otro')
            ->distinct()
            ->pluck('descripcion')
            ->toArray();
            
        return view('documentacion.edit', compact('documento', 'categorias', 'descripciones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Documento $documento)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'formato' => 'required|string|max:50',
            'archivo' => 'nullable|file|max:10240', // Máximo 10MB
            'otroNombre' => 'nullable|string|max:255',
            'otraDescripcion' => 'nullable|string|max:255',
        ]);

        $documento->nombre = $request->nombre;
        $documento->descripcion = $request->descripcion;
        $documento->formato = $request->formato;
        
        // Guardar valores personalizados si se seleccionó "otro"
        if ($request->nombre == 'otro' && $request->filled('otroNombre')) {
            $documento->otro_nombre = $request->otroNombre;
        } else {
            $documento->otro_nombre = null; // Limpiar el valor si ya no se usa
        }
        
        if ($request->descripcion == 'otro' && $request->filled('otraDescripcion')) {
            $documento->otra_descripcion = $request->otraDescripcion;
        } else {
            $documento->otra_descripcion = null; // Limpiar el valor si ya no se usa
        }
        
        // Si se ha subido un nuevo archivo, eliminamos el anterior y guardamos el nuevo
        if ($request->hasFile('archivo')) {
            // Eliminar archivo anterior si existe
            if ($documento->ruta_archivo && Storage::disk('public')->exists($documento->ruta_archivo)) {
                Storage::disk('public')->delete($documento->ruta_archivo);
            }
            
            $archivo = $request->file('archivo');
            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
            $ruta = $archivo->storeAs('documentos', $nombreArchivo, 'public');
            $documento->ruta_archivo = $ruta;
        }
        
        $documento->save();

        return redirect()->route('documentos.index')
            ->with('success', 'Documento actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documento $documento)
    {
        // Eliminar archivo si existe
        if ($documento->ruta_archivo && Storage::disk('public')->exists($documento->ruta_archivo)) {
            Storage::disk('public')->delete($documento->ruta_archivo);
        }
        
        $documento->delete();

        return redirect()->route('documentos.index')
            ->with('success', 'Documento eliminado correctamente.');
    }
    
    /**
     * Download the specified document.
     */
    public function download(Documento $documento)
    {
        if (!$documento->ruta_archivo || !Storage::disk('public')->exists($documento->ruta_archivo)) {
            return redirect()->back()->with('error', 'El archivo no existe.');
        }
        
        return Storage::disk('public')->download($documento->ruta_archivo, $documento->nombre . '_' . $documento->id);
    }
    
    /**
     * View the specified document.
     */
    public function view(Documento $documento)
    {
        if (!$documento->ruta_archivo || !Storage::disk('public')->exists($documento->ruta_archivo)) {
            return redirect()->back()->with('error', 'El archivo no existe.');
        }
        
        $path = Storage::disk('public')->path($documento->ruta_archivo);
        $type = mime_content_type($path);
        
        if (in_array($type, ['application/pdf'])) {
            return response()->file($path);
        }
        
        return redirect()->route('documentos.download', $documento);
    }
}