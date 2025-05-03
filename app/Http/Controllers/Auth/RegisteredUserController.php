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
use Illuminate\Support\Str;

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
            Log::info('Iniciando registro de usuario', ['tipo' => $request->user_type]);
            
            // Validar según el tipo de usuario
            if ($request->user_type === 'user') {
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'lastname' => ['required', 'string', 'max:255'],
                    'dni' => ['required', 'string', 'max:20', 'unique:users'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'phone' => ['nullable', 'string', 'max:20'],
                    'password' => ['required', 'confirmed', 'min:6'],
                    'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
                ], [
                    'name.required' => 'El nombre es obligatorio.',
                    'lastname.required' => 'El apellido es obligatorio.',
                    'dni.required' => 'El DNI es obligatorio.',
                    'dni.unique' => 'Este DNI ya está registrado.',
                    'email.required' => 'El email es obligatorio.',
                    'email.email' => 'El formato del email no es válido.',
                    'email.unique' => 'Este email ya está registrado.',
                    'password.required' => 'La contraseña es obligatoria.',
                    'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
                    'password.confirmed' => 'Las contraseñas no coinciden.'
                ]);

                // Convertir nombre y apellidos a Title Case y DNI a mayúsculas
                $name = Str::title($request->name);
                $lastname = Str::title($request->lastname);
                $dni = strtoupper($request->dni);

                Log::info('Creando usuario regular', [
                    'name' => $name,
                    'email' => $request->email
                ]);

                try {
                    $userData = [
                        'name' => $name,
                        'lastname' => $lastname,
                        'dni' => $dni,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'role' => 'user',
                        'password' => Hash::make($request->password),
                    ];
                    
                    Log::info('Datos de usuario a crear', $userData);
                    
                    $user = User::create($userData);
                    
                    Log::info('Usuario creado correctamente', ['user_id' => $user->id]);
                } catch (\Exception $e) {
                    Log::error('Error al crear usuario en la base de datos', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    throw $e;
                }

                // Si se subió un avatar, procesarlo
                if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
                    $avatarPath = $request->file('avatar')->store('avatars', 'public');
                    $user->avatar = $avatarPath;
                    $user->save();
                    
                    Log::info('Avatar guardado: ' . $avatarPath);
                }
            } elseif ($request->user_type === 'taller') {
                $request->validate([
                    'company_name' => ['required', 'string', 'max:255'],
                    'company_nif' => [
                        'required', 
                        'string', 
                        'max:20', 
                        'unique:users,company_nif',
                        'regex:/^[A-Z0-9]{9}$/' // Formato NIF/CIF español (simplificado)
                    ],
                    'company_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                    'company_phone' => [
                        'required', 
                        'string', 
                        'regex:/^[0-9]{9}$/' // Formato teléfono español (9 dígitos)
                    ],
                    'company_password' => [
                        'required', 
                        'confirmed', 
                        'min:6',
                        'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@\-_+*\/#()\[\]{}])[A-Za-z\d@\-_+*\/#()\[\]{}]{6,}$/'
                    ],
                    'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
                ], [
                    'company_name.required' => 'El nombre de la empresa es obligatorio.',
                    'company_nif.required' => 'El NIF/CIF es obligatorio.',
                    'company_nif.regex' => 'El formato del NIF/CIF no es válido.',
                    'company_email.required' => 'El email es obligatorio.',
                    'company_email.email' => 'El formato del email no es válido.',
                    'company_phone.required' => 'El teléfono es obligatorio.',
                    'company_phone.regex' => 'El teléfono debe tener 9 dígitos.',
                    'company_password.required' => 'La contraseña es obligatoria.',
                    'company_password.min' => 'La contraseña debe tener al menos 6 caracteres.',
                    'company_password.regex' => 'La contraseña debe contener al menos una mayúscula, una minúscula, un número y un carácter especial (@-_+*/#()[]{}).',
                    'company_password.confirmed' => 'Las contraseñas no coinciden.'
                ]);

                // Convertir nombre de empresa a Title Case y NIF a mayúsculas
                $companyName = Str::title($request->company_name);
                $companyNif = strtoupper($request->company_nif);

                $user = User::create([
                    'name' => $companyName, // Usamos el nombre de la empresa como nombre
                    'email' => $request->company_email,
                    'phone' => $request->company_phone,
                    'company_name' => $companyName,
                    'company_nif' => $companyNif,
                    'role' => 'taller',
                    'password' => Hash::make($request->company_password),
                ]);

                // Si se subió un logo, procesarlo
                if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                    $logoPath = $request->file('logo')->store('logos', 'public');
                    $user->logo = $logoPath;
                    $user->save();
                    
                    Log::info('Logo guardado: ' . $logoPath);
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
                'error' => 'Ha ocurrido un error al registrar el usuario: ' . $e->getMessage(),
            ])->withInput();
        }
    }
}