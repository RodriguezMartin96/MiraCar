@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body p-0">
                    <!-- Contenido de confirmación -->
                    <div class="p-5 text-center">
                        <div class="mb-4">
                            <i class="bi bi-check-circle-fill success-icon" style="font-size: 5rem; color: #198754;"></i>
                        </div>
                        
                        <h2 class="card-title mb-3">¡Solicitud Enviada!</h2>
                        
                        <p class="mb-4">Tu solicitud de soporte ha sido enviada correctamente. Nos pondremos en contacto contigo lo antes posible.</p>
                        
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('dashboard') }}" class="btn btn-primary me-2">
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
</style>
@endsection