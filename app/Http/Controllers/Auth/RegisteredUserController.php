<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request)
    {
        try {
            Log::info('Iniciando registro de usuario');
            
            // Validar según el tipo de usuario
            if ($request->user_type === 'user') {
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'lastname' => ['required', 'string', 'max:255'],
                    'dni' => ['required', 'string', 'max:20', 'unique:users'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'phone' => ['nullable', 'string', 'max:20'],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);

                $user = User::create([
                    'name' => $request->name,
                    'lastname' => $request->lastname,
                    'dni' => $request->dni,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'role' => 'user',
                    'password' => Hash::make($request->password),
                ]);

                // Si se subió un avatar, procesarlo aquí
                if ($request->hasFile('avatar')) {
                    // Procesar y guardar el avatar
                    // $avatarPath = $request->file('avatar')->store('avatars', 'public');
                    // $user->avatar = $avatarPath;
                    // $user->save();
                }
            } elseif ($request->user_type === 'taller') {
                $request->validate([
                    'company_name' => ['required', 'string', 'max:255'],
                    'company_nif' => ['required', 'string', 'max:20', 'unique:users,company_nif'],
                    'company_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                    'company_phone' => ['nullable', 'string', 'max:20'],
                    'company_password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);

                $user = User::create([
                    'name' => $request->company_name, // Usamos el nombre de la empresa como nombre
                    'email' => $request->company_email,
                    'phone' => $request->company_phone,
                    'company_name' => $request->company_name,
                    'company_nif' => $request->company_nif,
                    'role' => 'taller',
                    'password' => Hash::make($request->company_password),
                ]);

                // Si se subió un logo, procesarlo aquí
                if ($request->hasFile('logo')) {
                    // Procesar y guardar el logo
                    // $logoPath = $request->file('logo')->store('logos', 'public');
                    // $user->logo = $logoPath;
                    // $user->save();
                }
            } else {
                return back()->withErrors(['user_type' => 'Tipo de usuario no válido'])->withInput();
            }

            Log::info('Usuario registrado correctamente: ' . $user->id);

            event(new Registered($user));

            Auth::login($user);

            Log::info('Usuario autenticado correctamente', ['user_id' => $user->id]);

            return redirect(RouteServiceProvider::HOME);
        } catch (\Exception $e) {
            Log::error('Error en el registro de usuario: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors([
                'error' => 'Ha ocurrido un error al registrar el usuario. Por favor, inténtalo de nuevo.',
            ])->withInput();
        }
    }
}