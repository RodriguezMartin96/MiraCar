<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'company_nif' => ['nullable', 'string', 'max:20'],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        $user = $request->user();
        $user->name = $validatedData['name'];
        
        if ($user->role === 'taller') {
            $user->company_name = $validatedData['company_name'] ?? null;
            $user->company_nif = $validatedData['company_nif'] ?? null;
        }
        
        $user->phone = $validatedData['phone'] ?? null;
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's logo.
     */
    public function updateLogo(Request $request): RedirectResponse
    {
        $request->validate([
            'logo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        try {
            $user = $request->user();
            
            // Información de depuración
            Log::info('Iniciando actualización de logo', [
                'user_id' => $user->id,
                'user_role' => $user->role,
                'old_logo' => $user->logo
            ]);

            // Verificar si el archivo se subió correctamente
            if (!$request->hasFile('logo') || !$request->file('logo')->isValid()) {
                Log::error('Archivo de logo no válido o no subido');
                return back()->withErrors(['logo' => 'El archivo no es válido o no se pudo subir.']);
            }

            // Información sobre el archivo subido
            $logoFile = $request->file('logo');
            Log::info('Archivo de logo recibido', [
                'original_name' => $logoFile->getClientOriginalName(),
                'mime_type' => $logoFile->getMimeType(),
                'size' => $logoFile->getSize()
            ]);

            // Eliminar el logo anterior si existe
            if ($user->logo && File::exists(public_path('storage/' . $user->logo))) {
                File::delete(public_path('storage/' . $user->logo));
                Log::info('Logo anterior eliminado: ' . $user->logo);
            } else if ($user->logo) {
                Log::warning('Logo anterior no encontrado en el almacenamiento: ' . $user->logo);
            }

            // Asegurarse de que el directorio existe
            $logosDir = public_path('storage/logos');
            if (!File::exists($logosDir)) {
                File::makeDirectory($logosDir, 0755, true);
            }

            // Guardar el nuevo logo con un nombre único basado en timestamp
            $timestamp = time();
            $extension = $logoFile->getClientOriginalExtension();
            $fileName = 'logo_' . $user->id . '_' . $timestamp . '.' . $extension;
            
            // Guardar directamente en public/storage/logos
            $logoFile->move($logosDir, $fileName);
            $logoPath = 'logos/' . $fileName;
            
            Log::info('Nuevo logo guardado en: ' . $logoPath);

            // Actualizar el usuario
            $user->logo = $logoPath;
            $user->save();

            Log::info('Logo actualizado en la base de datos');

            // Verificar que el archivo existe después de guardarlo
            if (File::exists(public_path('storage/' . $logoPath))) {
                Log::info('Verificación: el archivo existe en el almacenamiento');
            } else {
                Log::error('Verificación fallida: el archivo no existe en el almacenamiento');
            }

            return Redirect::route('profile.edit')->with('status', 'logo-updated');
        } catch (\Exception $e) {
            Log::error('Error al actualizar el logo: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors([
                'logo' => 'Ha ocurrido un error al actualizar el logo: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Eliminar el logo si existe
        if ($user->logo && File::exists(public_path('storage/' . $user->logo))) {
            File::delete(public_path('storage/' . $user->logo));
            Log::info('Logo eliminado al borrar usuario: ' . $user->logo);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}