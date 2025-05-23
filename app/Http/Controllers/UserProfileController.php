<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        try {
            $user = Auth::user();
            
            Log::info('Acceso a perfil de usuario', [
                'user_id' => $user->id,
                'role' => $user->role
            ]);
            
            return view('user.profile', [
                'user' => $user
            ]);
        } catch (\Exception $e) {
            Log::error('Error al mostrar perfil: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->view('user.error', [
                'message' => 'Ha ocurrido un error al cargar tu perfil. Por favor, inténtalo de nuevo más tarde.'
            ], 500);
        }
    }

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
            
            if ($user->role === 'taller') {
                $validationRules['company_name'] = ['nullable', 'string', 'max:255'];
                $validationRules['company_nif'] = ['nullable', 'string', 'max:20'];
            }
            
            $validatedData = $request->validate($validationRules);

            $user->name = Str::title($validatedData['name']);
            
            if (isset($validatedData['lastname'])) {
                $user->lastname = Str::title($validatedData['lastname']);
            }
            
            if (isset($validatedData['dni'])) {
                $user->dni = strtoupper($validatedData['dni']);
            }
            
            if ($user->role === 'taller') {
                if (isset($validatedData['company_name'])) {
                    $user->company_name = Str::title($validatedData['company_name']);
                }
                
                if (isset($validatedData['company_nif'])) {
                    $user->company_nif = strtoupper($validatedData['company_nif']);
                }
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
    
    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        try {
            $user = Auth::user();
            $imageFile = $request->file('logo');
            
            $isAvatar = $user->role === 'user';
            $imageType = $isAvatar ? 'avatar' : 'logo';
            $directory = $isAvatar ? 'avatars' : 'logos';
            $oldImage = $isAvatar ? $user->avatar : $user->logo;
            
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }
            
            $filename = $imageType . '_' . $user->id . '_' . time() . '.' . $imageFile->getClientOriginalExtension();
            $path = $directory . '/' . $filename;
            
            Storage::disk('public')->put($path, file_get_contents($imageFile));
            
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