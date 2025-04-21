<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Detalles del Siniestro - MiraCar</title>
    
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
                        <h2 class="card-title mb-4">Detalles del Siniestro</h2>
                        
                        <div class="mb-3">
                            <a href="{{ route('siniestros.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Volver
                            </a>
                            <a href="{{ route('siniestros.edit', $siniestro) }}" class="btn btn-outline-primary ms-2">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Número:</strong> {{ $siniestro->numero }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Estado:</strong> {{ $siniestro->estado }}</p>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Cliente:</strong> {{ $siniestro->cliente->nombre }} {{ $siniestro->cliente->apellidos }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>DNI:</strong> {{ $siniestro->cliente->dni }}</p>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Vehículo:</strong> {{ $siniestro->vehiculo->marca }} {{ $siniestro->vehiculo->modelo }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Matrícula:</strong> {{ $siniestro->vehiculo->matricula }}</p>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Fecha Entrada:</strong> {{ $siniestro->fecha_entrada->format('d/m/Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Fecha Salida:</strong> {{ $siniestro->fecha_salida ? $siniestro->fecha_salida->format('d/m/Y') : 'Pendiente' }}</p>
                            </div>
                        </div>
                        
                        @if($siniestro->descripcion)
                            <div class="mb-3">
                                <p><strong>Descripción:</strong></p>
                                <p>{{ $siniestro->descripcion }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>