<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Detalles del Vehículo - MiraCar</title>
    
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
                        <h2 class="card-title mb-4">Detalles del Vehículo</h2>
                        
                        <div class="mb-3">
                            <a href="{{ route('vehiculos.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Volver
                            </a>
                            <a href="{{ route('vehiculos.edit', $vehiculo) }}" class="btn btn-outline-primary ms-2">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Marca:</strong> {{ $vehiculo->marca }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Modelo:</strong> {{ $vehiculo->modelo }}</p>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Matrícula:</strong> {{ $vehiculo->matricula }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Bastidor:</strong> {{ $vehiculo->bastidor ?? 'No especificado' }}</p>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Fecha Matriculación:</strong> {{ $vehiculo->fecha_matriculacion ? $vehiculo->fecha_matriculacion->format('d/m/Y') : 'No especificada' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Color:</strong> {{ $vehiculo->color ?? 'No especificado' }}</p>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <p><strong>Dueño:</strong> {{ $vehiculo->cliente->nombre }} {{ $vehiculo->cliente->apellidos }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>