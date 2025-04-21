<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Detalles del Recambio - MiraCar</title>
    
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
                        <h2 class="card-title mb-4">Detalles del Recambio</h2>
                        
                        <div class="mb-3">
                            <a href="{{ route('recambios.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Volver
                            </a>
                            <a href="{{ route('recambios.edit', $recambio) }}" class="btn btn-outline-primary ms-2">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Producto:</strong> {{ $recambio->producto }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Cantidad:</strong> {{ $recambio->cantidad }}</p>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Referencia:</strong> {{ $recambio->referencia ?? 'No especificada' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Precio:</strong> {{ $recambio->precio ? number_format($recambio->precio, 2) . ' €' : 'No especificado' }}</p>
                            </div>
                        </div>
                        
                        @if($recambio->descripcion)
                            <div class="mb-3">
                                <p><strong>Descripción:</strong></p>
                                <p>{{ $recambio->descripcion }}</p>
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