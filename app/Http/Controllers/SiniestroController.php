<?php

namespace App\Http\Controllers;

use App\Models\Siniestro;
use App\Models\Cliente;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class SiniestroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siniestros = Siniestro::with(['cliente', 'vehiculo'])->get();
        return view('siniestros.index', compact('siniestros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $vehiculos = Vehiculo::all();
        return view('siniestros.create', compact('clientes', 'vehiculos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|string|max:50|unique:siniestros',
            'cliente_id' => 'required|exists:clientes,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'nullable|date|after_or_equal:fecha_entrada',
            'estado' => 'nullable|string|max:50',
            'descripcion' => 'nullable|string',
        ]);

        Siniestro::create($request->all());

        return redirect()->route('siniestros.index')
            ->with('success', 'Siniestro creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siniestro $siniestro)
    {
        $siniestro->load(['cliente', 'vehiculo']);
        return view('siniestros.show', compact('siniestro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siniestro $siniestro)
    {
        $clientes = Cliente::all();
        $vehiculos = Vehiculo::all();
        return view('siniestros.edit', compact('siniestro', 'clientes', 'vehiculos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siniestro $siniestro)
    {
        $request->validate([
            'numero' => 'required|string|max:50|unique:siniestros,numero,'.$siniestro->id,
            'cliente_id' => 'required|exists:clientes,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'nullable|date|after_or_equal:fecha_entrada',
            'estado' => 'nullable|string|max:50',
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