<?php

namespace App\Http\Controllers;

use App\Models\Soporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SoporteMail;

class SoporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Solo mostrar solicitudes de soporte del usuario autenticado
        $soportes = Soporte::where('user_id', Auth::id())->paginate(10);
        return view('soporte.index', compact('soportes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('soporte.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'asunto' => 'required|string|max:255',
            'mensaje' => 'required|string',
        ]);

        try {
            // Asociar la solicitud de soporte al usuario autenticado
            $soporte = new Soporte([
                'asunto' => $request->asunto,
                'mensaje' => $request->mensaje,
                'email_from' => Auth::user()->email,
                'email_to' => 'soporte@miracar.com',
                'estado' => 'pendiente',
                'user_id' => Auth::id(),
            ]);
            $soporte->save();

            // Enviar correo electrónico
            Mail::to('soporte@miracar.com')->send(new SoporteMail($soporte));

            Log::info('Solicitud de soporte creada correctamente', ['soporte_id' => $soporte->id, 'user_id' => Auth::id()]);
            return redirect()->route('soporte.create')->with('success', 'Solicitud de soporte enviada correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al crear solicitud de soporte: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al enviar la solicitud de soporte.'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Soporte $soporte)
    {
        // Verificar que la solicitud de soporte pertenece al usuario autenticado
        if ($soporte->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver esta solicitud de soporte.');
        }

        return view('soporte.show', compact('soporte'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Soporte $soporte)
    {
        // Verificar que la solicitud de soporte pertenece al usuario autenticado
        if ($soporte->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar esta solicitud de soporte.');
        }

        return view('soporte.edit', compact('soporte'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Soporte $soporte)
    {
        // Verificar que la solicitud de soporte pertenece al usuario autenticado
        if ($soporte->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para actualizar esta solicitud de soporte.');
        }

        $request->validate([
            'asunto' => 'required|string|max:255',
            'mensaje' => 'required|string',
        ]);

        try {
            $soporte->asunto = $request->asunto;
            $soporte->mensaje = $request->mensaje;
            $soporte->save();
            
            Log::info('Solicitud de soporte actualizada correctamente', ['soporte_id' => $soporte->id, 'user_id' => Auth::id()]);
            return redirect()->route('soporte.index')->with('success', 'Solicitud de soporte actualizada correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar solicitud de soporte: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al actualizar la solicitud de soporte.'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Soporte $soporte)
    {
        // Verificar que la solicitud de soporte pertenece al usuario autenticado
        if ($soporte->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar esta solicitud de soporte.');
        }

        try {
            $soporte->delete();
            
            Log::info('Solicitud de soporte eliminada correctamente', ['soporte_id' => $soporte->id, 'user_id' => Auth::id()]);
            return redirect()->route('soporte.index')->with('success', 'Solicitud de soporte eliminada correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar solicitud de soporte: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al eliminar la solicitud de soporte.']);
        }
    }
}
