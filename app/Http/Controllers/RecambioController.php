<?php

namespace App\Http\Controllers;

use App\Models\Recambio;
use Illuminate\Http\Request;

class RecambioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recambios = Recambio::all();
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
            'referencia' => 'nullable|string|max:50',
            'precio' => 'nullable|numeric|min:0',
            'descripcion' => 'nullable|string',
        ]);

        Recambio::create($request->all());

        return redirect()->route('recambios.index')
            ->with('success', 'Recambio creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recambio $recambio)
    {
        return view('recambios.show', compact('recambio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recambio $recambio)
    {
        return view('recambios.edit', compact('recambio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recambio $recambio)
    {
        $request->validate([
            'producto' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'referencia' => 'nullable|string|max:50',
            'precio' => 'nullable|numeric|min:0',
            'descripcion' => 'nullable|string',
        ]);

        $recambio->update($request->all());

        return redirect()->route('recambios.index')
            ->with('success', 'Recambio actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recambio $recambio)
    {
        $recambio->delete();

        return redirect()->route('recambios.index')
            ->with('success', 'Recambio eliminado correctamente.');
    }
}