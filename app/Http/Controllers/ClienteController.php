<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $clientes = Cliente::where('user_id', Auth::id())
                ->where(function($query) use ($search) {
                    $query->where('nombre', 'LIKE', "%{$search}%")
                        ->orWhere('apellidos', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhere('telefono', 'LIKE', "%{$search}%")
                        ->orWhere('dni', 'LIKE', "%{$search}%");
                })
                ->paginate(10);
        } else {
            $clientes = Cliente::where('user_id', Auth::id())->paginate(10);
        }
        
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $documentRules = [];
        $documentMessages = [];
        
        switch ($request->document_type) {
            case 'dni':
                $documentRules = [
                    'dni' => [
                        'required',
                        'string',
                        'regex:/^[0-9]{8}[A-Za-z]$/',
                        Rule::unique('clientes')->where(function ($query) {
                            return $query->where('user_id', Auth::id());
                        })
                    ]
                ];
                $documentMessages = [
                    'dni.regex' => 'El formato del DNI no es válido (8 números seguidos de una letra).',
                ];
                break;
                
            case 'nie':
                $documentRules = [
                    'dni' => [
                        'required',
                        'string',
                        'regex:/^[XYZ][0-9]{7}[A-Za-z]$/',
                        Rule::unique('clientes')->where(function ($query) {
                            return $query->where('user_id', Auth::id());
                        })
                    ]
                ];
                $documentMessages = [
                    'dni.regex' => 'El formato del NIE no es válido (debe comenzar con X, Y o Z, seguido de 7 números y una letra).',
                ];
                break;
                
            default:
                $documentRules = [
                    'dni' => [
                        'required',
                        'string',
                        'min:5',
                        'max:20',
                        Rule::unique('clientes')->where(function ($query) {
                            return $query->where('user_id', Auth::id());
                        })
                    ]
                ];
                $documentMessages = [
                    'dni.min' => 'El documento debe tener al menos 5 caracteres.',
                ];
                break;
        }
        
        $phoneRules = [
            'telefono' => [
                'required',
                'string',
                'regex:/^(#?\d{6,})$/'
            ]
        ];
        $phoneMessages = [
            'telefono.regex' => 'El teléfono debe tener al menos 6 números o comenzar con # seguido de al menos 6 números.',
        ];
        
        $validationRules = array_merge([
            'nombre' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'
            ],
            'apellidos' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('clientes')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                })
            ],
            'direccion' => [
                'required',
                'string',
                'max:255'
            ],
            'cif' => [
                'nullable',
                'string',
                'max:20'
            ],
            'direccion_juridica' => [
                'nullable',
                'string',
                'max:255'
            ],
        ], $documentRules, $phoneRules);
        
        $validationMessages = array_merge([
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 2 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'apellidos.min' => 'Los apellidos deben tener al menos 2 caracteres.',
            'apellidos.regex' => 'Los apellidos solo pueden contener letras y espacios.',
            'dni.required' => 'El documento de identidad es obligatorio.',
            'dni.unique' => 'Este documento ya está registrado en tu taller.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El formato del email no es válido.',
            'email.unique' => 'Este email ya está registrado en tu taller.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'direccion.required' => 'La dirección es obligatoria.',
        ], $documentMessages, $phoneMessages);
        
        $request->validate($validationRules, $validationMessages);

        try {
            $clienteData = $request->all();
            $clienteData['nombre'] = $this->toTitleCase($clienteData['nombre']);
            $clienteData['apellidos'] = $this->toTitleCase($clienteData['apellidos']);
            
            if (isset($clienteData['email'])) {
                $clienteData['email'] = mb_strtolower($clienteData['email'], 'UTF-8');
            }
            
            if (isset($clienteData['dni']) && $clienteData['dni']) {
                $clienteData['dni'] = mb_strtoupper($clienteData['dni'], 'UTF-8');
            }
            
            unset($clienteData['document_type']);
            
            $cliente = new Cliente($clienteData);
            $cliente->user_id = Auth::id();
            $cliente->save();

            Log::info('Cliente creado correctamente', [
                'cliente_id' => $cliente->id, 
                'user_id' => Auth::id(),
                'nombre' => $cliente->nombre,
                'apellidos' => $cliente->apellidos,
                'dni' => $cliente->dni
            ]);
            
            return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al crear cliente: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString(),
                'user_id' => Auth::id(),
                'request_data' => $request->except(['_token'])
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al crear el cliente: ' . $e->getMessage()])->withInput();
        }
    }

    public function show(Cliente $cliente)
    {
        if ($cliente->user_id !== Auth::id()) {
            Log::warning('Intento de acceso no autorizado a cliente', [
                'cliente_id' => $cliente->id,
                'cliente_user_id' => $cliente->user_id,
                'user_id' => Auth::id()
            ]);
            abort(403, 'No tienes permiso para ver este cliente.');
        }

        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        if ($cliente->user_id !== Auth::id()) {
            Log::warning('Intento de acceso no autorizado a cliente', [
                'cliente_id' => $cliente->id,
                'cliente_user_id' => $cliente->user_id,
                'user_id' => Auth::id()
            ]);
            abort(403, 'No tienes permiso para editar este cliente.');
        }

        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        if ($cliente->user_id !== Auth::id()) {
            Log::warning('Intento de acceso no autorizado a cliente', [
                'cliente_id' => $cliente->id,
                'cliente_user_id' => $cliente->user_id,
                'user_id' => Auth::id()
            ]);
            abort(403, 'No tienes permiso para actualizar este cliente.');
        }

        $documentRules = [];
        $documentMessages = [];
        
        switch ($request->document_type) {
            case 'dni':
                $documentRules = [
                    'dni' => [
                        'required',
                        'string',
                        'regex:/^[0-9]{8}[A-Za-z]$/',
                        Rule::unique('clientes')->where(function ($query) {
                            return $query->where('user_id', Auth::id());
                        })->ignore($cliente->id)
                    ]
                ];
                $documentMessages = [
                    'dni.regex' => 'El formato del DNI no es válido (8 números seguidos de una letra).',
                ];
                break;
                
            case 'nie':
                $documentRules = [
                    'dni' => [
                        'required',
                        'string',
                        'regex:/^[XYZ][0-9]{7}[A-Za-z]$/',
                        Rule::unique('clientes')->where(function ($query) {
                            return $query->where('user_id', Auth::id());
                        })->ignore($cliente->id)
                    ]
                ];
                $documentMessages = [
                    'dni.regex' => 'El formato del NIE no es válido (debe comenzar con X, Y o Z, seguido de 7 números y una letra).',
                ];
                break;
                
            default:
                $documentRules = [
                    'dni' => [
                        'required',
                        'string',
                        'min:5',
                        'max:20',
                        Rule::unique('clientes')->where(function ($query) {
                            return $query->where('user_id', Auth::id());
                        })->ignore($cliente->id)
                    ]
                ];
                $documentMessages = [
                    'dni.min' => 'El documento debe tener al menos 5 caracteres.',
                ];
                break;
        }
        
        $phoneRules = [
            'telefono' => [
                'required',
                'string',
                'regex:/^(#?\d{6,})$/'
            ]
        ];
        $phoneMessages = [
            'telefono.regex' => 'El teléfono debe tener al menos 6 números o comenzar con # seguido de al menos 6 números.',
        ];
        
        $validationRules = array_merge([
            'nombre' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'
            ],
            'apellidos' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('clientes')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                })->ignore($cliente->id)
            ],
            'direccion' => [
                'required',
                'string',
                'max:255'
            ],
            'cif' => [
                'nullable',
                'string',
                'max:20'
            ],
            'direccion_juridica' => [
                'nullable',
                'string',
                'max:255'
            ],
        ], $documentRules, $phoneRules);
        
        $validationMessages = array_merge([
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 2 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'apellidos.min' => 'Los apellidos deben tener al menos 2 caracteres.',
            'apellidos.regex' => 'Los apellidos solo pueden contener letras y espacios.',
            'dni.required' => 'El documento de identidad es obligatorio.',
            'dni.unique' => 'Este documento ya está registrado en tu taller.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El formato del email no es válido.',
            'email.unique' => 'Este email ya está registrado en tu taller.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'direccion.required' => 'La dirección es obligatoria.',
        ], $documentMessages, $phoneMessages);
        
        $request->validate($validationRules, $validationMessages);

        try {
            $clienteData = $request->all();
            $clienteData['nombre'] = $this->toTitleCase($clienteData['nombre']);
            $clienteData['apellidos'] = $this->toTitleCase($clienteData['apellidos']);
            
            if (isset($clienteData['email'])) {
                $clienteData['email'] = mb_strtolower($clienteData['email'], 'UTF-8');
            }
            
            if (isset($clienteData['dni']) && $clienteData['dni']) {
                $clienteData['dni'] = mb_strtoupper($clienteData['dni'], 'UTF-8');
            }
            
            unset($clienteData['document_type']);
            
            $cliente->update($clienteData);
            
            Log::info('Cliente actualizado correctamente', [
                'cliente_id' => $cliente->id, 
                'user_id' => Auth::id(),
                'nombre' => $cliente->nombre,
                'apellidos' => $cliente->apellidos,
                'dni' => $cliente->dni
            ]);
            
            return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar cliente: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString(),
                'cliente_id' => $cliente->id,
                'user_id' => Auth::id(),
                'request_data' => $request->except(['_token'])
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al actualizar el cliente: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Cliente $cliente)
    {
        if ($cliente->user_id !== Auth::id()) {
            Log::warning('Intento de acceso no autorizado a cliente', [
                'cliente_id' => $cliente->id,
                'cliente_user_id' => $cliente->user_id,
                'user_id' => Auth::id()
            ]);
            abort(403, 'No tienes permiso para eliminar este cliente.');
        }

        try {
            $clienteId = $cliente->id;
            $clienteNombre = $cliente->nombre . ' ' . $cliente->apellidos;
            
            $cliente->delete();
            
            Log::info('Cliente eliminado correctamente', [
                'cliente_id' => $clienteId, 
                'user_id' => Auth::id(),
                'nombre_completo' => $clienteNombre
            ]);
            
            return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar cliente: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString(),
                'cliente_id' => $cliente->id,
                'user_id' => Auth::id()
            ]);
            
            return back()->withErrors(['error' => 'Ha ocurrido un error al eliminar el cliente: ' . $e->getMessage()]);
        }
    }

    private function toTitleCase($string)
    {
        $string = mb_strtolower($string, 'UTF-8');
        $words = explode(' ', $string);
        $smallWords = ['de', 'del', 'la', 'las', 'el', 'los', 'y', 'e', 'o', 'u', 'a', 'en', 'con', 'por', 'para'];
        
        foreach ($words as $key => $word) {
            if ($key === 0) {
                $words[$key] = mb_strtoupper(mb_substr($word, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($word, 1, null, 'UTF-8');
                continue;
            }
            
            if (in_array($word, $smallWords)) {
                continue;
            }
            
            if (strpos($word, "'") !== false) {
                $parts = explode("'", $word);
                $parts[1] = mb_strtoupper(mb_substr($parts[1], 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($parts[1], 1, null, 'UTF-8');
                $words[$key] = $parts[0] . "'" . $parts[1];
                continue;
            }
            
            $words[$key] = mb_strtoupper(mb_substr($word, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($word, 1, null, 'UTF-8');
        }
        
        return implode(' ', $words);
    }
}