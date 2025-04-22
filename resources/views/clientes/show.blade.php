<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Detalles del Cliente - {{ config('app.name', 'MiraCar') }}</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
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
        
        .btn-outline-secondary {
            color: #6c757d;
            border-color: #6c757d;
        }
        
        .btn-outline-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }
        
        .info-label {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .info-section {
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .info-section h5 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1rem;
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
                        <h2 class="card-title mb-4">Detalles del Cliente</h2>
                        
                        <div class="mb-4">
                            <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Volver
                            </a>
                            <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-outline-primary ms-2">
                                <i class="bi bi-pencil me-1"></i> Editar
                            </a>
                        </div>
                        
                        <div class="info-section">
                            <h5>Información Personal</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><span class="info-label">Nombre:</span> {{ $cliente->nombre }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><span class="info-label">Apellidos:</span> {{ $cliente->apellidos }}</p>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><span class="info-label">DNI:</span> {{ $cliente->dni ?? 'No especificado' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><span class="info-label">Teléfono:</span> {{ $cliente->telefono }}</p>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <p><span class="info-label">Email:</span> {{ $cliente->email }}</p>
                            </div>
                            
                            <div class="mb-0">
                                <p><span class="info-label">Dirección:</span> {{ $cliente->direccion ?? 'No especificada' }}</p>
                            </div>
                        </div>
                        
                        @if($cliente->cif || $cliente->direccion_juridica)
                            <div class="info-section mb-0">
                                <h5>Información Jurídica</h5>
                                
                                <div class="row mb-0">
                                    <div class="col-md-6">
                                        <p><span class="info-label">CIF:</span> {{ $cliente->cif ?? 'No especificado' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><span class="info-label">Dirección Jurídica:</span> {{ $cliente->direccion_juridica ?? 'No especificada' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>