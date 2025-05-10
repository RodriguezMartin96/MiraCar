<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'MiraCar') }} - Recambios</title>
    
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
        
        .card-container {
            position: relative;
        }
        
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
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
                text-align: center;
            }
            
            .info-label {
                display: block;
                margin-bottom: 0.25rem;
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
            
            .action-buttons {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .info-item {
                text-align: center;
                margin-bottom: 1rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid #dee2e6;
            }
            
            .info-item:last-child {
                border-bottom: none;
                padding-bottom: 0;
                margin-bottom: 0;
            }
            
            .info-value {
                font-size: 1.1rem;
            }
            
            .view-badge {
                width: 30px;
                height: 30px;
                font-size: 0.9rem;
            }
        }
        
        @media (min-width: 768px) and (max-width: 991.98px) {
            .card-body {
                padding: 1.5rem !important;
            }
            
            .info-section {
                padding: 1.25rem;
            }
        }
        
        @media (hover: none) and (pointer: coarse) {
            .btn {
                padding-top: 0.625rem;
                padding-bottom: 0.625rem;
                touch-action: manipulation;
            }
        }
        
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
            
            .py-4 {
                padding-top: 0.5rem !important;
                padding-bottom: 0.5rem !important;
            }
            
            .mb-4 {
                margin-bottom: 0.75rem !important;
            }
            
            .info-section {
                padding: 0.75rem;
            }
        }
        
        @media (max-width: 375px) {
            .card-body {
                padding: 1rem !important;
            }
            
            .card-title {
                font-size: 1.25rem;
            }
            
            .info-section h5 {
                font-size: 1rem;
            }
            
            .info-value {
                font-size: 1rem;
            }
        }
        
        .btn {
            transition: all 0.2s ease;
        }
        
        .btn:active {
            transform: scale(0.97);
        }
        
        .btn:focus {
            outline: 2px solid var(--secondary-color);
            outline-offset: 2px;
        }
        
        .detail-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .detail-header i {
            font-size: 1.5rem;
            margin-right: 0.75rem;
            color: var(--primary-color);
        }
        
        @media (max-width: 767.98px) {
            .detail-header {
                flex-direction: column;
                text-align: center;
            }
            
            .detail-header i {
                margin-right: 0;
                margin-bottom: 0.5rem;
                font-size: 1.75rem;
            }
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        
        .info-card {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            text-align: center;
        }
        
        .info-card-icon {
            font-size: 1.75rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .info-card-label {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }
        
        .info-card-value {
            font-size: 1.25rem;
            font-weight: 600;
            color: #333;
        }
        
        .description-section {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-top: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .description-section h5 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }
        
        .description-section h5 i {
            margin-right: 0.5rem;
        }
        
        .description-content {
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            padding: 1rem;
            white-space: pre-line;
        }
        
        @media (max-width: 767.98px) {
            .info-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .description-section {
                padding: 1rem;
                margin-top: 1rem;
            }
            
            .description-section h5 {
                font-size: 1.1rem;
                text-align: center;
                display: block;
            }
            
            .description-section h5 i {
                display: block;
                margin: 0 auto 0.5rem;
                font-size: 1.5rem;
            }
            
            .description-content {
                padding: 0.75rem;
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>
    @include('layouts.navigation')

    <div class="container py-3 py-md-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-7">
                <div class="card-container">
                    <div class="card">
                        <div class="view-badge d-flex">
                            <i class="bi bi-eye-fill"></i>
                        </div>
                        <div class="card-body">
                            <div class="detail-header">
                                <i class="bi bi-info-circle-fill d-none d-sm-inline-block"></i>
                                <h2 class="card-title mb-0">Detalles del Recambio</h2>
                            </div>
                            
                            <div class="mb-4 action-buttons">
                                <a href="{{ route('recambios.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-1"></i> Volver
                                </a>
                                <a href="{{ route('recambios.edit', $recambio) }}" class="btn btn-outline-primary ms-md-2">
                                    <i class="bi bi-pencil me-1"></i> Editar
                                </a>
                            </div>
                            
                            <div class="info-section">
                                <h5 class="text-center">
                                    <i class="bi bi-box-seam me-2 d-none d-sm-inline-block"></i>Información del Producto
                                </h5>
                                
                                <div class="d-md-none">
                                    <div class="info-item">
                                        <div class="info-label">Producto</div>
                                        <div class="info-value">{{ $recambio->producto }}</div>
                                    </div>
                                    
                                    <div class="info-item">
                                        <div class="info-label">Cantidad</div>
                                        <div class="info-value">{{ $recambio->cantidad }}</div>
                                    </div>
                                    
                                    <div class="info-item">
                                        <div class="info-label">Referencia</div>
                                        <div class="info-value">{{ $recambio->referencia ?? 'No especificada' }}</div>
                                    </div>
                                    
                                    <div class="info-item">
                                        <div class="info-label">Precio</div>
                                        <div class="info-value">{{ $recambio->precio ? number_format($recambio->precio, 2) . ' €' : 'No especificado' }}</div>
                                    </div>
                                </div>
                                
                                <div class="d-none d-md-block">
                                    <div class="info-grid">
                                        <div class="info-card">
                                            <div class="info-card-icon">
                                                <i class="bi bi-box-seam"></i>
                                            </div>
                                            <div class="info-card-label">Producto</div>
                                            <div class="info-card-value">{{ $recambio->producto }}</div>
                                        </div>
                                        
                                        <div class="info-card">
                                            <div class="info-card-icon">
                                                <i class="bi bi-123"></i>
                                            </div>
                                            <div class="info-card-label">Cantidad</div>
                                            <div class="info-card-value">{{ $recambio->cantidad }}</div>
                                        </div>
                                        
                                        <div class="info-card">
                                            <div class="info-card-icon">
                                                <i class="bi bi-upc"></i>
                                            </div>
                                            <div class="info-card-label">Referencia</div>
                                            <div class="info-card-value">{{ $recambio->referencia ?? 'No especificada' }}</div>
                                        </div>
                                        
                                        <div class="info-card">
                                            <div class="info-card-icon">
                                                <i class="bi bi-currency-euro"></i>
                                            </div>
                                            <div class="info-card-label">Precio</div>
                                            <div class="info-card-value">{{ $recambio->precio ? number_format($recambio->precio, 2) . ' €' : 'No especificado' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @if($recambio->descripcion)
                                <div class="description-section">
                                    <h5>
                                        <i class="bi bi-card-text d-none d-sm-inline-block"></i>Descripción
                                    </h5>
                                    <div class="description-content">
                                        {{ $recambio->descripcion }}
                                    </div>
                                </div>
                            @endif
                            
                            <div class="d-md-none mt-4">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('recambios.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-1"></i> Volver a la lista
                                    </a>
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
                        this.style.opacity = '0.7';
                    });
                    
                    button.addEventListener('touchend', function() {
                        this.style.opacity = '1';
                    });
                });
                
                function adjustForLandscape() {
                    if (window.innerHeight < 500 && window.innerWidth > window.innerHeight) {
                        document.body.classList.add('landscape-mode');
                    } else {
                        document.body.classList.remove('landscape-mode');
                    }
                }
                
                adjustForLandscape();
                window.addEventListener('resize', adjustForLandscape);
                window.addEventListener('orientationchange', adjustForLandscape);
            }
        });
    </script>
</body>
</html>