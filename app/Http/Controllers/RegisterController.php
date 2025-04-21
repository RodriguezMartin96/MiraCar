<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    
    public function store(Request $request)
    {
        // Validar tipo de usuario
        $request->validate([
            'user_type' => 'required|in:user,taller',
        ]);
        
        try {
            if ($request->user_type === 'taller') {
                return $this->registerTaller($request);
            } else {
                return $this->registerUser($request);
            }
        } catch (\Exception $e) {
            // Registrar el error para depuración
            Log::error('Error en el registro: ' . $e->getMessage());
            
            // Devolver al formulario con un mensaje de error
            return back()->withInput()->with('error', 'Ha ocurrido un error al procesar el registro: ' . $e->getMessage());
        }
    }
    
    protected function registerTaller(Request $request)
    {
        // Validar datos del taller
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_nif' => 'required|string|max:20|unique:users,company_nif',
            'company_email' => 'required|string|email|max:255|unique:users,email',
            'company_phone' => 'required|string|max:20',
            'company_password' => ['required', 'string', 'min:8'],
            'company_password_confirmation' => ['required', 'same:company_password'],
            'logo' => 'nullable|image|max:2048',
        ]);
        
        // Procesar y guardar el logo si se ha subido
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }
        
        // Crear usuario taller
        $user = User::create([
            'name' => $validated['company_name'],
            'email' => $validated['company_email'],
            'phone' => $validated['company_phone'],
            'password' => Hash::make($validated['company_password']),
            'role' => 'taller',
            'company_name' => $validated['company_name'],
            'company_nif' => $validated['company_nif'],
            'logo' => $logoPath,
        ]);
        
        // Iniciar sesión automáticamente
        Auth::login($user);
        
        // Redirigir a la página principal
        return redirect('/dashboard')->with('success', '¡Registro completado con éxito!');
    }
    
    protected function registerUser(Request $request)
    {
        // Validar datos del usuario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:users,dni',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => ['required', 'same:password'],
            'avatar' => 'nullable|image|max:2048',
        ]);
        
        // Procesar y guardar el avatar si se ha subido
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }
        
        // Crear usuario normal
        $user = User::create([
            'name' => $validated['name'],
            'lastname' => $validated['lastname'],
            'dni' => $validated['dni'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'avatar' => $avatarPath,
            'role' => 'user',
        ]);
        
        // Iniciar sesión automáticamente
        Auth::login($user);
        
        // Redirigir a la página principal
        return redirect('/dashboard')->with('success', '¡Registro completado con éxito!');
    }
}