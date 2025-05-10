@extends('layouts.app')

@section('title', config('app.name', 'MiraCar') . ' - Soporte')

@section('content')
<div class="container py-3 py-md-4">
<h1 class="mb-3 mb-md-4 text-center text-md-start">Detalles de Solicitud</h1>

<div class="card shadow-sm mb-4">
    <div class="card-header p-3 p-md-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
            <h5 class="card-title mb-2 mb-md-0">{{ $soporte->asunto }}</h5>
            <span class="badge estado-{{ strtolower(str_replace(' ', '-', $soporte->estado)) }} align-self-start align-self-md-center">
                {{ $soporte->estado }}
            </span>
        </div>
    </div>
    
    <div class="card-body p-3 p-md-4">
        <div class="d-md-none">
            <div class="info-item mb-3">
                <div class="info-label">
                    <i class="bi bi-envelope me-2"></i>Email
                </div>
                <div class="info-value">{{ $soporte->email }}</div>
            </div>
            
            <div class="info-item mb-3">
                <div class="info-label">
                    <i class="bi bi-calendar-plus me-2"></i>Fecha de creación
                </div>
                <div class="info-value">{{ $soporte->created_at->format('d/m/Y H:i') }}</div>
            </div>
            
            <div class="info-item mb-4">
                <div class="info-label">
                    <i class="bi bi-calendar-check me-2"></i>Última actualización
                </div>
                <div class="info-value">{{ $soporte->updated_at->format('d/m/Y H:i') }}</div>
            </div>
            
            <div class="description-section mb-4">
                <h5 class="section-title">
                    <i class="bi bi-chat-text me-2"></i>Descripción
                </h5>
                <div class="content-box">
                    {{ $soporte->descripcion }}
                </div>
            </div>
            
            @if($soporte->respuesta)
                <div class="response-section mb-3">
                    <h5 class="section-title">
                        <i class="bi bi-reply me-2"></i>Respuesta
                    </h5>
                    <div class="content-box">
                        {{ $soporte->respuesta }}
                    </div>
                </div>
            @endif
        </div>
        
        <div class="d-none d-md-block">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong><i class="bi bi-envelope me-2"></i>Email:</strong> {{ $soporte->email }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong><i class="bi bi-flag me-2"></i>Estado:</strong> 
                        <span class="badge estado-{{ strtolower(str_replace(' ', '-', $soporte->estado)) }}">
                            {{ $soporte->estado }}
                        </span>
                    </p>
                </div>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong><i class="bi bi-calendar-plus me-2"></i>Fecha de creación:</strong> {{ $soporte->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong><i class="bi bi-calendar-check me-2"></i>Última actualización:</strong> {{ $soporte->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
            
            <div class="mb-4">
                <h5><i class="bi bi-chat-text me-2"></i>Descripción:</h5>
                <div class="p-3 bg-light rounded">
                    {{ $soporte->descripcion }}
                </div>
            </div>
            
            @if($soporte->respuesta)
                <div class="mb-4">
                    <h5><i class="bi bi-reply me-2"></i>Respuesta:</h5>
                    <div class="p-3 bg-light rounded">
                        {{ $soporte->respuesta }}
                    </div>
                </div>
            @endif
        </div>
    </div>
    
    <div class="card-footer p-3 p-md-4">
        <div class="d-md-none">
            <div class="d-grid gap-2 mb-3">
                <a href="{{ route('soporte.edit', $soporte->id) }}" class="btn btn-primary">
                    <i class="bi bi-pencil me-2"></i> Editar solicitud
                </a>
            </div>
            <div class="d-grid gap-2 mb-3">
                <button type="button" class="btn btn-danger" id="deleteBtn">
                    <i class="bi bi-trash me-2"></i> Eliminar solicitud
                </button>
            </div>
            <div class="d-grid gap-2">
                <a href="{{ route('soporte.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i> Volver al listado
                </a>
            </div>
            
            <form id="deleteForm" action="{{ route('soporte.destroy', $soporte->id) }}" method="POST" class="d-none">
                @csrf
                @method('DELETE')
            </form>
        </div>
        
        <div class="d-none d-md-flex justify-content-between">
            <a href="{{ route('soporte.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
            <div>
                <a href="{{ route('soporte.edit', $soporte->id) }}" class="btn btn-primary me-2">
                    <i class="bi bi-pencil me-1"></i> Editar
                </a>
                <form action="{{ route('soporte.destroy', $soporte->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta solicitud?')">
                        <i class="bi bi-trash me-1"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<style>
.card {
    border: none;
    border-radius: 1rem;
    overflow: hidden;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #eee;
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

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-danger:hover {
    background-color: #c82333;
    border-color: #c82333;
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

.info-item {
    padding-bottom: 0.75rem;
    border-bottom: 1px solid #eee;
}

.info-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.25rem;
    font-size: 0.9rem;
}

.info-value {
    font-size: 1rem;
}

.section-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: #343a40;
    display: flex;
    align-items: center;
}

.content-box {
    background-color: #f8f9fa;
    border-radius: 0.5rem;
    padding: 1rem;
    font-size: 0.95rem;
    line-height: 1.5;
    border-left: 3px solid #235390;
}

.response-section .content-box {
    border-left: 3px solid #28a745;
}

@media (max-width: 767.98px) {
    h1 {
        font-size: 1.75rem;
    }
    
    .card-title {
        font-size: 1.25rem;
        line-height: 1.3;
    }
    
    .badge {
        font-size: 0.8rem;
        padding: 0.5em 0.75em;
        margin-top: 0.5rem;
    }
    
    .btn {
        padding: 0.625rem 1rem;
    }
    
    .content-box {
        padding: 0.875rem;
    }
}

@media (max-width: 575.98px) {
    h1 {
        font-size: 1.5rem;
    }
    
    .container {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }
    
    .card-title {
        font-size: 1.15rem;
    }
    
    .section-title {
        font-size: 1rem;
    }
    
    .info-label {
        font-size: 0.85rem;
    }
    
    .info-value {
        font-size: 0.95rem;
    }
    
    .content-box {
        font-size: 0.9rem;
        padding: 0.75rem;
    }
}

@media (min-width: 768px) and (max-width: 991.98px) {
    .card-title {
        font-size: 1.35rem;
    }
    
    .badge {
        font-size: 0.85rem;
    }
    
    .btn {
        padding: 0.5rem 1rem;
    }
}

@media (hover: none) and (pointer: coarse) {
    .btn {
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        touch-action: manipulation;
    }
    
    .btn:active {
        transform: scale(0.98);
        transition: transform 0.1s;
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
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }
    
    .info-item {
        margin-bottom: 0.5rem;
        padding-bottom: 0.5rem;
    }
    
    .content-box {
        padding: 0.75rem;
        margin-bottom: 0.75rem;
    }
    
    .btn {
        padding: 0.5rem 0.75rem;
    }
}

.btn:focus {
    outline: 2px solid #4f8cff;
    outline-offset: 2px;
    box-shadow: none;
}

.btn {
    transition: transform 0.1s, background-color 0.2s;
}

.btn:active {
    transform: scale(0.98);
}

@media (max-width: 767.98px) {
    .container {
        max-width: 100%;
    }
}

.description-section .content-box {
    white-space: pre-line;
}

@media (max-width: 767.98px) {
    .info-item:last-child {
        border-bottom: none;
    }
    
    .badge {
        border-radius: 2rem;
        padding: 0.5em 1em;
    }
}

@media (max-width: 767.98px) {
    .btn {
        border-radius: 0.5rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn i {
        margin-right: 0.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteBtn = document.getElementById('deleteBtn');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            if (confirm('¿Estás seguro de que deseas eliminar esta solicitud?')) {
                document.getElementById('deleteForm').submit();
            }
        });
    }

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

    function adjustContentBoxHeight() {
        if (window.innerWidth >= 768) {
            const contentBoxes = document.querySelectorAll('.content-box');
            let maxHeight = 0;
            
            contentBoxes.forEach(box => {
                box.style.height = 'auto';
                const height = box.offsetHeight;
                if (height > maxHeight) {
                    maxHeight = height;
                }
            });
            
            if (contentBoxes.length > 1 && maxHeight > 0) {
                contentBoxes.forEach(box => {
                    box.style.minHeight = maxHeight + 'px';
                });
            }
        } else {
            const contentBoxes = document.querySelectorAll('.content-box');
            contentBoxes.forEach(box => {
                box.style.height = 'auto';
                box.style.minHeight = 'auto';
            });
        }
    }

    adjustContentBoxHeight();
    window.addEventListener('resize', adjustContentBoxHeight);
});
</script>
@endsection