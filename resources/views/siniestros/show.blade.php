<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'MiraCar') }} - Siniestro</title>
    
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
        
        .badge-pendiente {
            background-color: #f44336;
            color: white;
            padding: 0.5rem 1rem;
            font-size: 1rem;
        }
        
        .badge-proceso {
            background-color: #ff9800;
            color: white;
            padding: 0.5rem 1rem;
            font-size: 1rem;
        }
        
        .badge-finalizado {
            background-color: #4caf50;
            color: white;
            padding: 0.5rem 1rem;
            font-size: 1rem;
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
        }
        
        /* Contenedor con posición relativa para el badge */
        .card-container {
            position: relative;
        }
        
        /* Estilos responsivos */
        
        /* Estructura de columnas adaptativa */
        @media (max-width: 767.98px) {
            .container {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
            
            .card-body {
                padding: 1.25rem !important;
            }
            
            .card-title {
                font-size: 1.5rem;
                margin-bottom: 1rem;
                text-align: center;
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
            }
            
            .info-section h5 {
                font-size: 1.1rem;
                margin-bottom: 0.75rem;
            }
            
            .row.mb-3 {
                margin-bottom: 0 !important;
            }
            
            .col-md-6 {
                margin-bottom: 0.5rem;
            }
            
            .col-md-6:last-child {
                margin-bottom: 0;
            }
            
            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
                padding: 0.625rem 1rem;
                font-size: 1rem;
            }
            
            .ms-2 {
                margin-left: 0 !important;
            }
            
            .badge-pendiente, .badge-proceso, .badge-finalizado {
                padding: 0.375rem 0.75rem;
                font-size: 0.875rem;
                display: inline-block;
                margin-top: 0.25rem;
            }
            
            /* Ajuste para el badge en móviles */
            .view-badge {
                width: 30px;
                height: 30px;
                top: -8px;
                right: -8px;
                font-size: 0.9rem;
            }
        }
        
        /* Vista específica para móviles */
        @media (max-width: 575.98px) {
            .info-section {
                text-align: left;
            }
            
            .info-section .row {
                display: block;
            }
            
            .info-section .col-md-6 {
                width: 100%;
                padding: 0;
            }
            
            .info-section p {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #eee;
                padding-bottom: 0.5rem;
                margin-bottom: 0.5rem;
            }
            
            .info-section p:last-child {
                border-bottom: none;
                padding-bottom: 0;
                margin-bottom: 0;
            }
            
            .info-label {
                margin-right: 0.5rem;
            }
            
            .badge-pendiente, .badge-proceso, .badge-finalizado {
                margin-left: auto;
            }
        }
        
        /* Vista específica para desktop */
        @media (min-width: 768px) {
            .info-section p {
                margin-bottom: 0;
            }
        }
        
        /* Media queries específicos */
        @media (min-width: 576px) and (max-width: 767.98px) {
            .info-section .row {
                display: flex;
                flex-wrap: wrap;
            }
            
            .info-section .col-md-6 {
                width: 50%;
                flex: 0 0 50%;
                max-width: 50%;
            }
        }
        
        /* Mejoras para tablets */
        @media (min-width: 768px) and (max-width: 991.98px) {
            .card-body {
                padding: 1.5rem !important;
            }
            
            .info-section {
                padding: 1.25rem;
            }
            
            .info-section h5 {
                font-size: 1.15rem;
            }
            
            .badge-pendiente, .badge-proceso, .badge-finalizado {
                padding: 0.4rem 0.8rem;
                font-size: 0.9rem;
            }
            
            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.95rem;
            }
        }
        
        /* Optimización para dispositivos táctiles */
        @media (hover: none) and (pointer: coarse) {
            .btn {
                padding-top: 0.625rem;
                padding-bottom: 0.625rem;
                touch-action: manipulation;
            }
            
            .info-section {
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            }
        }
        
        /* Adaptación de botones para móviles */
        @media (max-width: 767.98px) {
            .action-buttons {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .action-buttons .btn {
                margin: 0;
            }
        }
        
        /* Optimización para dispositivos táctiles */
        @media (hover: none) and (pointer: coarse) {
            .btn {
                transition: background-color 0.2s ease;
            }
            
            .btn:active {
                transform: scale(0.98);
            }
        }
        
        /* Adaptación para orientación landscape */
        @media (max-height: 500px) and (orientation: landscape) {
            .container {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
            }
            
            .card-body {
                padding: 1rem !important;
            }
            
            .card-title {
                font-size: 1.25rem;
                margin-bottom: 0.75rem;
            }
            
            .info-section {
                padding: 0.75rem;
                margin-bottom: 0.75rem;
            }
            
            .info-section h5 {
                font-size: 1rem;
                margin-bottom: 0.5rem;
            }
            
            .py-4 {
                padding-top: 0.5rem !important;
                padding-bottom: 0.5rem !important;
            }
        }
        
        /* Adaptación de iconos */
        @media (max-width: 767.98px) {
            .bi {
                font-size: 1.1rem;
            }
        }
        
        /* Feedback táctil */
        @media (hover: none) and (pointer: coarse) {
            .btn:active {
                opacity: 0.8;
            }
        }
        
        /* Mejoras para la accesibilidad */
        .btn:focus, .form-control:focus {
            outline: 2px solid var(--secondary-color);
            outline-offset: 2px;
        }
        
        /* Diseño de tarjeta para información */
        .card-info {
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }
        
        .card-info-header {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.25rem;
            font-weight: 600;
        }
        
        .card-info-body {
            padding: 1.25rem;
            background-color: white;
        }
        
        /* Adaptación para móviles */
        @media (max-width: 767.98px) {
            .card-info {
                margin-bottom: 1rem;
            }
            
            .card-info-header {
                padding: 0.5rem 1rem;
                font-size: 1rem;
            }
            
            .card-info-body {
                padding: 1rem;
            }
        }
        
        /* Espaciado adaptativo */
        .section-spacing {
            margin-bottom: 2rem;
        }
        
        @media (max-width: 767.98px) {
            .section-spacing {
                margin-bottom: 1rem;
            }
        }
        
        /* Mejoras para orientación landscape */
        @media (max-height: 500px) and (orientation: landscape) {
            .section-spacing {
                margin-bottom: 0.75rem;
            }
            
            .card-info {
                margin-bottom: 0.75rem;
            }
        }
        
        /* Adaptación de iconos */
        .icon-container {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: var(--light-color);
            margin-right: 0.5rem;
        }
        
        .icon-container i {
            color: var(--primary-color);
            font-size: 1rem;
        }
        
        @media (max-width: 767.98px) {
            .icon-container {
                width: 28px;
                height: 28px;
            }
            
            .icon-container i {
                font-size: 0.9rem;
            }
        }
        
        /* Feedback táctil */
        @media (hover: none) and (pointer: coarse) {
            .btn:active, .info-section:active {
                transform: scale(0.99);
            }
        }
        
        /* Mejoras para la accesibilidad */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }
        
        /* Mejoras para la sección de descripción */
        .description-section {
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 0;
        }
        
        .description-section h5 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .description-content {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1rem;
            border: 1px solid #e9ecef;
            text-align: left;
        }
        
        @media (max-width: 767.98px) {
            .description-section {
                padding: 1rem;
            }
            
            .description-section h5 {
                font-size: 1.1rem;
                margin-bottom: 0.75rem;
            }
            
            .description-content {
                padding: 0.75rem;
            }
        }
        
        /* Estilos específicos para elementos de información en móviles */
        @media (max-width: 575.98px) {
            .mobile-info-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.75rem 0;
                border-bottom: 1px solid #eee;
            }
            
            .mobile-info-item:last-child {
                border-bottom: none;
            }
            
            .mobile-info-label {
                font-weight: 600;
                color: var(--primary-color);
            }
            
            .mobile-info-value {
                text-align: right;
            }
        }
        
        /* Acciones adicionales para móviles */
        .mobile-actions {
            display: none;
        }
        
        @media (max-width: 767.98px) {
            .mobile-actions {
                display: flex;
                justify-content: space-around;
                padding: 1rem 0;
                background-color: white;
                position: sticky;
                bottom: 0;
                box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
                z-index: 100;
                margin-top: 1rem;
            }
            
            .mobile-action-btn {
                display: flex;
                flex-direction: column;
                align-items: center;
                color: var(--primary-color);
                text-decoration: none;
                font-size: 0.8rem;
            }
            
            .mobile-action-btn i {
                font-size: 1.5rem;
                margin-bottom: 0.25rem;
            }
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
                            <h2 class="card-title mb-3 mb-md-4">Detalles del Siniestro</h2>
                            
                            <div class="action-buttons mb-3 mb-md-4 d-md-block d-none">
                                <a href="{{ route('siniestros.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-1"></i> Volver
                                </a>
                                <a href="{{ route('siniestros.edit', $siniestro) }}" class="btn btn-outline-primary ms-2">
                                    <i class="bi bi-pencil me-1"></i> Editar
                                </a>
                            </div>
                            
                            <!-- Vista para móviles -->
                            <div class="d-block d-md-none mb-3">
                                <div class="card-info">
                                    <div class="card-info-header d-flex justify-content-between align-items-center">
                                        <span>Siniestro #{{ $siniestro->numero }}</span>
                                        <span class="badge {{ 
                                            $siniestro->estado == 'Finalizado' ? 'badge-finalizado' : 
                                            ($siniestro->estado == 'En proceso' ? 'badge-proceso' : 'badge-pendiente') 
                                        }} rounded-pill">{{ $siniestro->estado }}</span>
                                    </div>
                                    <div class="card-info-body">
                                        <div class="mobile-info-item">
                                            <span class="mobile-info-label">Cliente:</span>
                                            <span class="mobile-info-value">{{ $siniestro->cliente->nombre }} {{ $siniestro->cliente->apellidos }}</span>
                                        </div>
                                        <div class="mobile-info-item">
                                            <span class="mobile-info-label">DNI:</span>
                                            <span class="mobile-info-value">{{ $siniestro->cliente->dni }}</span>
                                        </div>
                                        <div class="mobile-info-item">
                                            <span class="mobile-info-label">Vehículo:</span>
                                            <span class="mobile-info-value">{{ $siniestro->vehiculo->marca }} {{ $siniestro->vehiculo->modelo }}</span>
                                        </div>
                                        <div class="mobile-info-item">
                                            <span class="mobile-info-label">Matrícula:</span>
                                            <span class="mobile-info-value">{{ $siniestro->vehiculo->matricula }}</span>
                                        </div>
                                        <div class="mobile-info-item">
                                            <span class="mobile-info-label">Bastidor:</span>
                                            <span class="mobile-info-value">{{ $siniestro->vehiculo->bastidor ?? 'No especificado' }}</span>
                                        </div>
                                        <div class="mobile-info-item">
                                            <span class="mobile-info-label">Fecha Matriculación:</span>
                                            <span class="mobile-info-value">{{ $siniestro->vehiculo->fecha_matriculacion ? $siniestro->vehiculo->fecha_matriculacion->format('d/m/Y') : 'No especificada' }}</span>
                                        </div>
                                        <div class="mobile-info-item">
                                            <span class="mobile-info-label">Fecha Entrada:</span>
                                            <span class="mobile-info-value">{{ $siniestro->fecha_entrada->format('d/m/Y') }}</span>
                                        </div>
                                        <div class="mobile-info-item">
                                            <span class="mobile-info-label">Fecha Salida:</span>
                                            <span class="mobile-info-value">{{ $siniestro->fecha_salida ? $siniestro->fecha_salida->format('d/m/Y') : 'Pendiente' }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                @if($siniestro->descripcion)
                                    <div class="card-info">
                                        <div class="card-info-header">
                                            <i class="bi bi-card-text me-2"></i> Descripción
                                        </div>
                                        <div class="card-info-body">
                                            <p class="mb-0">{{ $siniestro->descripcion }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Vista para desktop y tablet -->
                            <div class="d-none d-md-block">
                                <div class="info-section">
                                    <h5><i class="bi bi-info-circle me-2"></i>Información del Siniestro</h5>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <p><span class="info-label">Número:</span> {{ $siniestro->numero }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <span class="info-label">Estado:</span> 
                                                <span class="badge {{ 
                                                    $siniestro->estado == 'Finalizado' ? 'badge-finalizado' : 
                                                    ($siniestro->estado == 'En proceso' ? 'badge-proceso' : 'badge-pendiente') 
                                                }} rounded-pill">{{ $siniestro->estado }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="info-section">
                                    <h5><i class="bi bi-person me-2"></i>Información del Cliente</h5>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <p><span class="info-label">Cliente:</span> {{ $siniestro->cliente->nombre }} {{ $siniestro->cliente->apellidos }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><span class="info-label">DNI:</span> {{ $siniestro->cliente->dni }}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="info-section">
                                    <h5><i class="bi bi-car-front me-2"></i>Información del Vehículo</h5>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <p><span class="info-label">Vehículo:</span> {{ $siniestro->vehiculo->marca }} {{ $siniestro->vehiculo->modelo }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><span class="info-label">Matrícula:</span> {{ $siniestro->vehiculo->matricula }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-0">
                                        <div class="col-md-6">
                                            <p><span class="info-label">Bastidor:</span> {{ $siniestro->vehiculo->bastidor ?? 'No especificado' }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><span class="info-label">Fecha Matriculación:</span> {{ $siniestro->vehiculo->fecha_matriculacion ? $siniestro->vehiculo->fecha_matriculacion->format('d/m/Y') : 'No especificada' }}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="info-section">
                                    <h5><i class="bi bi-calendar me-2"></i>Fechas</h5>
                                    <div class="row mb-0">
                                        <div class="col-md-6">
                                            <p><span class="info-label">Fecha Entrada:</span> {{ $siniestro->fecha_entrada->format('d/m/Y') }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><span class="info-label">Fecha Salida:</span> {{ $siniestro->fecha_salida ? $siniestro->fecha_salida->format('d/m/Y') : 'Pendiente' }}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                @if($siniestro->descripcion)
                                    <div class="info-section mb-0">
                                        <h5><i class="bi bi-card-text me-2"></i>Descripción</h5>
                                        <div class="description-content">
                                            <p class="mb-0">{{ $siniestro->descripcion }}</p>
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
    
    <!-- Acciones para móviles (fijas en la parte inferior) -->
    <div class="mobile-actions">
        <a href="{{ route('siniestros.index') }}" class="mobile-action-btn">
            <i class="bi bi-arrow-left"></i>
            <span>Volver</span>
        </a>
        <a href="{{ route('siniestros.edit', $siniestro) }}" class="mobile-action-btn">
            <i class="bi bi-pencil"></i>
            <span>Editar</span>
        </a>
        <a href="#" class="mobile-action-btn" onclick="window.print(); return false;">
            <i class="bi bi-printer"></i>
            <span>Imprimir</span>
        </a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Script para mejorar la experiencia en dispositivos móviles
        document.addEventListener('DOMContentLoaded', function() {
            // Detectar si es un dispositivo táctil
            if ('ontouchstart' in window) {
                // Mejorar la experiencia táctil para los botones
                const buttons = document.querySelectorAll('.btn, .mobile-action-btn');
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