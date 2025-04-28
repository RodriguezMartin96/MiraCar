<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    /**
     * Constructor para asegurar que el usuario esté autenticado
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Mostrar el perfil del usuario.
     */
    public function show()
    {
        try {
            $user = Auth::user();
            
            // Registrar que se está accediendo al perfil
            Log::info('Acceso a perfil de usuario', [
                'user_id' => $user->id,
                'role' => $user->role
            ]);
            
            return view('user.profile', [
                'user' => $user
            ]);
        } catch (\Exception $e) {
            // Registrar el error
            Log::error('Error al mostrar perfil: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            // Mostrar un mensaje de error simple
            return response()->view('user.error', [
                'message' => 'Ha ocurrido un error al cargar tu perfil. Por favor, inténtalo de nuevo más tarde.'
            ], 500);
        }
    }

    /**
     * Actualizar la información del perfil.
     */
    public function update(Request $request)
    {
        try {
            $user = Auth::user();
            
            $validationRules = [
                'name' => ['required', 'string', 'max:255'],
                'lastname' => ['nullable', 'string', 'max:255'],
                'dni' => ['nullable', 'string', 'max:20'],
                'phone' => ['nullable', 'string', 'max:20'],
            ];
            
            // Añadir reglas específicas para talleres
            if ($user->role === 'taller') {
                $validationRules['company_name'] = ['nullable', 'string', 'max:255'];
                $validationRules['company_nif'] = ['nullable', 'string', 'max:20'];
            }
            
            $validatedData = $request->validate($validationRules);

            $user->name = $validatedData['name'];
            $user->lastname = $validatedData['lastname'] ?? $user->lastname;
            $user->dni = $validatedData['dni'] ?? $user->dni;
            
            if ($user->role === 'taller') {
                $user->company_name = $validatedData['company_name'] ?? null;
                $user->company_nif = $validatedData['company_nif'] ?? null;
            }
            
            $user->phone = $validatedData['phone'] ?? null;
            $user->save();

            Log::info('Perfil de usuario actualizado', [
                'user_id' => $user->id
            ]);

            return redirect()->route('user.profile')->with('status', 'profile-updated');
        } catch (\Exception $e) {
            Log::error('Error al actualizar perfil: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['general' => 'Error al actualizar el perfil: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Actualizar el logo o avatar del usuario.
     */
    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        try {
            $user = Auth::user();
            $imageFile = $request->file('logo');
            
            // Determinar el tipo de imagen y directorio según el rol
            $isAvatar = $user->role === 'user';
            $imageType = $isAvatar ? 'avatar' : 'logo';
            $directory = $isAvatar ? 'avatars' : 'logos';
            $oldImage = $isAvatar ? $user->avatar : $user->logo;
            
            // Eliminar imagen anterior si existe
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }
            
            // Procesar y guardar la imagen con un tamaño fijo
            $filename = $imageType . '_' . $user->id . '_' . time() . '.' . $imageFile->getClientOriginalExtension();
            $path = $directory . '/' . $filename;
            
            // Guardar la imagen original
            Storage::disk('public')->put($path, file_get_contents($imageFile));
            
            // Actualizar usuario
            if ($isAvatar) {
                $user->avatar = $path;
                $statusMessage = 'avatar-updated';
            } else {
                $user->logo = $path;
                $statusMessage = 'logo-updated';
            }
            
            $user->save();
            
            Log::info('Imagen de usuario actualizada', [
                'user_id' => $user->id,
                'image_type' => $imageType
            ]);
            
            return redirect()->route('user.profile')->with('status', $statusMessage);
        } catch (\Exception $e) {
            Log::error('Error al actualizar imagen: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['logo' => 'Error al actualizar la imagen: ' . $e->getMessage()]);
        }
    }
}
