<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'MiraCar') }} - Documento</title>
    
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
            text-align: center;
        }
        
        .info-section h5 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .file-icon {
            font-size: 3rem;
            color: var(--primary-color);
        }
        
        /* Estilos para el badge de visualización */
        .view-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            z-index: 10;
        }
        
        /* Contenedor con posición relativa para el badge */
        .card-container {
            position: relative;
        }
        
        /* Estilos responsivos */
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        /* Media queries para dispositivos móviles */
        @media (max-width: 767.98px) {
            .container {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
            
            .card-body {
                padding: 0;
            }
            
            .p-4 {
                padding: 1.25rem !important;
            }
            
            .card-title {
                font-size: 1.5rem;
                margin-bottom: 1rem;
            }
            
            .py-4 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }
            
            .mb-4 {
                margin-bottom: 1rem !important;
            }
            
            .info-section {
                padding: 1rem;
                margin-bottom: 1rem;
                text-align: left;
            }
            
            .info-section h5 {
                font-size: 1.1rem;
                margin-bottom: 0.75rem;
                text-align: center;
            }
            
            .file-icon {
                font-size: 2.5rem;
            }
            
            /* Ajustes para los botones en móviles */
            .action-buttons {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
                justify-content: center;
            }
            
            .action-buttons .btn {
                flex: 1 0 calc(50% - 0.5rem);
                margin: 0 !important;
                padding: 0.5rem;
                font-size: 0.9rem;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .action-buttons .btn i {
                margin-right: 0.25rem;
            }
            
            /* Ajustes para la información del documento en móviles */
            .info-row {
                margin-bottom: 0.5rem;
                padding-bottom: 0.5rem;
                border-bottom: 1px solid #eee;
            }
            
            .info-row:last-child {
                border-bottom: none;
                margin-bottom: 0;
                padding-bottom: 0;
            }
            
            .info-item {
                margin-bottom: 0.5rem;
            }
            
            /* Ajustes para la previsualización del archivo en móviles */
            .file-preview {
                padding: 0.5rem;
            }
            
            .file-name {
                font-size: 0.9rem;
                word-break: break-all;
                margin-bottom: 1rem;
            }
            
            .file-actions {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .file-actions .btn {
                width: 100%;
                margin: 0 !important;
            }
            
            /* Ajuste para el badge en móviles */
            .view-badge {
                width: 30px;
                height: 30px;
                font-size: 0.9rem;
            }
        }
        
        /* Media queries para tablets */
        @media (min-width: 768px) and (max-width: 991.98px) {
            .card-body {
                padding: 0;
            }
            
            .p-4 {
                padding: 1.5rem !important;
            }
            
            .info-section {
                padding: 1.25rem;
            }
            
            .action-buttons {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
            }
            
            .action-buttons .btn {
                margin: 0 !important;
            }
        }
        
        /* Mejoras para dispositivos táctiles */
        @media (hover: none) and (pointer: coarse) {
            .btn {
                padding-top: 0.625rem;
                padding-bottom: 0.625rem;
            }
            
            .btn-sm {
                padding-top: 0.375rem;
                padding-bottom: 0.375rem;
            }
        }
        
        /* Animaciones y transiciones */
        .btn {
            transition: all 0.2s ease;
        }
        
        .btn:active {
            transform: scale(0.97);
        }
        
        /* Mejoras para orientación landscape en móviles */
        @media (max-height: 500px) and (orientation: landscape) {
            .container {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
            }
            
            .card-body {
                padding: 0;
            }
            
            .p-4 {
                padding: 1rem !important;
            }
            
            .card-title {
                font-size: 1.25rem;
                margin-bottom: 0.75rem;
            }
            
            .py-4 {
                padding-top: 0.5rem !important;
                padding-bottom: 0.5rem !important;
            }
            
            .info-section {
                padding: 0.75rem;
                margin-bottom: 0.75rem;
            }
            
            .info-section h5 {
                font-size: 1rem;
                margin-bottom: 0.5rem;
            }
            
            .file-icon {
                font-size: 2rem;
            }
        }
        
        /* Mejoras para pantallas muy pequeñas */
        @media (max-width: 375px) {
            .p-4 {
                padding: 1rem !important;
            }
            
            .card-title {
                font-size: 1.25rem;
            }
            
            .info-section {
                padding: 0.75rem;
            }
            
            .info-section h5 {
                font-size: 1rem;
            }
            
            .file-icon {
                font-size: 2rem;
            }
            
            .action-buttons .btn {
                font-size: 0.8rem;
                padding: 0.4rem;
            }
            
            .btn-sm {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }
        }
        
        /* Mejoras para la visualización de la información */
        .info-grid {
            display: grid;
            gap: 0.5rem 1rem;
        }
        
        @media (min-width: 768px) {
            .info-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        .info-item {
            display: flex;
            flex-direction: column;
        }
        
        @media (max-width: 767.98px) {
            .info-item {
                border-bottom: 1px solid #eee;
                padding-bottom: 0.5rem;
                margin-bottom: 0.5rem;
            }
            
            .info-item:last-child {
                border-bottom: none;
                margin-bottom: 0;
                padding-bottom: 0;
            }
        }
        
        .info-value {
            font-weight: 400;
        }
        
        /* Mejoras para la previsualización del archivo */
        .file-preview {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .file-name {
            word-break: break-word;
            max-width: 100%;
            display: inline-block;
        }
        
        /* Mejoras para los botones de acción */
        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .action-button:hover {
            transform: translateY(-1px);
        }
        
        .action-button:active {
            transform: translateY(0);
        }
        
        /* Mejoras para la accesibilidad */
        .btn:focus, .btn:focus-visible {
            outline: 2px solid var(--secondary-color);
            outline-offset: 2px;
        }
        
        /* Mejoras para el contraste */
        .info-label {
            color: var(--primary-color);
        }
        
        .info-value {
            color: #333;
        }
    </style>
</head>
<body>
    <!-- Incluir la barra de navegación -->
    @include('layouts.navigation')

    <div class="container py-3 py-md-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card-container">
                    <div class="card">
                        <div class="view-badge d-flex">
                            <i class="bi bi-eye-fill"></i>
                        </div>
                        <div class="card-body">
                            <!-- Contenido de los detalles -->
                            <div class="p-3 p-md-4">
                                <h2 class="card-title mb-3 mb-md-4 text-center">
                                    <i class="bi bi-file-earmark-text me-2 d-none d-sm-inline-block"></i>Detalles del Documento
                                </h2>
                                
                                <div class="action-buttons mb-3 mb-md-4">
                                    <a href="{{ route('documentos.index') }}" class="btn btn-outline-secondary action-button">
                                        <i class="bi bi-arrow-left"></i> 
                                        <span>Volver</span>
                                    </a>
                                    <a href="{{ route('documentos.edit', $documento) }}" class="btn btn-outline-primary action-button">
                                        <i class="bi bi-pencil"></i> 
                                        <span>Editar</span>
                                    </a>
                                    @if($documento->ruta_archivo)
                                        <a href="{{ route('documentos.download', $documento) }}" class="btn btn-outline-primary action-button">
                                            <i class="bi bi-download"></i> 
                                            <span>Descargar</span>
                                        </a>
                                        <a href="{{ route('documentos.view', $documento) }}" class="btn btn-outline-primary action-button" target="_blank">
                                            <i class="bi bi-eye"></i> 
                                            <span>Ver</span>
                                        </a>
                                    @endif
                                </div>
                                
                                <div class="info-section">
                                    <h5>
                                        <i class="bi bi-info-circle me-2"></i>Información del Documento
                                    </h5>
                                    <div class="info-grid">
                                        <div class="info-item">
                                            <span class="info-label">Nombre</span>
                                            <span class="info-value">
                                                @if($documento->nombre == 'otro' && $documento->otro_nombre)
                                                    {{ $documento->otro_nombre }}
                                                @else
                                                    {{ $documento->nombre }}
                                                @endif
                                            </span>
                                        </div>
                                        
                                        <div class="info-item">
                                            <span class="info-label">Descripción</span>
                                            <span class="info-value">
                                                @if($documento->descripcion == 'otro' && $documento->otra_descripcion)
                                                    {{ $documento->otra_descripcion }}
                                                @else
                                                    {{ $documento->descripcion }}
                                                @endif
                                            </span>
                                        </div>
                                        
                                        <div class="info-item">
                                            <span class="info-label">Formato</span>
                                            <span class="info-value">{{ $documento->formato }}</span>
                                        </div>
                                        
                                        <div class="info-item">
                                            <span class="info-label">Fecha de creación</span>
                                            <span class="info-value">{{ $documento->created_at->format('d/m/Y H:i') }}</span>
                                        </div>
                                        
                                        <div class="info-item">
                                            <span class="info-label">Última actualización</span>
                                            <span class="info-value">{{ $documento->updated_at->format('d/m/Y H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                @if($documento->ruta_archivo)
                                    <div class="info-section mb-0">
                                        <h5>
                                            <i class="bi bi-file-earmark me-2"></i>Archivo
                                        </h5>
                                        <div class="file-preview">
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
                                            
                                            <p class="file-name mb-3">{{ basename($documento->ruta_archivo) }}</p>
                                            
                                            <div class="file-actions">
                                                <a href="{{ route('documentos.download', $documento) }}" class="btn btn-primary action-button">
                                                    <i class="bi bi-download"></i> Descargar archivo
                                                </a>
                                                <a href="{{ route('documentos.view', $documento) }}" class="btn btn-outline-primary action-button mt-2 mt-md-0" target="_blank">
                                                    <i class="bi bi-eye"></i> Ver archivo
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
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Script para mejorar la experiencia en dispositivos móviles
        document.addEventListener('DOMContentLoaded', function() {
            // Detectar si es un dispositivo táctil
            if ('ontouchstart' in window) {
                // Mejorar la experiencia táctil para los botones
                const buttons = document.querySelectorAll('.btn');
                buttons.forEach(button => {
                    button.addEventListener('touchstart', function() {
                        this.style.opacity = '0.7';
                    });
                    
                    button.addEventListener('touchend', function() {
                        this.style.opacity = '1';
                    });
                });
                
                // Detectar orientación landscape en móviles
                function adjustForLandscape() {
                    if (window.innerHeight < 500 && window.innerWidth > window.innerHeight) {
                        document.body.classList.add('landscape-mode');
                    } else {
                        document.body.classList.remove('landscape-mode');
                    }
                }
                
                // Ejecutar al cargar y al cambiar orientación
                adjustForLandscape();
                window.addEventListener('resize', adjustForLandscape);
                window.addEventListener('orientationchange', adjustForLandscape);
            }
        });
    </script>
</body>
</html>