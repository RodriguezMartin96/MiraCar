<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Detalles del Vehículo - {{ config('app.name', 'MiraCar') }}</title>
    
    <link rel="icon" href="{{ asset('galeria/logo.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('galeria/logo.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('galeria/logo.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('galeria/logo.png') }}">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #235390;
            --secondary-color: #4f8cff;
            --light-color: #e3ecff;
            --border-radius: 0.75rem;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #f8fafc;
            padding-bottom: env(safe-area-inset-bottom);
        }
        
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            transition: var(--transition);
        }
        
        .card-title {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 1.5rem;
        }
        
        .btn {
            border-radius: var(--border-radius);
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: var(--transition);
        }
        
        .btn-outline-secondary {
            color: #6c757d;
            border-color: #6c757d;
        }
        
        .btn-outline-secondary:hover, .btn-outline-secondary:focus {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover, .btn-outline-primary:focus {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }
        
        .info-label {
            font-weight: 600;
            color: var(--primary-color);
            display: block;
            margin-bottom: 0.25rem;
            font-size: 0.875rem;
        }
        
        .info-value {
            font-size: 1rem;
            margin-bottom: 1rem;
        }
        
        .info-section {
            background-color: #f8f9fa;
            border-radius: var(--border-radius);
            padding: 1.25rem;
            margin-bottom: 1.25rem;
            transition: var(--transition);
        }
        
        .info-section:hover {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        }
        
        .info-section h5 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }
        
        .info-section h5 i {
            margin-right: 0.5rem;
        }
        
        .vehicle-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .vehicle-icon {
            background-color: var(--light-color);
            color: var(--primary-color);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin-right: 1rem;
        }
        
        .vehicle-title {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .vehicle-subtitle {
            color: #6c757d;
            margin: 0;
            font-size: 0.875rem;
        }
        
        .action-bar {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        
        .action-bar .btn {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .contact-link {
            display: inline-flex;
            align-items: center;
            color: var(--primary-color);
            text-decoration: none;
            margin-right: 1rem;
            margin-bottom: 0.5rem;
        }
        
        .contact-link i {
            margin-right: 0.25rem;
        }
        
        .contact-link:hover {
            color: var(--secondary-color);
        }
        
        .color-preview {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: inline-block;
            margin-left: 0.5rem;
            border: 1px solid #ddd;
            vertical-align: middle;
        }
        
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
        
        .card-container {
            position: relative;
        }
        
        @media (max-width: 767.98px) {
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }
            
            .card-body {
                padding: 1.25rem;
            }
            
            .card-title {
                font-size: 1.25rem;
                margin-bottom: 1rem;
                text-align: center;
            }
            
            .info-section {
                padding: 1rem;
                margin-bottom: 1rem;
            }
            
            .info-section h5 {
                font-size: 1rem;
            }
            
            .vehicle-header {
                flex-direction: column;
                text-align: center;
                margin-bottom: 1.25rem;
            }
            
            .vehicle-icon {
                margin-right: 0;
                margin-bottom: 0.75rem;
            }
            
            .action-bar {
                flex-direction: column;
            }
            
            .action-bar .btn {
                width: 100%;
            }
            
            .info-label {
                font-size: 0.8125rem;
            }
            
            .info-value {
                font-size: 0.9375rem;
            }
            
            .mobile-info-item {
                margin-bottom: 1rem;
            }
            
            .mobile-info-item:last-child {
                margin-bottom: 0;
            }
            
            .mobile-section-title {
                display: flex;
                align-items: center;
                justify-content: space-between;
                cursor: pointer;
                padding: 0.75rem;
                background-color: var(--light-color);
                border-radius: var(--border-radius);
                margin-bottom: 1rem;
            }
            
            .mobile-section-title h5 {
                margin-bottom: 0;
                font-size: 1rem;
            }
            
            .mobile-section-content {
                padding: 0 0.5rem;
            }
        }
        
        @media (min-width: 768px) and (max-width: 991.98px) {
            .card-body {
                padding: 1.5rem;
            }
            
            .info-section {
                padding: 1.25rem;
            }
            
            .vehicle-icon {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
            }
            
            .vehicle-title {
                font-size: 1.125rem;
            }
        }
        
        @media (hover: none) and (pointer: coarse) {
            .btn {
                min-height: 44px;
            }
            
            .btn:active {
                transform: scale(0.98);
            }
            
            .info-section:active {
                background-color: #f0f0f0;
            }
        }
        
        .btn {
            position: relative;
            overflow: hidden;
        }
        
        .btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }
        
        .btn:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }
        
        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }
            20% {
                transform: scale(25, 25);
                opacity: 0.5;
            }
            100% {
                opacity: 0;
                transform: scale(40, 40);
            }
        }
        
        .btn:focus, a:focus {
            outline: 2px solid var(--secondary-color);
            outline-offset: 2px;
        }
        
        @media print {
            .btn, .action-bar {
                display: none !important;
            }
            
            .card {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }
            
            .info-section {
                break-inside: avoid;
                page-break-inside: avoid;
                border: 1px solid #ddd !important;
                box-shadow: none !important;
            }
        }
    </style>
