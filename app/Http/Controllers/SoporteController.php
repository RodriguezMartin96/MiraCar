<?php

namespace App\Http\Controllers;

use App\Models\Soporte;
use App\Mail\SoporteMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SoporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Soporte::query();
        
        // Si hay un término de búsqueda, filtramos los resultados
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('email', 'LIKE', "%{$search}%")
                  ->orWhere('asunto', 'LIKE', "%{$search}%")
                  ->orWhere('descripcion', 'LIKE', "%{$search}%");
            });
        }
        
        // Obtenemos todas las solicitudes
        $soportes = $query->orderBy('created_at', 'desc')->paginate(10);
        
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
            'descripcion' => 'required|string',
        ]);

        // Obtener el email del usuario autenticado o usar el valor del formulario
        $fromEmail = Auth::check() ? Auth::user()->email : $request->from_email;
        $toEmail = $request->to_email ?? 'adm.96.rrm@gmail.com';

        // Guardar la solicitud en la base de datos
        $solicitud = new Soporte();
        $solicitud->email = $fromEmail;
        $solicitud->asunto = $request->asunto;
        $solicitud->descripcion = $request->descripcion;
        $solicitud->estado = 'Pendiente';
        
        if (Auth::check()) {
            $solicitud->user_id = Auth::id();
        }
        
        $solicitud->save();

        // Enviar el correo electrónico
        try {
            $tallerName = null;
            if (Auth::check() && method_exists(Auth::user(), 'taller') && Auth::user()->taller) {
                $tallerName = Auth::user()->taller->nombre;
            }
            
            Mail::to($toEmail)
                ->send(new SoporteMail(
                    $fromEmail,
                    $request->asunto,
                    $request->descripcion,
                    $tallerName
                ));
            
            // Limpiar el formulario y mostrar mensaje de éxito
            return redirect()->route('soporte.create')
                ->with('success', 'Solicitud de soporte enviada correctamente. Nos pondremos en contacto contigo pronto.');
        } catch (\Exception $e) {
            // Registrar el error con más detalles
            Log::error('Error al enviar correo de soporte: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()
                ->with('error', 'No se pudo enviar el correo electrónico. La solicitud se ha guardado en el sistema.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Soporte $soporte)
    {
        return view('soporte.show', compact('soporte'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Soporte $soporte)
    {
        return view('soporte.edit', compact('soporte'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Soporte $soporte)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'asunto' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'estado' => 'required|string|in:Pendiente,En proceso,Resuelto,Cerrado',
        ]);

        $soporte->email = $request->email;
        $soporte->asunto = $request->asunto;
        $soporte->descripcion = $request->descripcion;
        $soporte->estado = $request->estado;
        
        if ($request->has('respuesta')) {
            $soporte->respuesta = $request->respuesta;
        }
        
        $soporte->save();

        return redirect()->route('soporte.index')
            ->with('success', 'Solicitud de soporte actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Soporte $soporte)
    {
        $soporte->delete();

        return redirect()->route('soporte.index')
            ->with('success', 'Solicitud de soporte eliminada correctamente.');
    }
}