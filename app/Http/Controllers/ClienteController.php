<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Solo mostrar clientes del usuario autenticado
        $clientes = Cliente::where('user_id', Auth::id())->paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:clientes',
            'email' => 'required|string|email|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
        ]);

        try {
            // Asociar el cliente al usuario autenticado
            $cliente = new Cliente($request->all());
            $cliente->user_id = Auth::id();
            $cliente->save();

            Log::info('Cliente creado correctamente', ['cliente_id' => $cliente->id, 'user_id' => Auth::id()]);
            return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al crear cliente: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al crear el cliente.'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        // Verificar que el cliente pertenece al usuario autenticado
        if ($cliente->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver este cliente.');
        }

        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        // Verificar que el cliente pertenece al usuario autenticado
        if ($cliente->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar este cliente.');
        }

        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        // Verificar que el cliente pertenece al usuario autenticado
        if ($cliente->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para actualizar este cliente.');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:clientes,dni,' . $cliente->id,
            'email' => 'required|string|email|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
        ]);

        try {
            $cliente->update($request->all());
            
            Log::info('Cliente actualizado correctamente', ['cliente_id' => $cliente->id, 'user_id' => Auth::id()]);
            return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar cliente: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al actualizar el cliente.'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        // Verificar que el cliente pertenece al usuario autenticado
        if ($cliente->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar este cliente.');
        }

        try {
            $cliente->delete();
            
            Log::info('Cliente eliminado correctamente', ['cliente_id' => $cliente->id, 'user_id' => Auth::id()]);
            return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar cliente: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al eliminar el cliente.']);
        }
    }
}
