<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'MiraCar') }} - Cliente</title>
    
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
            --border-radius: 0.75rem;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #f8fafc;
        }
        
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
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
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
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
        
        .card-body {
            padding: 1.5rem;
        }
        
        /* Estilos para los botones de acción */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        
        .action-buttons .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: var(--transition);
        }
        
        /* Estilos para la información del cliente */
        .client-info-item {
            padding: 0.75rem;
            margin-bottom: 0.75rem;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
        }
        
        .client-info-item:hover {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .client-info-item p {
            margin-bottom: 0;
            display: flex;
            flex-direction: column;
        }
        
        .client-info-item .info-label {
            margin-bottom: 0.25rem;
        }
        
        .client-info-value {
            font-weight: 400;
        }
        
        /* Media queries para dispositivos móviles */
        @media (max-width: 767.98px) {
            .container {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
            
            .card-body {
                padding: 1.25rem;
            }
            
            .card-title {
                font-size: 1.5rem;
                margin-bottom: 1rem;
                text-align: center;
            }
            
            .info-section {
                padding: 1rem;
                margin-bottom: 1rem;
            }
            
            .info-section h5 {
                font-size: 1.1rem;
                margin-bottom: 0.75rem;
                justify-content: center;
            }
            
            .mb-3 {
                margin-bottom: 0.75rem !important;
            }
            
            .mb-4 {
                margin-bottom: 1rem !important;
            }
            
            .btn {
                padding: 0.5rem 0.75rem;
                font-size: 0.95rem;
                height: 44px; /* Altura mínima para área táctil */
            }
            
            /* Botones en móvil */
            .action-buttons {
                flex-direction: column;
                width: 100%;
            }
            
            .action-buttons .btn {
                width: 100%;
                justify-content: center;
            }
            
            /* Mostrar el badge en móviles */
            .view-badge.d-none.d-md-flex {
                display: flex !important;
                width: 30px;
                height: 30px;
                top: -8px;
                right: -8px;
                font-size: 0.9rem;
            }
            
            /* Información del cliente en móvil */
            .client-info-item {
                padding: 0.75rem;
                margin-bottom: 0.75rem;
            }
            
            .client-info-item p {
                display: flex;
                flex-direction: column;
                gap: 0.25rem;
            }
            
            .client-info-item .info-label {
                font-size: 0.9rem;
            }
            
            .client-info-value {
                font-size: 1rem;
            }
            
            /* Mejorar la visualización de enlaces en móvil */
            .client-info-item a {
                color: var(--primary-color);
                text-decoration: none;
                display: inline-block;
                padding: 0.25rem 0;
            }
            
            .client-info-item a:active {
                opacity: 0.7;
            }
        }
        
        /* Media queries para tablets */
        @media (min-width: 768px) and (max-width: 991.98px) {
            .card-body {
                padding: 1.75rem;
            }
            
            .info-section {
                padding: 1.25rem;
            }
            
            .action-buttons {
                justify-content: flex-start;
            }
            
            .action-buttons .btn {
                min-width: 120px;
            }
            
            /* Ajustes para la información en tablets */
            .row {
                margin-left: -0.5rem;
                margin-right: -0.5rem;
            }
            
            .col-md-6 {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }
            
            /* Mejorar la visualización de enlaces en tablet */
            a[href^="tel:"], a[href^="mailto:"] {
                color: var(--primary-color);
                text-decoration: none;
            }
            
            a[href^="tel:"]:hover, a[href^="mailto:"]:hover {
                text-decoration: underline;
            }
        }
        
        /* Mejoras para dispositivos táctiles */
        @media (hover: none) and (pointer: coarse) {
            .btn {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
                min-height: 44px; /* Área táctil mínima recomendada */
            }
            
            /* Mejorar la experiencia táctil */
            .btn, a {
                touch-action: manipulation;
            }
            
            /* Efecto de toque para elementos interactivos */
            .client-info-item:active {
                background-color: #f8f9fa;
            }
            
            /* Mejorar la visualización de enlaces en dispositivos táctiles */
            a[href^="tel:"], a[href^="mailto:"] {
                display: inline-block;
                padding: 0.25rem 0;
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
                max-width: 100%;
            }
            
            .card-body {
                padding: 1rem;
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
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }
            
            /* Ajustes específicos para landscape */
            .action-buttons {
                flex-direction: row;
            }
            
            .action-buttons .btn {
                width: auto;
            }
            
            /* Mostrar información en dos columnas en landscape */
            .d-md-none {
                display: flex !important;
                flex-wrap: wrap;
                margin: -0.375rem;
            }
            
            .client-info-item {
                width: calc(50% - 0.75rem);
                margin: 0.375rem;
                flex-grow: 1;
            }
        }
        
        /* Mejoras para pantallas muy pequeñas */
        @media (max-width: 375px) {
            .card-body {
                padding: 1rem;
            }
            
            .card-title {
                font-size: 1.25rem;
            }
            
            .info-section {
                padding: 0.75rem;
            }
            
            .info-label {
                font-size: 0.85rem;
            }
            
            .client-info-value {
                font-size: 0.95rem;
            }
            
            p {
                margin-bottom: 0.5rem;
            }
            
            .btn {
                font-size: 0.85rem;
                padding: 0.3rem 0.6rem;
            }
            
            .view-badge {
                width: 28px;
                height: 28px;
                font-size: 0.8rem;
            }
        }
        
        /* Mejoras para accesibilidad */
        @media (prefers-reduced-motion: reduce) {
            * {
                transition: none !important;
                animation: none !important;
            }
        }
        
        /* Mejoras para alto contraste */
        @media (prefers-contrast: more) {
            .info-label {
                color: #000;
                font-weight: 700;
            }
            
            .card-title {
                color: #000;
            }
            
            .info-section {
                border: 1px solid #000;
            }
            
            .client-info-item {
                border: 1px solid #ccc;
            }
            
            a[href^="tel:"], a[href^="mailto:"] {
                text-decoration: underline;
            }
        }
        
        /* Animación para el badge */
        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(35, 83, 144, 0.4);
            }
            70% {
                transform: scale(1.05);
                box-shadow: 0 0 0 10px rgba(35, 83, 144, 0);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(35, 83, 144, 0);
            }
        }
        
        @media (prefers-reduced-motion: reduce) {
            .view-badge {
                animation: none;
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
                            <h2 class="card-title mb-3 mb-md-4">
                                <i class="bi bi-person-vcard me-2 d-none d-sm-inline-block"></i>Detalles del Cliente
                            </h2>
                            
                            <div class="action-buttons mb-3 mb-md-4">
                                <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-1"></i> Volver
                                </a>
                                <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-outline-primary">
                                    <i class="bi bi-pencil me-1"></i> Editar
                                </a>
                            </div>
                            
                            <div class="info-section">
                                <h5>
                                    <i class="bi bi-person-fill"></i>Información Personal
                                </h5>
                                
                                <!-- Versión para pantallas medianas y grandes -->
                                <div class="d-none d-md-block">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <p><span class="info-label">Nombre:</span> <span class="client-info-value">{{ $cliente->nombre }}</span></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><span class="info-label">Apellidos:</span> <span class="client-info-value">{{ $cliente->apellidos }}</span></p>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <p><span class="info-label">DNI:</span> <span class="client-info-value">{{ $cliente->dni ?? 'No especificado' }}</span></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                <span class="info-label">Teléfono:</span> 
                                                <a href="tel:{{ $cliente->telefono }}" class="client-info-value">{{ $cliente->telefono }}</a>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <p>
                                            <span class="info-label">Email:</span> 
                                            <a href="mailto:{{ $cliente->email }}" class="client-info-value">{{ $cliente->email }}</a>
                                        </p>
                                    </div>
                                    
                                    <div class="mb-0">
                                        <p><span class="info-label">Dirección:</span> <span class="client-info-value">{{ $cliente->direccion ?? 'No especificada' }}</span></p>
                                    </div>
                                </div>
                                
                                <!-- Versión para móviles -->
                                <div class="d-md-none">
                                    <div class="client-info-item">
                                        <p>
                                            <span class="info-label">Nombre</span>
                                            <span class="client-info-value">{{ $cliente->nombre }}</span>
                                        </p>
                                    </div>
                                    
                                    <div class="client-info-item">
                                        <p>
                                            <span class="info-label">Apellidos</span>
                                            <span class="client-info-value">{{ $cliente->apellidos }}</span>
                                        </p>
                                    </div>
                                    
                                    <div class="client-info-item">
                                        <p>
                                            <span class="info-label">DNI</span>
                                            <span class="client-info-value">{{ $cliente->dni ?? 'No especificado' }}</span>
                                        </p>
                                    </div>
                                    
                                    <div class="client-info-item">
                                        <p>
                                            <span class="info-label">Teléfono</span>
                                            <a href="tel:{{ $cliente->telefono }}" class="client-info-value">{{ $cliente->telefono }}</a>
                                        </p>
                                    </div>
                                    
                                    <div class="client-info-item">
                                        <p>
                                            <span class="info-label">Email</span>
                                            <a href="mailto:{{ $cliente->email }}" class="client-info-value">{{ $cliente->email }}</a>
                                        </p>
                                    </div>
                                    
                                    <div class="client-info-item">
                                        <p>
                                            <span class="info-label">Dirección</span>
                                            <span class="client-info-value">{{ $cliente->direccion ?? 'No especificada' }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            @if($cliente->cif || $cliente->direccion_juridica)
                                <div class="info-section mb-0">
                                    <h5>
                                        <i class="bi bi-building"></i>Información Jurídica
                                    </h5>
                                    
                                    <!-- Versión para pantallas medianas y grandes -->
                                    <div class="d-none d-md-block">
                                        <div class="row mb-0">
                                            <div class="col-md-6">
                                                <p><span class="info-label">CIF:</span> <span class="client-info-value">{{ $cliente->cif ?? 'No especificado' }}</span></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><span class="info-label">Dirección Jurídica:</span> <span class="client-info-value">{{ $cliente->direccion_juridica ?? 'No especificada' }}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Versión para móviles -->
                                    <div class="d-md-none">
                                        <div class="client-info-item">
                                            <p>
                                                <span class="info-label">CIF</span>
                                                <span class="client-info-value">{{ $cliente->cif ?? 'No especificado' }}</span>
                                            </p>
                                        </div>
                                        
                                        <div class="client-info-item">
                                            <p>
                                                <span class="info-label">Dirección Jurídica</span>
                                                <span class="client-info-value">{{ $cliente->direccion_juridica ?? 'No especificada' }}</span>
                                            </p>
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
    
    <script>
        // Script para mejorar la experiencia en dispositivos móviles
        document.addEventListener('DOMContentLoaded', function() {
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
            
            // Mejorar la experiencia táctil
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
                
                // Mejorar la experiencia con los elementos de información
                const infoItems = document.querySelectorAll('.client-info-item');
                infoItems.forEach(item => {
                    item.addEventListener('touchstart', function() {
                        this.style.backgroundColor = '#f8f9fa';
                    });
                    
                    item.addEventListener('touchend', function() {
                        this.style.backgroundColor = 'white';
                    });
                });
            }
            
            // Añadir soporte para compartir en dispositivos móviles
            if (navigator.share) {
                // Crear botón de compartir
                const shareButton = document.createElement('a');
                shareButton.className = 'btn btn-outline-primary';
                shareButton.innerHTML = '<i class="bi bi-share me-1"></i> Compartir';
                
                // Añadir evento de compartir
                shareButton.addEventListener('click', async () => {
                    try {
                        await navigator.share({
                            title: 'Detalles del Cliente',
                            text: `${document.querySelector('.card-title').textContent.trim()} - ${document.querySelector('.client-info-value').textContent.trim()}`,
                            url: window.location.href
                        });
                    } catch (err) {
                        console.error('Error al compartir:', err);
                    }
                });
                
                // Añadir botón al contenedor de acciones
                const actionButtons = document.querySelector('.action-buttons');
                if (actionButtons) {
                    actionButtons.appendChild(shareButton);
                }
            }
        });
    </script>
</body>
</html>