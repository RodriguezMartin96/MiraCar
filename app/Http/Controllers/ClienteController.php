<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Buscar clientes si hay un término de búsqueda
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $clientes = Cliente::where('user_id', Auth::id())
                ->where(function($query) use ($search) {
                    $query->where('nombre', 'LIKE', "%{$search}%")
                        ->orWhere('apellidos', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhere('telefono', 'LIKE', "%{$search}%")
                        ->orWhere('dni', 'LIKE', "%{$search}%");
                })
                ->paginate(10);
        } else {
            // Solo mostrar clientes del usuario autenticado
            $clientes = Cliente::where('user_id', Auth::id())->paginate(10);
        }
        
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
            'dni' => [
                'nullable',
                'string',
                'max:20',
                // Validar que el DNI sea único solo para el taller actual
                Rule::unique('clientes')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                })
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                // Validar que el email sea único solo para el taller actual
                Rule::unique('clientes')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                })
            ],
            'telefono' => 'required|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'cif' => 'nullable|string|max:20',
            'direccion_juridica' => 'nullable|string|max:255',
        ]);

        try {
            // Convertir nombre y apellidos a Title Case
            $clienteData = $request->all();
            $clienteData['nombre'] = $this->toTitleCase($clienteData['nombre']);
            $clienteData['apellidos'] = $this->toTitleCase($clienteData['apellidos']);
            
            // Convertir email a minúsculas y DNI a mayúsculas
            if (isset($clienteData['email'])) {
                $clienteData['email'] = mb_strtolower($clienteData['email'], 'UTF-8');
            }
            
            if (isset($clienteData['dni']) && $clienteData['dni']) {
                $clienteData['dni'] = mb_strtoupper($clienteData['dni'], 'UTF-8');
            }
            
            // Asociar el cliente al usuario autenticado
            $cliente = new Cliente($clienteData);
            $cliente->user_id = Auth::id();
            $cliente->save();

            Log::info('Cliente creado correctamente', [
                'cliente_id' => $cliente->id, 
                'user_id' => Auth::id(),
                'nombre' => $cliente->nombre,
                'apellidos' => $cliente->apellidos,
                'dni' => $cliente->dni
            ]);
            
            return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al crear cliente: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString(),
                'user_id' => Auth::id(),
                'request_data' => $request->except(['_token'])
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al crear el cliente: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        // Verificar que el cliente pertenece al usuario autenticado
        if ($cliente->user_id !== Auth::id()) {
            Log::warning('Intento de acceso no autorizado a cliente', [
                'cliente_id' => $cliente->id,
                'cliente_user_id' => $cliente->user_id,
                'user_id' => Auth::id()
            ]);
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
            Log::warning('Intento de acceso no autorizado a cliente', [
                'cliente_id' => $cliente->id,
                'cliente_user_id' => $cliente->user_id,
                'user_id' => Auth::id()
            ]);
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
            Log::warning('Intento de acceso no autorizado a cliente', [
                'cliente_id' => $cliente->id,
                'cliente_user_id' => $cliente->user_id,
                'user_id' => Auth::id()
            ]);
            abort(403, 'No tienes permiso para actualizar este cliente.');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'dni' => [
                'nullable',
                'string',
                'max:20',
                // Validar que el DNI sea único solo para el taller actual, excluyendo el cliente actual
                Rule::unique('clientes')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                })->ignore($cliente->id)
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                // Validar que el email sea único solo para el taller actual, excluyendo el cliente actual
                Rule::unique('clientes')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                })->ignore($cliente->id)
            ],
            'telefono' => 'required|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'cif' => 'nullable|string|max:20',
            'direccion_juridica' => 'nullable|string|max:255',
        ]);

        try {
            // Convertir nombre y apellidos a Title Case
            $clienteData = $request->all();
            $clienteData['nombre'] = $this->toTitleCase($clienteData['nombre']);
            $clienteData['apellidos'] = $this->toTitleCase($clienteData['apellidos']);
            
            // Convertir email a minúsculas y DNI a mayúsculas
            if (isset($clienteData['email'])) {
                $clienteData['email'] = mb_strtolower($clienteData['email'], 'UTF-8');
            }
            
            if (isset($clienteData['dni']) && $clienteData['dni']) {
                $clienteData['dni'] = mb_strtoupper($clienteData['dni'], 'UTF-8');
            }
            
            $cliente->update($clienteData);
            
            Log::info('Cliente actualizado correctamente', [
                'cliente_id' => $cliente->id, 
                'user_id' => Auth::id(),
                'nombre' => $cliente->nombre,
                'apellidos' => $cliente->apellidos,
                'dni' => $cliente->dni
            ]);
            
            return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar cliente: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString(),
                'cliente_id' => $cliente->id,
                'user_id' => Auth::id(),
                'request_data' => $request->except(['_token'])
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al actualizar el cliente: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        // Verificar que el cliente pertenece al usuario autenticado
        if ($cliente->user_id !== Auth::id()) {
            Log::warning('Intento de acceso no autorizado a cliente', [
                'cliente_id' => $cliente->id,
                'cliente_user_id' => $cliente->user_id,
                'user_id' => Auth::id()
            ]);
            abort(403, 'No tienes permiso para eliminar este cliente.');
        }

        try {
            $clienteId = $cliente->id;
            $clienteNombre = $cliente->nombre . ' ' . $cliente->apellidos;
            
            $cliente->delete();
            
            Log::info('Cliente eliminado correctamente', [
                'cliente_id' => $clienteId, 
                'user_id' => Auth::id(),
                'nombre_completo' => $clienteNombre
            ]);
            
            return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar cliente: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString(),
                'cliente_id' => $cliente->id,
                'user_id' => Auth::id()
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al eliminar el cliente: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Convierte un texto a formato Title Case (primera letra de cada palabra en mayúscula)
     * con manejo especial para palabras con apóstrofes y preposiciones.
     */
    private function toTitleCase($string)
    {
        // Primero convertimos todo a minúsculas
        $string = mb_strtolower($string, 'UTF-8');
        
        // Dividimos el string en palabras
        $words = explode(' ', $string);
        
        // Lista de palabras que no deberían capitalizarse (preposiciones, artículos, etc.)
        $smallWords = ['de', 'del', 'la', 'las', 'el', 'los', 'y', 'e', 'o', 'u', 'a', 'en', 'con', 'por', 'para'];
        
        foreach ($words as $key => $word) {
            // La primera palabra siempre se capitaliza
            if ($key === 0) {
                $words[$key] = mb_strtoupper(mb_substr($word, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($word, 1, null, 'UTF-8');
                continue;
            }
            
            // Si la palabra está en la lista de palabras pequeñas, no la capitalizamos
            if (in_array($word, $smallWords)) {
                continue;
            }
            
            // Manejo especial para palabras con apóstrofe
            if (strpos($word, "'") !== false) {
                $parts = explode("'", $word);
                $parts[1] = mb_strtoupper(mb_substr($parts[1], 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($parts[1], 1, null, 'UTF-8');
                $words[$key] = $parts[0] . "'" . $parts[1];
                continue;
            }
            
            // Capitalizar la primera letra de la palabra
            $words[$key] = mb_strtoupper(mb_substr($word, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($word, 1, null, 'UTF-8');
        }
        
        // Unimos las palabras de nuevo
        return implode(' ', $words);
    }
}