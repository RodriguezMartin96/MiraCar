<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Detalles del Documento - {{ config('app.name', 'MiraCar') }}</title>
    
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
        
        .nav-tabs {
            border-bottom: 1px solid #dee2e6;
        }
        
        .nav-tabs .nav-link {
            margin-bottom: -1px;
            border: 1px solid transparent;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
            color: #6c757d;
            font-weight: 500;
        }
        
        .nav-tabs .nav-link.active {
            color: white;
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .nav-tabs .nav-link:hover:not(.active) {
            background-color: #f8f9fa;
            border-color: #e9ecef #e9ecef #dee2e6;
        }
        
        .file-preview {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-top: 1rem;
        }
        
        .file-icon {
            font-size: 3rem;
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <!-- Incluir la barra de navegación -->
    @include('layouts.navigation')

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body p-0">
                        <!-- Pestañas de navegación -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="{{ route('dashboard') }}">Inicio</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="{{ route('clientes.index') }}">Cliente</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="{{ route('vehiculos.index') }}">Vehículo</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="{{ route('siniestros.index') }}">Siniestros Vehículos</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="{{ route('recambios.index') }}">Recambios Stock</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="{{ route('soporte.create') }}">Soporte</a>
                            </li>
                        </ul>
                        
                        <!-- Contenido de los detalles -->
                        <div class="p-4">
                            <h2 class="card-title mb-4">Detalles del Documento</h2>
                            
                            <div class="mb-4">
                                <a href="{{ route('documentos.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-1"></i> Volver
                                </a>
                                <a href="{{ route('documentos.edit', $documento) }}" class="btn btn-outline-primary ms-2">
                                    <i class="bi bi-pencil me-1"></i> Editar
                                </a>
                                @if($documento->ruta_archivo)
                                    <a href="{{ route('documentos.download', $documento) }}" class="btn btn-outline-primary ms-2">
                                        <i class="bi bi-download me-1"></i> Descargar
                                    </a>
                                    <a href="{{ route('documentos.view', $documento) }}" class="btn btn-outline-primary ms-2" target="_blank">
                                        <i class="bi bi-eye me-1"></i> Ver
                                    </a>
                                @endif
                            </div>
                            
                            <div class="info-section">
                                <h5>Información del Documento</h5>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <p><span class="info-label">ID:</span> {{ $documento->id }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            <span class="info-label">Nombre:</span> 
                                            @if($documento->nombre == 'otro' && $documento->otro_nombre)
                                                {{ $documento->otro_nombre }}
                                            @else
                                                {{ $documento->nombre }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <p>
                                            <span class="info-label">Descripción:</span> 
                                            @if($documento->descripcion == 'otro' && $documento->otra_descripcion)
                                                {{ $documento->otra_descripcion }}
                                            @else
                                                {{ $documento->descripcion }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><span class="info-label">Formato:</span> {{ $documento->formato }}</p>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <p><span class="info-label">Fecha de creación:</span> {{ $documento->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><span class="info-label">Última actualización:</span> {{ $documento->updated_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            @if($documento->ruta_archivo)
                                <div class="info-section mb-0">
                                    <h5>Archivo</h5>
                                    <div class="file-preview text-center">
                                        @php
                                            $extension = pathinfo(storage_path('app/public/' . $documento->ruta_archivo), PATHINFO_EXTENSION);
                                            $iconClass = 'bi-file-earmark';
                                            
                                            if (in_array($extension, ['pdf'])) {
                                                $iconClass = 'bi-file-earmark-pdf';
                                            } elseif (in_array($extension, ['doc', 'docx'])) {
                                                $iconClass = 'bi-file-earmark-word';
                                            } elseif (in_array($extension, ['xls', 'xlsx'])) {
                                                $iconClass = 'bi-file-earmark-excel';
                                            } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                                                $iconClass = 'bi-file-earmark-image';
                                            }
                                        @endphp
                                        
                                        <div class="mb-3">
                                            <i class="bi {{ $iconClass }} file-icon"></i>
                                        </div>
                                        
                                        <p class="mb-2">{{ basename($documento->ruta_archivo) }}</p>
                                        
                                        <div class="btn-group">
                                            <a href="{{ route('documentos.download', $documento) }}" class="btn btn-sm btn-primary">
                                                <i class="bi bi-download me-1"></i> Descargar archivo
                                            </a>
                                            <a href="{{ route('documentos.view', $documento) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                                <i class="bi bi-eye me-1"></i> Ver archivo
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
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