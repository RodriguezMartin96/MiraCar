<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Editar Siniestro - MiraCar</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light" style="font-family: 'Instrument Sans', sans-serif;">
    <!-- Incluir la barra de navegación -->
    @include('layouts.navigation')

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title mb-4">Editar Siniestro</h2>
                        
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
                            
                            <div class="mb-3">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" class="form-control" id="numero" name="numero" value="{{ old('numero', $siniestro->numero) }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="cliente_id" class="form-label">DNI Cliente</label>
                                <select class="form-select" id="cliente_id" name="cliente_id" required>
                                    <option value="">Seleccionar cliente</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" {{ old('cliente_id', $siniestro->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->dni }} - {{ $cliente->nombre }} {{ $cliente->apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="vehiculo_id" class="form-label">Matrícula Vehículo</label>
                                <select class="form-select" id="vehiculo_id" name="vehiculo_id" required>
                                    <option value="">Seleccionar vehículo</option>
                                    @foreach($vehiculos as $vehiculo)
                                        <option value="{{ $vehiculo->id }}" {{ old('vehiculo_id', $siniestro->vehiculo_id) == $vehiculo->id ? 'selected' : '' }}>
                                            {{ $vehiculo->matricula }} - {{ $vehiculo->marca }} {{ $vehiculo->modelo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="fecha_entrada" class="form-label">Fecha Entrada</label>
                                <input type="date" class="form-control" id="fecha_entrada" name="fecha_entrada" value="{{ old('fecha_entrada', $siniestro->fecha_entrada->format('Y-m-d')) }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="fecha_salida" class="form-label">Fecha Salida</label>
                                <input type="date" class="form-control" id="fecha_salida" name="fecha_salida" value="{{ old('fecha_salida', $siniestro->fecha_salida ? $siniestro->fecha_salida->format('Y-m-d') : '') }}">
                            </div>
                            
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select" id="estado" name="estado">
                                    <option value="Pendiente" {{ old('estado', $siniestro->estado) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="En proceso" {{ old('estado', $siniestro->estado) == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                                    <option value="Finalizado" {{ old('estado', $siniestro->estado) == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $siniestro->descripcion)  id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $siniestro->descripcion) }}</textarea>
                            </div>
                            
                            <div class="text-center">
                                <a href="{{ route('siniestros.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
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