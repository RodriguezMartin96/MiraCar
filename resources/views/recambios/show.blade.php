@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body p-4">
                    <h2 class="card-title mb-4">Detalles del Recambio</h2>
                    
                    <div class="mb-4">
                        <a href="{{ route('recambios.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Volver
                        </a>
                        <a href="{{ route('recambios.edit', $recambio) }}" class="btn btn-outline-primary ms-2">
                            <i class="bi bi-pencil me-1"></i> Editar
                        </a>
                    </div>
                    
                    <div class="info-section">
                        <h5>Información del Producto</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><span class="info-label">Producto:</span> {{ $recambio->producto }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><span class="info-label">Cantidad:</span> {{ $recambio->cantidad }}</p>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><span class="info-label">Referencia:</span> {{ $recambio->referencia ?? 'No especificada' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><span class="info-label">Precio:</span> {{ $recambio->precio ? number_format($recambio->precio, 2) . ' €' : 'No especificado' }}</p>
                            </div>
                        </div>
                        
                        @if($recambio->siniestro)
                            <div class="mb-3">
                                <p>
                                    <span class="info-label">Siniestro:</span> 
                                    <a href="{{ route('siniestros.show', $recambio->siniestro) }}">
                                        {{ $recambio->siniestro->numero ?? $recambio->siniestro->id }} - {{ $recambio->siniestro->vehiculo->marca }} {{ $recambio->siniestro->vehiculo->modelo }}
                                    </a>
                                </p>
                            </div>
                        @endif
                        
                        @if($recambio->descripcion)
                            <div class="mb-0">
                                <p><span class="info-label">Descripción:</span></p>
                                <p class="mb-0">{{ $recambio->descripcion }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    :root {
        --primary-color: #235390;
        --secondary-color: #4f8cff;
        --light-color: #e3ecff;
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
</style>
@endsection