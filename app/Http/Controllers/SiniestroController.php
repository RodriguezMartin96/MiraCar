<?php

namespace App\Http\Controllers;

use App\Models\Siniestro;
use App\Models\Cliente;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiniestroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Siniestro::query()
            ->with(['cliente', 'vehiculo']);
        
        // Búsqueda
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('numero', 'like', "%{$search}%")
                  ->orWhere('estado', 'like', "%{$search}%")
                  ->orWhere('descripcion', 'like', "%{$search}%")
                  ->orWhereHas('cliente', function($q) use ($search) {
                      $q->where('nombre', 'like', "%{$search}%")
                        ->orWhere('apellidos', 'like', "%{$search}%")
                        ->orWhere('dni', 'like', "%{$search}%");
                  })
                  ->orWhereHas('vehiculo', function($q) use ($search) {
                      $q->where('matricula', 'like', "%{$search}%")
                        ->orWhere('marca', 'like', "%{$search}%")
                        ->orWhere('modelo', 'like', "%{$search}%");
                  });
            });
        }
        
        // Ordenar por estado: En proceso, Pendiente, Finalizado
        $query->orderByRaw("CASE 
            WHEN estado = 'En proceso' THEN 1 
            WHEN estado = 'Pendiente' THEN 2 
            WHEN estado = 'Finalizado' THEN 3 
            ELSE 4 
        END")
        ->orderBy('fecha_entrada', 'desc');
        
        $siniestros = $query->paginate(10);
        
        return view('siniestros.index', compact('siniestros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        $vehiculos = Vehiculo::orderBy('matricula')->get();
        
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
            'estado' => 'required|in:Pendiente,En proceso,Finalizado',
            'descripcion' => 'nullable|string',
        ]);
        
        // Asignar el usuario actual (taller) al siniestro
        $data = $request->all();
        $data['user_id'] = Auth::id();
        
        Siniestro::create($data);
        
        return redirect()->route('siniestros.index')
            ->with('success', 'Siniestro creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siniestro $siniestro)
    {
        return view('siniestros.show', compact('siniestro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siniestro $siniestro)
    {
        $clientes = Cliente::orderBy('nombre')->get();
        $vehiculos = Vehiculo::orderBy('matricula')->get();
        
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
            'estado' => 'required|in:Pendiente,En proceso,Finalizado',
            'descripcion' => 'nullable|string',
        ]);
        
        $siniestro->update($request->all());
        
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