@extends('layouts.app')

@section('title', config('app.name', 'MiraCar') . ' - Soporte')

@section('content')
<div class="container py-3 py-md-4">
    <div class="card shadow-sm">
        <div class="card-body p-3 p-md-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 mb-md-4">
                <h2 class="card-title mb-3 mb-md-0">
                    <i class="bi bi-headset me-2 d-none d-sm-inline-block"></i>Solicitud de Soporte
                </h2>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('soporte.store') }}" method="POST" id="soporteForm">
                @csrf
                
                <div class="mb-3">
                    <label for="asunto" class="form-label">
                        <i class="bi bi-tag-fill me-2 d-none d-sm-inline-block"></i>Asunto:
                    </label>
                    <input type="text" class="form-control @error('asunto') is-invalid @enderror" id="asunto" name="asunto" value="{{ old('asunto') }}" required placeholder="Escribe un asunto">
                    @error('asunto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="descripcion" class="form-label">
                        <i class="bi bi-chat-text-fill me-2 d-none d-sm-inline-block"></i>Descripción:
                    </label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="5" required placeholder="Describe tu problema o consulta">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text mt-2 d-none d-sm-block">
                        <i class="bi bi-info-circle me-1"></i> Proporciona todos los detalles posibles para que podamos ayudarte mejor.
                    </div>
                </div>
                
                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary order-1 order-sm-0 mb-2 mb-sm-0" onclick="limpiarFormulario()">
                        <i class="bi bi-x-circle me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary order-0 order-sm-1">
                        <i class="bi bi-send me-1"></i> Enviar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Estilos base */
    .card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    
    .card-title {
        color: #235390;
        font-weight: 600;
    }
    
    .btn-primary {
        background-color: #235390;
        border-color: #235390;
    }
    
    .btn-primary:hover {
        background-color: #1a4070;
        border-color: #1a4070;
    }
    
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
    
    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #5a6268;
    }
    
    /* Estilos responsivos */
    @media (max-width: 767.98px) {
        .card-title {
            font-size: 1.5rem;
            text-align: center;
        }
        
        .card-body {
            padding: 1.25rem;
        }
        
        .btn {
            width: 100%;
            padding: 0.625rem 1rem;
        }
        
        .form-label {
            font-size: 0.95rem;
        }
    }
    
    @media (max-width: 575.98px) {
        .card-title {
            font-size: 1.5rem;
        }
        
        .card-body {
            padding: 1rem;
        }
        
        .mb-3 {
            margin-bottom: 0.75rem !important;
        }
        
        .mb-4 {
            margin-bottom: 1rem !important;
        }
    }
    
    /* Mejoras para tablets */
    @media (min-width: 768px) and (max-width: 991.98px) {
        .card-title {
            font-size: 1.5rem;
        }
        
        .card-body {
            padding: 1.5rem;
        }
    }
    
    /* Optimización para dispositivos táctiles */
    @media (hover: none) and (pointer: coarse) {
        .btn {
            padding-top: 0.625rem;
            padding-bottom: 0.625rem;
            touch-action: manipulation;
        }
        
        .form-control {
            font-size: 16px; /* Evita zoom en iOS */
        }
        
        textarea.form-control {
            padding: 0.75rem;
        }
        
        .btn:active {
            transform: scale(0.98);
            transition: transform 0.1s;
        }
    }
    
    /* Mejoras para orientación landscape en móviles */
    @media (max-height: 500px) and (orientation: landscape) {
        .container {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        
        .card-title {
            font-size: 1.5rem;
            margin-bottom: 0.75rem;
        }
        
        .card-body {
            padding: 1rem;
        }
        
        textarea.form-control {
            rows: 3;
        }
    }
    
    /* Mejoras de accesibilidad */
    .form-control:focus, .btn:focus {
        outline: 2px solid #4f8cff;
        outline-offset: 2px;
        box-shadow: none;
    }
    
    /* Mejoras para el formulario */
    .form-control {
        border-radius: 0.5rem;
        padding: 0.625rem 0.75rem;
        border: 1px solid #ced4da;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    
    .form-control:focus {
        border-color: #235390;
    }
    
    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 0.5rem;
    }
    
    /* Mejoras para el contenedor */
    @media (max-width: 767.98px) {
        .container {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }
    }
    
    /* Mejoras para los botones en dispositivos táctiles */
    @media (hover: none) {
        .btn {
            transition: background-color 0.2s, transform 0.1s;
        }
        
        .btn-primary:active {
            background-color: #1a4070;
        }
        
        .btn-secondary:active {
            background-color: #5a6268;
        }
    }
    
    /* Mejoras para el textarea en móviles */
    @media (max-width: 767.98px) {
        textarea.form-control {
            min-height: 120px;
        }
    }
    
    /* Animación para el botón de enviar */
    .btn-primary {
        position: relative;
        overflow: hidden;
    }
    
    .btn-primary:after {
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
    
    .btn-primary:focus:not(:active)::after {
        animation: ripple 1s ease-out;
    }
    
    @keyframes ripple {
        0% {
            transform: scale(0, 0);
            opacity: 0.5;
        }
        20% {
            transform: scale(25, 25);
            opacity: 0.3;
        }
        100% {
            opacity: 0;
            transform: scale(40, 40);
        }
    }
    
    /* Mejoras para alertas */
    .alert {
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        margin-bottom: 1.5rem;
        border: none;
    }
    
    @media (max-width: 767.98px) {
        .alert {
            padding: 0.625rem 0.875rem;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }
    }
</style>

<script>
function limpiarFormulario() {
    document.getElementById('asunto').value = '';
    document.getElementById('descripcion').value = '';
    
    // Eliminar clases de validación
    document.getElementById('asunto').classList.remove('is-invalid');
    document.getElementById('descripcion').classList.remove('is-invalid');
    
    // Enfocar el primer campo
    document.getElementById('asunto').focus();
}

// Script para mejorar la experiencia en dispositivos móviles
document.addEventListener('DOMContentLoaded', function() {
    // Ajustar altura del textarea en orientación landscape
    function adjustTextareaHeight() {
        const textarea = document.getElementById('descripcion');
        if (window.innerHeight < 500 && window.innerWidth > window.innerHeight) {
            textarea.setAttribute('rows', '3');
        } else {
            textarea.setAttribute('rows', '5');
        }
    }
    
    // Ejecutar al cargar y al cambiar orientación
    adjustTextareaHeight();
    window.addEventListener('resize', adjustTextareaHeight);
    window.addEventListener('orientationchange', adjustTextareaHeight);
    
    // Detectar si es un dispositivo táctil
    if ('ontouchstart' in window) {
        // Mejorar la experiencia táctil para los botones
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('touchstart', function() {
                this.style.opacity = '0.8';
            });
            
            button.addEventListener('touchend', function() {
                this.style.opacity = '1';
            });
        });
        
        // Añadir clase para dispositivos táctiles
        document.body.classList.add('touch-device');
    }
    
    // Validación del formulario
    const form = document.getElementById('soporteForm');
    form.addEventListener('submit', function(event) {
        let isValid = true;
        
        // Validar asunto
        const asunto = document.getElementById('asunto');
        if (asunto.value.trim() === '') {
            asunto.classList.add('is-invalid');
            isValid = false;
        } else {
            asunto.classList.remove('is-invalid');
        }
        
        // Validar descripción
        const descripcion = document.getElementById('descripcion');
        if (descripcion.value.trim() === '') {
            descripcion.classList.add('is-invalid');
            isValid = false;
        } else {
            descripcion.classList.remove('is-invalid');
        }
        
        if (!isValid) {
            event.preventDefault();
        }
    });
});
</script>
@endsection