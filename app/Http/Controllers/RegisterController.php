<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    
    public function store(Request $request)
    {
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
            Log::error('Error en el registro: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withInput()->with('error', 'Ha ocurrido un error al procesar el registro: ' . $e->getMessage());
        }
    }
    
    protected function registerTaller(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_nif' => 'required|string|max:20|unique:users,company_nif',
            'company_email' => 'required|string|email|max:255|unique:users,email',
            'company_phone' => 'required|string|max:20',
            'company_password' => ['required', 'string', 'min:8'],
            'company_password_confirmation' => ['required', 'same:company_password'],
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $companyName = Str::title($validated['company_name']);
        $companyNif = strtoupper($validated['company_nif']);
        
        $logoPath = null;
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            try {
                $logoFile = $request->file('logo');
                $timestamp = time();
                $extension = $logoFile->getClientOriginalExtension();
                $fileName = 'logo_' . $timestamp . '_' . uniqid() . '.' . $extension;
                
                $logosDir = public_path('storage/logos');
                if (!File::exists($logosDir)) {
                    File::makeDirectory($logosDir, 0755, true);
                }
                
                $logoFile->move($logosDir, $fileName);
                $logoPath = 'logos/' . $fileName;
                
                Log::info('Logo guardado correctamente en public/storage/logos', [
                    'path' => $logoPath,
                    'full_path' => $logosDir . '/' . $fileName
                ]);
                
                if (!File::exists($logosDir . '/' . $fileName)) {
                    Log::warning('El logo no se guardó correctamente', [
                        'path' => $logoPath
                    ]);
                    $logoPath = null;
                }
            } catch (\Exception $e) {
                Log::error('Error al subir el logo: ' . $e->getMessage(), [
                    'exception' => get_class($e),
                    'trace' => $e->getTraceAsString()
                ]);
                $logoPath = null;
            }
        }
        
        $user = User::create([
            'name' => $companyName,
            'email' => $validated['company_email'],
            'phone' => $validated['company_phone'],
            'password' => Hash::make($validated['company_password']),
            'role' => 'taller',
            'company_name' => $companyName,
            'company_nif' => $companyNif,
            'logo' => $logoPath,
        ]);
        
        Log::info('Taller registrado correctamente', [
            'user_id' => $user->id,
            'email' => $user->email,
            'has_logo' => !is_null($logoPath)
        ]);
        
        Auth::login($user);
        
        return redirect('/dashboard')->with('success', '¡Registro completado con éxito!');
    }
    
    protected function registerUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'dni' => 'required|string|max:20|unique:users,dni',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => ['required', 'same:password'],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $name = Str::title($validated['name']);
        $lastname = Str::title($validated['lastname']);
        $dni = strtoupper($validated['dni']);
        
        $avatarPath = null;
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            try {
                $avatarFile = $request->file('avatar');
                $timestamp = time();
                $extension = $avatarFile->getClientOriginalExtension();
                $fileName = 'avatar_' . $timestamp . '_' . uniqid() . '.' . $extension;
                
                $avatarsDir = public_path('storage/avatars');
                if (!File::exists($avatarsDir)) {
                    File::makeDirectory($avatarsDir, 0755, true);
                }
                
                $avatarFile->move($avatarsDir, $fileName);
                $avatarPath = 'avatars/' . $fileName;
                
                Log::info('Avatar guardado correctamente en public/storage/avatars', [
                    'path' => $avatarPath,
                    'full_path' => $avatarsDir . '/' . $fileName
                ]);
                
                if (!File::exists($avatarsDir . '/' . $fileName)) {
                    Log::warning('El avatar no se guardó correctamente', [
                        'path' => $avatarPath
                    ]);
                    $avatarPath = null;
                }
            } catch (\Exception $e) {
                Log::error('Error al subir el avatar: ' . $e->getMessage(), [
                    'exception' => get_class($e),
                    'trace' => $e->getTraceAsString()
                ]);
                $avatarPath = null;
            }
        }
        
        $user = User::create([
            'name' => $name,
            'lastname' => $lastname,
            'dni' => $dni,
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'avatar' => $avatarPath,
            'role' => 'user',
        ]);
        
        Log::info('Usuario registrado correctamente', [
            'user_id' => $user->id,
            'email' => $user->email,
            'has_avatar' => !is_null($avatarPath)
        ]);
        
        Auth::login($user);
        
        return redirect('/dashboard')->with('success', '¡Registro completado con éxito!');
    }
}