<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Detalles del Cliente - MiraCar</title>
    
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
                        <h2 class="card-title mb-4">Detalles del Cliente</h2>
                        
                        <div class="mb-3">
                            <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Volver
                            </a>
                            <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-outline-primary ms-2">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Apellidos:</strong> {{ $cliente->apellidos }}</p>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>DNI:</strong> {{ $cliente->dni ?? 'No especificado' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <p><strong>Email:</strong> {{ $cliente->email }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <p><strong>Dirección:</strong> {{ $cliente->direccion ?? 'No especificada' }}</p>
                        </div>
                        
                        @if($cliente->cif || $cliente->direccion_juridica)
                            <hr>
                            <h5 class="mt-4">Información Jurídica</h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><strong>CIF:</strong> {{ $cliente->cif ?? 'No especificado' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Dirección Jurídica:</strong> {{ $cliente->direccion_juridica ?? 'No especificada' }}</p>
                                </div>
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