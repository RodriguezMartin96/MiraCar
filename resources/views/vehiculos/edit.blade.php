<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Editar Vehículo - MiraCar</title>
    
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
                        <h2 class="card-title mb-4">Editar Vehículo</h2>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form action="{{ route('vehiculos.update', $vehiculo) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="marca" class="form-label">Marca</label>
                                <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca', $vehiculo->marca) }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="modelo" class="form-label">Modelo</label>
                                <input type="text" class="form-control" id="modelo" name="modelo" value="{{ old('modelo', $vehiculo->modelo) }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="matricula" class="form-label">Matrícula</label>
                                <input type="text" class="form-control" id="matricula" name="matricula" value="{{ old('matricula', $vehiculo->matricula) }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="bastidor" class="form-label">Bastidor</label>
                                <input type="text" class="form-control" id="bastidor" name="bastidor" value="{{ old('bastidor', $vehiculo->bastidor) }}">
                            </div>
                            
                            <div class="mb-3">
                                <label for="fecha_matriculacion" class="form-label">Fecha Matriculación</label>
                                <input type="date" class="form-control" id="fecha_matriculacion" name="fecha_matriculacion" value="{{ old('fecha_matriculacion', $vehiculo->fecha_matriculacion ? $vehiculo->fecha_matriculacion->format('Y-m-d') : '') }}">
                            </div>
                            
                            <div class="mb-3">
                                <label for="color" class="form-label">Color</label>
                                <input type="text" class="form-control" id="color" name="color" value="{{ old('color', $vehiculo->color) }}">
                            </div>
                            
                            <div class="mb-3">
                                <label for="cliente_id" class="form-label">Dueño</label>
                                <select class="form-select" id="cliente_id" name="cliente_id" required>
                                    <option value="">Seleccionar dueño</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" {{ old('cliente_id', $vehiculo->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->nombre }} {{ $cliente->apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="text-center">
                                <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary me-2">Cancelar</a>
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