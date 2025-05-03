@extends('layouts.app')

@section('title', config('app.name', 'MiraCar') . ' - Soporte')

@section('content')
<div class="container py-3 py-md-4">
    <h1 class="mb-3 mb-md-4 text-center text-md-start">Solicitudes de Soporte</h1>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="d-flex justify-content-center justify-content-md-end mb-3">
        <a href="{{ route('soporte.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Nueva Solicitud
        </a>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-body p-2 p-md-4">
            <!-- Vista de tabla para pantallas medianas y grandes -->
            <div class="table-responsive d-none d-md-block">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Asunto</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($soportes as $soporte)
                            <tr>
                                <td>{{ $soporte->id }}</td>
                                <td>{{ $soporte->email }}</td>
                                <td>{{ $soporte->asunto }}</td>
                                <td>
                                    <span class="badge estado-{{ strtolower(str_replace(' ', '-', $soporte->estado)) }}">
                                        {{ $soporte->estado }}
                                    </span>
                                </td>
                                <td>{{ $soporte->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('soporte.show', $soporte->id) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('soporte.edit', $soporte->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('soporte.destroy', $soporte->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta solicitud?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No hay solicitudes de soporte registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Vista de tarjetas para dispositivos móviles -->
            <div class="d-md-none">
                @forelse($soportes as $soporte)
                    <div class="card mb-3 soporte-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span class="fw-bold">#{{ $soporte->id }}</span>
                            <span class="badge estado-{{ strtolower(str_replace(' ', '-', $soporte->estado)) }}">
                                {{ $soporte->estado }}
                            </span>
                        </div>
                        <div class="card-body py-2">
                            <h5 class="card-title text-truncate">{{ $soporte->asunto }}</h5>
                            <p class="card-text small mb-1">
                                <i class="bi bi-envelope me-1"></i> {{ $soporte->email }}
                            </p>
                            <p class="card-text small text-muted">
                                <i class="bi bi-calendar-event me-1"></i> {{ $soporte->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                        <div class="card-footer p-2">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('soporte.show', $soporte->id) }}" class="btn btn-sm btn-info flex-grow-1 me-1">
                                    <i class="bi bi-eye me-1"></i> Ver
                                </a>
                                <a href="{{ route('soporte.edit', $soporte->id) }}" class="btn btn-sm btn-primary flex-grow-1 me-1">
                                    <i class="bi bi-pencil me-1"></i> Editar
                                </a>
                                <button type="button" class="btn btn-sm btn-danger flex-grow-1 delete-btn" data-id="{{ $soporte->id }}">
                                    <i class="bi bi-trash me-1"></i> Eliminar
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info text-center">
                        No hay solicitudes de soporte registradas.
                    </div>
                @endforelse
                
                <!-- Formularios de eliminación ocultos para móviles -->
                @foreach($soportes as $soporte)
                    <form id="delete-form-{{ $soporte->id }}" action="{{ route('soporte.destroy', $soporte->id) }}" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                @endforeach
            </div>
            
            <div class="mt-4 d-flex justify-content-center">
                {{ $soportes->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilos base */
    .card {
        border: none;
        border-radius: 0.75rem;
        overflow: hidden;
    }
    
    .btn-primary {
        background-color: #235390;
        border-color: #235390;
    }
    
    .btn-primary:hover {
        background-color: #1a4070;
        border-color: #1a4070;
    }
    
    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: white;
    }
    
    .btn-info:hover {
        background-color: #138496;
        border-color: #138496;
        color: white;
    }
    
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
    
    .btn-danger:hover {
        background-color: #c82333;
        border-color: #c82333;
    }
    
    /* Estilos para las insignias de estado */
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
    
    /* Estilos para tarjetas en móvil */
    .soporte-card {
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }
    
    .soporte-card:hover, .soporte-card:focus {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .soporte-card .card-header {
        background-color: #f8f9fa;
        padding: 0.75rem 1rem;
    }
    
    .soporte-card .card-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #eee;
    }
    
    /* Estilos responsivos */
    @media (max-width: 767.98px) {
        h1 {
            font-size: 1.75rem;
        }
        
        .badge {
            font-size: 0.75rem;
            padding: 0.4em 0.65em;
        }
        
        .soporte-card .card-title {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }
        
        .btn-sm {
            padding: 0.4rem 0.6rem;
            font-size: 0.8rem;
        }
        
        .alert {
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
        }
        
        .pagination {
            font-size: 0.9rem;
        }
        
        .pagination .page-link {
            padding: 0.4rem 0.75rem;
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
        
        .btn {
            padding: 0.375rem 0.75rem;
        }
        
        .soporte-card {
            margin-left: -0.25rem;
            margin-right: -0.25rem;
            border-radius: 0.5rem;
        }
        
        .soporte-card .card-body {
            padding: 0.75rem 1rem;
        }
        
        .pagination .page-link {
            padding: 0.3rem 0.6rem;
        }
    }
    
    /* Mejoras para tablets */
    @media (min-width: 768px) and (max-width: 991.98px) {
        .table th, .table td {
            padding: 0.75rem 0.5rem;
        }
        
        .btn-group .btn {
            padding: 0.25rem 0.4rem;
        }
    }
    
    /* Optimización para dispositivos táctiles */
    @media (hover: none) and (pointer: coarse) {
        .btn {
            padding-top: 0.625rem;
            padding-bottom: 0.625rem;
            touch-action: manipulation;
        }
        
        .btn-sm {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        
        .soporte-card {
            margin-bottom: 1rem;
        }
        
        .soporte-card .card-footer .btn {
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .pagination .page-link {
            min-width: 40px;
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    }
    
    /* Mejoras para orientación landscape en móviles */
    @media (max-height: 500px) and (orientation: landscape) {
        .container {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        
        h1 {
            font-size: 1.5rem;
            margin-bottom: 0.75rem;
        }
        
        .soporte-card {
            margin-bottom: 0.5rem;
        }
        
        .soporte-card .card-body {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        
        .pagination {
            margin-top: 0.5rem !important;
        }
    }
    
    /* Mejoras de accesibilidad */
    .btn:focus, .page-link:focus {
        outline: 2px solid #4f8cff;
        outline-offset: 2px;
        box-shadow: none;
    }
    
    /* Animación para los botones */
    .btn {
        transition: transform 0.1s, background-color 0.2s;
    }
    
    .btn:active {
        transform: scale(0.98);
    }
    
    /* Mejoras para la tabla */
    .table {
        margin-bottom: 0;
    }
    
    .table th {
        background-color: #f8f9fa;
        border-bottom-width: 1px;
    }
    
    /* Mejoras para la paginación */
    .pagination {
        justify-content: center;
    }
    
    .page-item.active .page-link {
        background-color: #235390;
        border-color: #235390;
    }
    
    .page-link {
        color: #235390;
    }
    
    .page-link:hover {
        color: #1a4070;
    }
    
    /* Mejoras para las alertas */
    .alert {
        border-radius: 0.5rem;
        border: none;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }
    
    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }
    
    /* Mejoras para el botón de nueva solicitud */
    @media (max-width: 767.98px) {
        .btn-primary {
            padding: 0.625rem 1.25rem;
            border-radius: 2rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    }
    
    /* Mejoras para el hover en dispositivos no táctiles */
    @media (hover: hover) {
        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Manejar botones de eliminación en vista móvil
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            if (confirm('¿Estás seguro de que deseas eliminar esta solicitud?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    });
    
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
    
    // Mejorar la experiencia de desplazamiento en dispositivos táctiles
    const soporteCards = document.querySelectorAll('.soporte-card');
    let touchStartY = 0;
    
    soporteCards.forEach(card => {
        card.addEventListener('touchstart', function(e) {
            touchStartY = e.touches[0].clientY;
        }, { passive: true });
        
        card.addEventListener('touchmove', function(e) {
            const touchY = e.touches[0].clientY;
            const scrollUp = touchY > touchStartY;
            const scrollDown = touchY < touchStartY;
            const scrollingElement = document.scrollingElement || document.documentElement;
            
            // Si estamos en la parte superior y tratamos de desplazarnos hacia arriba
            if (scrollingElement.scrollTop === 0 && scrollUp) {
                e.preventDefault(); // Evitar el efecto de rebote
            }
            
            // Si estamos en la parte inferior y tratamos de desplazarnos hacia abajo
            if ((scrollingElement.scrollHeight - scrollingElement.scrollTop <= window.innerHeight) && scrollDown) {
                e.preventDefault(); // Evitar el efecto de rebote
            }
        }, { passive: false });
    });
    
    // Auto-ocultar alertas después de 5 segundos
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const closeButton = alert.querySelector('.btn-close');
            if (closeButton) {
                closeButton.click();
            }
        }, 5000);
    });
});
</script>
@endsection