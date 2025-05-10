@extends('layouts.app')

@section('title', config('app.name', 'MiraCar') . ' - Soporte')

@section('content')
<div class="container py-3 py-md-4">
    <h1 class="mb-3 mb-md-4 text-center text-md-start">Editar Solicitud de Soporte</h1>
    
    <form action="{{ route('soporte.update', $soporte->id) }}" method="POST" id="soporteForm">
        @csrf
        @method('PUT')
        
        <div class="card shadow-sm">
            <div class="card-body p-3 p-md-4">
                <div class="mb-3">
                    <label for="email" class="form-label">
                        <i class="bi bi-envelope-fill me-2 d-none d-sm-inline-block"></i>Email
                    </label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $soporte->email) }}" readonly>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="asunto" class="form-label">
                        <i class="bi bi-tag-fill me-2 d-none d-sm-inline-block"></i>Asunto
                    </label>
                    <input type="text" class="form-control @error('asunto') is-invalid @enderror" id="asunto" name="asunto" value="{{ old('asunto', $soporte->asunto) }}" required>
                    @error('asunto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="descripcion" class="form-label">
                        <i class="bi bi-chat-text-fill me-2 d-none d-sm-inline-block"></i>Descripción
                    </label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="5">{{ old('descripcion', $soporte->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="estado" class="form-label">
                        <i class="bi bi-flag-fill me-2 d-none d-sm-inline-block"></i>Estado
                    </label>
                    <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado">
                        <option value="Pendiente" {{ old('estado', $soporte->estado) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="En proceso" {{ old('estado', $soporte->estado) == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                        <option value="Resuelto" {{ old('estado', $soporte->estado) == 'Resuelto' ? 'selected' : '' }}>Resuelto</option>
                        <option value="Cerrado" {{ old('estado', $soporte->estado) == 'Cerrado' ? 'selected' : '' }}>Cerrado</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="respuesta" class="form-label">
                        <i class="bi bi-reply-fill me-2 d-none d-sm-inline-block"></i>Respuesta
                    </label>
                    <textarea class="form-control @error('respuesta') is-invalid @enderror" id="respuesta" name="respuesta" rows="5">{{ old('respuesta', $soporte->respuesta) }}</textarea>
                    @error('respuesta')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="estado-badge mb-4 d-flex justify-content-center d-md-none">
                    <span class="badge estado-{{ strtolower(str_replace(' ', '-', $soporte->estado)) }}">
                        {{ $soporte->estado }}
                    </span>
                </div>
            </div>
            
            <div class="card-footer p-3 p-md-4">
                <div class="d-flex flex-column flex-sm-row justify-content-between gap-2">
                    <a href="{{ route('soporte.index') }}" class="btn btn-secondary order-1 order-sm-0 mb-2 mb-sm-0">
                        <i class="bi bi-arrow-left me-1"></i> Volver
                    </a>
                    <button type="submit" class="btn btn-primary order-0 order-sm-1">
                        <i class="bi bi-check-circle me-1"></i> Actualizar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    .card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    
    .card-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #eee;
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
    
    .estado-badge .badge {
        font-size: 1rem;
        padding: 0.5rem 1.5rem;
        border-radius: 2rem;
    }
    
    .estado-pendiente {
        background-color: #ffc107;
        color: #212529;
    }
    
    .estado-en-proceso {
        background-color: #17a2b8;
        color: white;
    }
    
    .estado-resuelto {
        background-color: #28a745;
        color: white;
    }
    
    .estado-cerrado {
        background-color: #6c757d;
        color: white;
    }
    
    @media (max-width: 767.98px) {
        h1 {
            font-size: 1.75rem;
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
        
        .form-control, .form-select {
            font-size: 1rem;
        }
        
        .estado-badge .badge {
            font-size: 0.9rem;
            padding: 0.4rem 1.25rem;
        }
    }
    
    @media (max-width: 575.98px) {
        h1 {
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
        
        .form-control, .form-select {
            padding: 0.5rem 0.75rem;
        }
        
        .estado-badge .badge {
            font-size: 0.85rem;
            padding: 0.35rem 1rem;
        }
    }
    
    @media (min-width: 768px) and (max-width: 991.98px) {
        h1 {
            font-size: 1.85rem;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .form-control, .form-select {
            font-size: 1rem;
        }
    }
    
    @media (hover: none) and (pointer: coarse) {
        .btn {
            padding-top: 0.625rem;
            padding-bottom: 0.625rem;
            touch-action: manipulation;
        }
        
        .form-control, .form-select {
            font-size: 16px;
        }
        
        textarea.form-control {
            padding: 0.75rem;
        }
        
        .btn:active {
            transform: scale(0.98);
            transition: transform 0.1s;
        }
        
        .form-select {
            background-position: right 0.75rem center;
        }
    }
    
    @media (max-height: 500px) and (orientation: landscape) {
        .container {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        
        h1 {
            font-size: 1.5rem;
            margin-bottom: 0.75rem;
        }
        
        .card-body {
            padding: 1rem;
        }
        
        textarea.form-control {
            rows: 3;
        }
        
        .mb-3 {
            margin-bottom: 0.5rem !important;
        }
        
        .mb-4 {
            margin-bottom: 0.75rem !important;
        }
    }
    
    .form-control:focus, .form-select:focus, .btn:focus {
        outline: 2px solid #4f8cff;
        outline-offset: 2px;
        box-shadow: none;
    }
    
    .form-control, .form-select {
        border-radius: 0.5rem;
        padding: 0.625rem 0.75rem;
        border: 1px solid #ced4da;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #235390;
    }
    
    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 0.5rem;
    }
    
    .form-control[readonly] {
        background-color: #f8f9fa;
        opacity: 0.8;
    }
    
    @media (max-width: 767.98px) {
        .container {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }
    }
    
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
    
    @media (max-width: 767.98px) {
        textarea.form-control {
            min-height: 100px;
        }
    }
    
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
    
    .form-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
    }
    
    #estado {
        transition: background-color 0.3s ease;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function adjustTextareaHeight() {
        const textareas = document.querySelectorAll('textarea.form-control');
        if (window.innerHeight < 500 && window.innerWidth > window.innerHeight) {
            textareas.forEach(textarea => {
                textarea.setAttribute('rows', '3');
            });
        } else {
            textareas.forEach(textarea => {
                textarea.setAttribute('rows', '5');
            });
        }
    }
    
    adjustTextareaHeight();
    window.addEventListener('resize', adjustTextareaHeight);
    window.addEventListener('orientationchange', adjustTextareaHeight);
    
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
    
    const estadoSelect = document.getElementById('estado');
    const estadoBadge = document.querySelector('.estado-badge .badge');
    
    if (estadoSelect && estadoBadge) {
        estadoSelect.addEventListener('change', function() {
            estadoBadge.classList.remove('estado-pendiente', 'estado-en-proceso', 'estado-resuelto', 'estado-cerrado');
            
            const estadoValue = this.value.toLowerCase().replace(' ', '-');
            estadoBadge.classList.add('estado-' + estadoValue);
            
            estadoBadge.textContent = this.value;
        });
    }
    
    const form = document.getElementById('soporteForm');
    form.addEventListener('submit', function(event) {
        let isValid = true;
        
        const asunto = document.getElementById('asunto');
        if (asunto.value.trim() === '') {
            asunto.classList.add('is-invalid');
            isValid = false;
        } else {
            asunto.classList.remove('is-invalid');
        }
        
        if (!isValid) {
            event.preventDefault();
        }
    });
});
</script>
@endsection