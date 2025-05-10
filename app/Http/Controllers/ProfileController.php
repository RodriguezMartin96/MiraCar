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
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        if ($user->role === 'taller') {
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'company_name' => ['required', 'string', 'max:255'],
                'company_nif' => [
                    'required', 
                    'string', 
                    'max:20',
                    'regex:/^[A-Z0-9]{9}$/',
                    'unique:users,company_nif,' . $user->id
                ],
                'phone' => [
                    'required', 
                    'string', 
                    'regex:/^[0-9]{9}$/'
                ],
            ], [
                'name.required' => 'El nombre es obligatorio.',
                'company_name.required' => 'El nombre de la empresa es obligatorio.',
                'company_nif.required' => 'El NIF/CIF es obligatorio.',
                'company_nif.regex' => 'El formato del NIF/CIF no es válido.',
                'phone.required' => 'El teléfono es obligatorio.',
                'phone.regex' => 'El teléfono debe tener 9 dígitos.',
            ]);
            
            $name = Str::title($validatedData['name']);
            $companyName = Str::title($validatedData['company_name']);
            $companyNif = strtoupper($validatedData['company_nif']);
            
            $user->name = $name;
            $user->company_name = $companyName;
            $user->company_nif = $companyNif;
        } else {
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'lastname' => ['nullable', 'string', 'max:255'],
                'dni' => ['nullable', 'string', 'max:20', 'unique:users,dni,' . $user->id],
                'phone' => ['nullable', 'string', 'max:20'],
            ]);
            
            $name = Str::title($validatedData['name']);
            $lastname = isset($validatedData['lastname']) ? Str::title($validatedData['lastname']) : null;
            $dni = isset($validatedData['dni']) ? strtoupper($validatedData['dni']) : null;
            
            $user->name = $name;
            $user->lastname = $lastname;
            $user->dni = $dni;
        }
        
        $user->phone = $validatedData['phone'] ?? null;
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updateLogo(Request $request): RedirectResponse
    {
        $request->validate([
            'logo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        try {
            $user = $request->user();
            
            Log::info('Iniciando actualización de logo', [
                'user_id' => $user->id,
                'user_role' => $user->role,
                'old_logo' => $user->logo
            ]);

            if (!$request->hasFile('logo') || !$request->file('logo')->isValid()) {
                Log::error('Archivo de logo no válido o no subido');
                return back()->withErrors(['logo' => 'El archivo no es válido o no se pudo subir.']);
            }

            $logoFile = $request->file('logo');
            Log::info('Archivo de logo recibido', [
                'original_name' => $logoFile->getClientOriginalName(),
                'mime_type' => $logoFile->getMimeType(),
                'size' => $logoFile->getSize()
            ]);

            if ($user->logo && File::exists(public_path('storage/' . $user->logo))) {
                File::delete(public_path('storage/' . $user->logo));
                Log::info('Logo anterior eliminado: ' . $user->logo);
            } else if ($user->logo) {
                Log::warning('Logo anterior no encontrado en el almacenamiento: ' . $user->logo);
            }

            $logosDir = public_path('storage/logos');
            if (!File::exists($logosDir)) {
                File::makeDirectory($logosDir, 0755, true);
            }

            $timestamp = time();
            $extension = $logoFile->getClientOriginalExtension();
            $fileName = 'logo_' . $user->id . '_' . $timestamp . '.' . $extension;
            
            $logoFile->move($logosDir, $fileName);
            $logoPath = 'logos/' . $fileName;
            
            Log::info('Nuevo logo guardado en: ' . $logoPath);

            $user->logo = $logoPath;
            $user->save();

            Log::info('Logo actualizado en la base de datos');

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

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required', 
                'confirmed', 
                'min:6',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@\-_+*\/#()\[\]{}])[A-Za-z\d@\-_+*\/#()\[\]{}]{6,}$/'
            ],
        ], [
            'current_password.required' => 'La contraseña actual es obligatoria.',
            'current_password.current_password' => 'La contraseña actual no es correcta.',
            'password.required' => 'La nueva contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.regex' => 'La contraseña debe contener al menos una mayúscula, una minúscula, un número y un carácter especial (@-_+*/#()[]{}).',
            'password.confirmed' => 'Las contraseñas no coinciden.'
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

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