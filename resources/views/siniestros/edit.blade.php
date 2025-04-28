<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Editar Siniestro - {{ config('app.name', 'MiraCar') }}</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('galeria/logo.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('galeria/logo.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('galeria/logo.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('galeria/logo.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #235390;
            --secondary-color: #4f8cff;
            --light-color: #e3ecff;
            --success-color: #c8e6c9;
            --danger-color: #ffcdd2;
            --process-color: #ffe0b2;
        }
        
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #f8fafc;
        }
        
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        
        .card-title {
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .form-label {
            font-weight: 500;
            color: #555;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(79, 140, 255, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.5rem 2rem;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            padding: 0.5rem 2rem;
            font-weight: 500;
        }
        
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c2c7;
        }
        
        .numero-siniestro {
            background-color: var(--light-color);
            border-left: 4px solid var(--primary-color);
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.25rem;
            text-align: center;
        }
        
        .numero-badge {
            background-color: {{ $siniestro->getEstadoColor() }};
            color: white;
            font-size: 1.1rem;
            padding: 0.3rem 0.8rem;
            border-radius: 0.25rem;
        }
    </style>
</head>
<body>
    <!-- Incluir la barra de navegación -->
    @include('layouts.navigation')

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body p-4">
                        <h2 class="card-title mb-4">Editar Siniestro</h2>
                        
                        <div class="numero-siniestro d-flex align-items-center justify-content-between">
                            <div>
                                <strong>Número de Siniestro:</strong>
                            </div>
                            <div class="numero-badge">
                                {{ $siniestro->numero }}
                            </div>
                        </div>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form action="{{ route('siniestros.update', $siniestro) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="cliente_id" class="form-label">Cliente</label>
                                    <select class="form-select" id="cliente_id" name="cliente_id" required>
                                        <option value="">Seleccionar cliente</option>
                                        @foreach($clientes as $cliente)
                                            <option value="{{ $cliente->id }}" {{ old('cliente_id', $siniestro->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                                {{ $cliente->dni }} - {{ $cliente->nombre }} {{ $cliente->apellidos }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="vehiculo_id" class="form-label">Vehículo</label>
                                    <select class="form-select" id="vehiculo_id" name="vehiculo_id" required>
                                        <option value="">Seleccionar vehículo</option>
                                        @foreach($vehiculos as $vehiculo)
                                            <option value="{{ $vehiculo->id }}" {{ old('vehiculo_id', $siniestro->vehiculo_id) == $vehiculo->id ? 'selected'$vehiculo->id}}" {{ old('vehiculo_id', $siniestro->vehiculo_id) == $vehiculo->id ? 'selected' : '' }}>
                                                {{ $vehiculo->matricula }} - {{ $vehiculo->marca }} {{ $vehiculo->modelo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="fecha_entrada" class="form-label">Fecha Entrada</label>
                                    <input type="date" class="form-control" id="fecha_entrada" name="fecha_entrada" value="{{ old('fecha_entrada', $siniestro->fecha_entrada->format('Y-m-d')) }}" required>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="fecha_salida" class="form-label">Fecha Salida</label>
                                    <input type="date" class="form-control" id="fecha_salida" name="fecha_salida" value="{{ old('fecha_salida', $siniestro->fecha_salida ? $siniestro->fecha_salida->format('Y-m-d') : '') }}">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select" id="estado" name="estado">
                                    <option value="Pendiente" {{ old('estado', $siniestro->estado) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="En proceso" {{ old('estado', $siniestro->estado) == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                                    <option value="Finalizado" {{ old('estado', $siniestro->estado) == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $siniestro->descripcion) }}</textarea>
                            </div>
                            
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('siniestros.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Actualizar Siniestro</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>