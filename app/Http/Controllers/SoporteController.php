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
        $soportes = Soporte::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
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

        try {
            // Asociar la solicitud de soporte al usuario autenticado
            $soporte = new Soporte([
                'email' => Auth::user()->email,
                'asunto' => $request->asunto,
                'descripcion' => $request->descripcion,
                'estado' => 'Pendiente',
                'user_id' => Auth::id(),
            ]);
            $soporte->save();

            // Preparar datos para el correo
            $mailData = [
                'fromEmail' => Auth::user()->email,
                'tallerName' => Auth::user()->name,
                'asunto' => $request->asunto,
                'descripcion' => $request->descripcion,
                'toEmail' => 'adm.96.rrm@gmail.com'
            ];

            // Enviar correo electrónico
            try {
                // Enviar a la dirección principal y añadir BCC
                Mail::to('soporte@miracar.com')
                    ->bcc('adm.96.rrm@gmail.com')
                    ->send(new SoporteMail($mailData));
                    
                Log::info('Correo de soporte enviado correctamente', [
                    'to' => 'soporte@miracar.com',
                    'bcc' => 'adm.96.rrm@gmail.com',
                    'from' => Auth::user()->email
                ]);
            } catch (\Exception $e) {
                Log::error('Error al enviar correo de soporte: ' . $e->getMessage(), [
                    'exception' => get_class($e),
                    'trace' => $e->getTraceAsString()
                ]);
                
                // Método alternativo de envío de correo
                try {
                    $to = 'adm.96.rrm@gmail.com';
                    $subject = 'Soporte MiraCar: ' . $request->asunto;
                    
                    $headers = [
                        'MIME-Version: 1.0',
                        'Content-type: text/html; charset=utf-8',
                        'From: Soporte MiraCar <soporte@miracar.com>',
                        'Reply-To: ' . Auth::user()->email,
                        'X-Mailer: PHP/' . phpversion()
                    ];
                    
                    $message = view('emails.soporte', [
                        'fromEmail' => Auth::user()->email,
                        'tallerName' => Auth::user()->name,
                        'asunto' => $request->asunto,
                        'descripcion' => $request->descripcion,
                        'toEmail' => $to
                    ])->render();
                    
                    mail($to, $subject, $message, implode("\r\n", $headers));
                    
                    Log::info('Correo de soporte enviado correctamente usando mail()', [
                        'to' => $to,
                        'from' => Auth::user()->email
                    ]);
                } catch (\Exception $e2) {
                    Log::error('Error al enviar correo de soporte usando mail(): ' . $e2->getMessage(), [
                        'exception' => get_class($e2),
                        'trace' => $e2->getTraceAsString()
                    ]);
                }
            }

            Log::info('Solicitud de soporte creada correctamente', ['soporte_id' => $soporte->id, 'user_id' => Auth::id()]);
            return view('soporte.confirmacion');
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
            'descripcion' => 'required|string',
            'estado' => 'required|string|in:Pendiente,En proceso,Resuelto,Cerrado',
            'respuesta' => 'nullable|string',
        ]);

        try {
            $soporte->asunto = $request->asunto;
            $soporte->descripcion = $request->descripcion;
            $soporte->estado = $request->estado;
            $soporte->respuesta = $request->respuesta;
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

    /**
     * Método para probar el envío de correos (solo para desarrollo)
     */
    public function testEmail()
    {
        try {
            $mailData = [
                'fromEmail' => Auth::user()->email,
                'tallerName' => Auth::user()->name,
                'asunto' => 'Correo de prueba',
                'descripcion' => 'Este es un correo de prueba para verificar la configuración de correo.',
                'toEmail' => 'adm.96.rrm@gmail.com'
            ];

            Mail::to('soporte@miracar.com')
                ->bcc('adm.96.rrm@gmail.com')
                ->send(new SoporteMail($mailData));

            return response()->json([
                'success' => true,
                'message' => 'Correo enviado correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar correo: ' . $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}