</head>
<body>
    @include('layouts.navigation')

    <div class="container py-3 py-md-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card-container">
                    <div class="card">
                        <div class="view-badge d-none d-md-flex">
                            <i class="bi bi-eye-fill"></i>
                        </div>
                        <div class="card-body">
                            <div class="d-none d-md-block mb-4">
                                <h2 class="card-title">Detalles del Vehículo</h2>
                            </div>
                            
                            <div class="vehicle-header">
                                <div class="vehicle-icon">
                                    <i class="bi bi-car-front"></i>
                                </div>
                                <div>
                                    <h3 class="vehicle-title">{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</h3>
                                    <p class="vehicle-subtitle">{{ $vehiculo->matricula }}</p>
                                </div>
                            </div>
                            
                            <div class="action-bar">
                                <a href="{{ route('vehiculos.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i> Volver
                                </a>
                                <a href="{{ route('vehiculos.edit', $vehiculo) }}" class="btn btn-outline-primary">
                                    <i class="bi bi-pencil me-2"></i> Editar
                                </a>
                            </div>
                            
                            <div class="info-section">
                                <h5><i class="bi bi-info-circle"></i> Información del Vehículo</h5>
                                
                                <div class="d-none d-md-block">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <span class="info-label">Marca</span>
                                                <p class="info-value">{{ $vehiculo->marca }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <span class="info-label">Modelo</span>
                                                <p class="info-value">{{ $vehiculo->modelo }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <span class="info-label">Matrícula</span>
                                                <p class="info-value">{{ $vehiculo->matricula }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <span class="info-label">Bastidor</span>
                                                <p class="info-value">{{ $vehiculo->bastidor ?? 'No especificado' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-md-0">
                                                <span class="info-label">Fecha Matriculación</span>
                                                <p class="info-value">{{ $vehiculo->fecha_matriculacion ? $vehiculo->fecha_matriculacion->format('d/m/Y') : 'No especificada' }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-md-0">
                                                <span class="info-label">Color</span>
                                                <p class="info-value">
                                                    {{ $vehiculo->color ?? 'No especificado' }}
                                                    <span class="color-preview" style="background-color: {{ getColorHex($vehiculo->color) }};"></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-md-none">
                                    <div class="mobile-info-item">
                                        <span class="info-label">Marca</span>
                                        <p class="info-value">{{ $vehiculo->marca }}</p>
                                    </div>
                                    
                                    <div class="mobile-info-item">
                                        <span class="info-label">Modelo</span>
                                        <p class="info-value">{{ $vehiculo->modelo }}</p>
                                    </div>
                                    
                                    <div class="mobile-info-item">
                                        <span class="info-label">Matrícula</span>
                                        <p class="info-value">{{ $vehiculo->matricula }}</p>
                                    </div>
                                    
                                    <div class="mobile-info-item">
                                        <span class="info-label">Bastidor</span>
                                        <p class="info-value">{{ $vehiculo->bastidor ?? 'No especificado' }}</p>
                                    </div>
                                    
                                    <div class="mobile-info-item">
                                        <span class="info-label">Fecha Matriculación</span>
                                        <p class="info-value">{{ $vehiculo->fecha_matriculacion ? $vehiculo->fecha_matriculacion->format('d/m/Y') : 'No especificada' }}</p>
                                    </div>
                                    
                                    <div class="mobile-info-item">
                                        <span class="info-label">Color</span>
                                        <p class="info-value">
                                            {{ $vehiculo->color ?? 'No especificado' }}
                                            <span class="color-preview" style="background-color: {{ getColorHex($vehiculo->color) }};"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="info-section mb-0">
                                <h5><i class="bi bi-person"></i> Información del Propietario</h5>
                                
                                <div class="d-none d-md-block">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <span class="info-label">Nombre Completo</span>
                                                <p class="info-value">{{ $vehiculo->cliente->nombre }} {{ $vehiculo->cliente->apellidos }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <span class="info-label">DNI</span>
                                                <p class="info-value">{{ $vehiculo->cliente->dni }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if($vehiculo->cliente->telefono || $vehiculo->cliente->email)
                                    <div class="mt-2">
                                        <span class="info-label">Contacto</span>
                                        <div class="mt-2">
                                            @if($vehiculo->cliente->telefono)
                                                <a href="tel:{{ $vehiculo->cliente->telefono }}" class="contact-link">
                                                    <i class="bi bi-telephone"></i> {{ $vehiculo->cliente->telefono }}
                                                </a>
                                            @endif
                                            
                                            @if($vehiculo->cliente->email)
                                                <a href="mailto:{{ $vehiculo->cliente->email }}" class="contact-link">
                                                    <i class="bi bi-envelope"></i> {{ $vehiculo->cliente->email }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="d-md-none">
                                    <div class="mobile-info-item">
                                        <span class="info-label">Nombre Completo</span>
                                        <p class="info-value">{{ $vehiculo->cliente->nombre }} {{ $vehiculo->cliente->apellidos }}</p>
                                    </div>
                                    
                                    <div class="mobile-info-item">
                                        <span class="info-label">DNI</span>
                                        <p class="info-value">{{ $vehiculo->cliente->dni }}</p>
                                    </div>
                                    
                                    @if($vehiculo->cliente->telefono || $vehiculo->cliente->email)
                                    <div class="mobile-info-item">
                                        <span class="info-label">Contacto</span>
                                        <div class="d-flex flex-column mt-2">
                                            @if($vehiculo->cliente->telefono)
                                                <a href="tel:{{ $vehiculo->cliente->telefono }}" class="contact-link mb-2">
                                                    <i class="bi bi-telephone"></i> {{ $vehiculo->cliente->telefono }}
                                                </a>
                                            @endif
                                            
                                            @if($vehiculo->cliente->email)
                                                <a href="mailto:{{ $vehiculo->cliente->email }}" class="contact-link">
                                                    <i class="bi bi-envelope"></i> {{ $vehiculo->cliente->email }}
                                                </a>
                                            @endif
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if ('ontouchstart' in window) {
                const buttons = document.querySelectorAll('.btn');
                buttons.forEach(button => {
                    button.addEventListener('touchstart', function() {
                        this.style.opacity = '0.8';
                    });
                    
                    button.addEventListener('touchend', function() {
                        this.style.opacity = '1';
                    });
                });
                
                document.body.classList.add('touch-device');
            }
        });
        
        function toggleSection(element) {
            const content = element.nextElementSibling;
            if (content.style.display === 'none') {
                content.style.display = 'block';
                element.querySelector('.toggle-icon').classList.replace('bi-chevron-down', 'bi-chevron-up');
            } else {
                content.style.display = 'none';
                element.querySelector('.toggle-icon').classList.replace('bi-chevron-up', 'bi-chevron-down');
            }
        }
    </script>
    
    <?php
    function getColorHex($colorName) {
        $colorMap = [
            'blanco' => '#FFFFFF',
            'negro' => '#000000',
            'rojo' => '#FF0000',
            'azul' => '#0000FF',
            'verde' => '#008000',
            'amarillo' => '#FFFF00',
            'gris' => '#808080',
            'plata' => '#C0C0C0',
            'dorado' => '#FFD700',
            'marrón' => '#A52A2A',
            'naranja' => '#FFA500',
            'púrpura' => '#800080',
            'beige' => '#F5F5DC',
            'granate' => '#800000',
            'turquesa' => '#40E0D0'
        ];
        
        $colorName = strtolower($colorName ?? '');
        return $colorMap[$colorName] ?? '#EEEEEE';
    }
    ?>
</body>
</html>