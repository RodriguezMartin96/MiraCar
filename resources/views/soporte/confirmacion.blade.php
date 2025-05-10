@extends('layouts.app')

@section('title', config('app.name', 'MiraCar') . ' - Soporte')

@section('content')
<div class="container py-3 py-md-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card">
                <div class="card-body p-0">
                    <div class="p-3 p-sm-4 p-md-5 text-center">
                        <div class="mb-3 mb-md-4">
                            <i class="bi bi-check-circle-fill success-icon"></i>
                        </div>
                        
                        <h2 class="card-title mb-2 mb-md-3">¡Solicitud Enviada!</h2>
                        
                        <p class="mb-3 mb-md-4">Tu solicitud de soporte ha sido enviada correctamente. Nos pondremos en contacto contigo lo antes posible.</p>
                        
                        <div class="d-flex flex-column flex-sm-row justify-content-center">
                            <a href="{{ route('dashboard') }}" class="btn btn-primary mb-2 mb-sm-0 me-sm-2">
                                <i class="bi bi-house-door me-1"></i> Ir al Inicio
                            </a>
                            <a href="{{ route('soporte.create') }}" class="btn btn-outline-primary">
                                <i class="bi bi-plus-lg me-1"></i> Nueva Solicitud
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .success-icon {
        font-size: 5rem;
        color: #198754;
    }
    
    .nav-tabs .nav-link.active {
        color: white;
        background-color: #235390;
        border-color: #235390;
    }
    
    .nav-tabs .nav-link:hover:not(.active) {
        background-color: #f8f9fa;
        border-color: #e9ecef #e9ecef #dee2e6;
    }
    
    @media (max-width: 767.98px) {
        .success-icon {
            font-size: 4rem;
        }
        
        .card-title {
            font-size: 1.75rem;
        }
        
        .btn {
            width: 100%;
            padding: 0.625rem 1rem;
        }
    }
    
    @media (max-width: 575.98px) {
        .success-icon {
            font-size: 3.5rem;
        }
        
        .card-title {
            font-size: 1.5rem;
        }
        
        .p-3 {
            padding: 1rem !important;
        }
        
        .mb-3 {
            margin-bottom: 0.75rem !important;
        }
    }
    
    @media (min-width: 768px) and (max-width: 991.98px) {
        .success-icon {
            font-size: 4.5rem;
        }
        
        .card-title {
            font-size: 1.85rem;
        }
    }
    
    @media (hover: none) and (pointer: coarse) {
        .btn {
            padding-top: 0.625rem;
            padding-bottom: 0.625rem;
            touch-action: manipulation;
        }
        
        .btn:active {
            transform: scale(0.98);
            transition: transform 0.1s;
        }
    }
    
    @media (max-height: 500px) and (orientation: landscape) {
        .success-icon {
            font-size: 3rem;
            margin-bottom: 0.5rem;
        }
        
        .card-title {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .p-sm-4 {
            padding: 1rem !important;
        }
        
        .mb-3 {
            margin-bottom: 0.5rem !important;
        }
    }
    
    .success-icon {
        animation: scaleIn 0.5s ease-in-out;
    }
    
    @keyframes scaleIn {
        0% {
            transform: scale(0);
            opacity: 0;
        }
        60% {
            transform: scale(1.2);
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
    
    .btn:focus {
        outline: 2px solid #4f8cff;
        outline-offset: 2px;
    }
    
    .card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    
    @media (max-width: 767.98px) {
        .container {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }
    }
    
    p {
        color: #6c757d;
        line-height: 1.6;
    }
    
    @media (max-width: 575.98px) {
        p {
            font-size: 0.95rem;
        }
    }
    
    @media (hover: none) {
        .btn {
            transition: background-color 0.2s, transform 0.1s;
        }
        
        .btn-primary:active {
            background-color: #1a4070;
        }
        
        .btn-outline-primary:active {
            background-color: #e3ecff;
        }
    }
</style>

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
@endsection