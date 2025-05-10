<?php

namespace App\Http\Controllers;

use App\Models\Siniestro;
use App\Models\Cliente;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiniestroController extends Controller
{
    public function index(Request $request)
    {
        $query = Siniestro::query()
            ->where('user_id', Auth::id())
            ->with(['cliente', 'vehiculo']);
        
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

    public function create()
    {
        $clientes = Cliente::where('user_id', Auth::id())->orderBy('nombre')->get();
        $vehiculos = Vehiculo::where('user_id', Auth::id())->orderBy('matricula')->get();
        
        return view('siniestros.create', compact('clientes', 'vehiculos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'fecha_entrada' => 'required|date|after_or_equal:today',
            'fecha_salida' => 'nullable|date|after_or_equal:fecha_entrada',
            'estado' => 'required|in:Pendiente,En proceso,Finalizado',
            'descripcion' => 'required|string|min:2',
        ], [
            'descripcion.required' => 'El campo descripción es obligatorio.',
            'descripcion.min' => 'La descripción debe contener al menos una palabra de más de un carácter.',
            'fecha_entrada.after_or_equal' => 'La fecha de entrada debe ser hoy o posterior.',
            'fecha_salida.after_or_equal' => 'La fecha de salida debe ser igual o posterior a la fecha de entrada.'
        ]);
        
        $cliente = Cliente::findOrFail($request->cliente_id);
        $vehiculo = Vehiculo::findOrFail($request->vehiculo_id);
        
        if ($cliente->user_id !== Auth::id()) {
            return back()->withErrors(['cliente_id' => 'El cliente seleccionado no es válido.'])->withInput();
        }
        
        if ($vehiculo->user_id !== Auth::id()) {
            return back()->withErrors(['vehiculo_id' => 'El vehículo seleccionado no es válido.'])->withInput();
        }
        
        $data = $request->all();
        $data['user_id'] = Auth::id();
        
        Siniestro::create($data);
        
        return redirect()->route('siniestros.index')
            ->with('success', 'Siniestro creado correctamente.');
    }

    public function show(Siniestro $siniestro)
    {
        if ($siniestro->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver este siniestro.');
        }
        
        return view('siniestros.show', compact('siniestro'));
    }

    public function edit(Siniestro $siniestro)
    {
        if ($siniestro->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar este siniestro.');
        }
        
        $clientes = Cliente::where('user_id', Auth::id())->orderBy('nombre')->get();
        $vehiculos = Vehiculo::where('user_id', Auth::id())->orderBy('matricula')->get();
        
        return view('siniestros.edit', compact('siniestro', 'clientes', 'vehiculos'));
    }

    public function update(Request $request, Siniestro $siniestro)
    {
        if ($siniestro->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para actualizar este siniestro.');
        }
        
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'fecha_entrada' => 'required|date|after_or_equal:today',
            'fecha_salida' => 'nullable|date|after_or_equal:fecha_entrada',
            'estado' => 'required|in:Pendiente,En proceso,Finalizado',
            'descripcion' => 'required|string|min:2',
        ], [
            'descripcion.required' => 'El campo descripción es obligatorio.',
            'descripcion.min' => 'La descripción debe contener al menos una palabra de más de un carácter.',
            'fecha_entrada.after_or_equal' => 'La fecha de entrada debe ser hoy o posterior.',
            'fecha_salida.after_or_equal' => 'La fecha de salida debe ser igual o posterior a la fecha de entrada.'
        ]);
        
        $cliente = Cliente::findOrFail($request->cliente_id);
        $vehiculo = Vehiculo::findOrFail($request->vehiculo_id);
        
        if ($cliente->user_id !== Auth::id()) {
            return back()->withErrors(['cliente_id' => 'El cliente seleccionado no es válido.'])->withInput();
        }
        
        if ($vehiculo->user_id !== Auth::id()) {
            return back()->withErrors(['vehiculo_id' => 'El vehículo seleccionado no es válido.'])->withInput();
        }
        
        $siniestro->update($request->all());
        
        return redirect()->route('siniestros.index')
            ->with('success', 'Siniestro actualizado correctamente.');
    }

    public function destroy(Siniestro $siniestro)
    {
        if ($siniestro->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar este siniestro.');
        }
        
        $siniestro->delete();
        
        return redirect()->route('siniestros.index')
            ->with('success', 'Siniestro eliminado correctamente.');
    }
}