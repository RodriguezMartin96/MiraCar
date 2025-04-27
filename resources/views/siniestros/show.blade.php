@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body p-4">
                    <h2 class="card-title mb-4">Detalles del Siniestro</h2>
                    
                    <div class="mb-4">
                        <a href="{{ route('siniestros.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Volver
                        </a>
                        <a href="{{ route('siniestros.edit', $siniestro) }}" class="btn btn-outline-primary ms-2">
                            <i class="bi bi-pencil me-1"></i> Editar
                        </a>
                    </div>
                    
                    <div class="info-section">
                        <h5>Información del Siniestro</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><span class="info-label">Número:</span> {{ $siniestro->numero }}</p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <span class="info-label">Estado:</span> 
                                    <span class="badge {{ 
                                        $siniestro->estado == 'Finalizado' ? 'badge-finalizado' : 
                                        ($siniestro->estado == 'En proceso' ? 'badge-proceso' : 'badge-pendiente') 
                                    }} rounded-pill">{{ $siniestro->estado }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="info-section">
                        <h5>Información del Cliente</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><span class="info-label">Cliente:</span> {{ $siniestro->cliente->nombre }} {{ $siniestro->cliente->apellidos }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><span class="info-label">DNI:</span> {{ $siniestro->cliente->dni }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="info-section">
                        <h5>Información del Vehículo</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><span class="info-label">Vehículo:</span> {{ $siniestro->vehiculo->marca }} {{ $siniestro->vehiculo->modelo }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><span class="info-label">Matrícula:</span> {{ $siniestro->vehiculo->matricula }}</p>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6">
                                <p><span class="info-label">Bastidor:</span> {{ $siniestro->vehiculo->bastidor ?? 'No especificado' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><span class="info-label">Fecha Matriculación:</span> {{ $siniestro->vehiculo->fecha_matriculacion ? $siniestro->vehiculo->fecha_matriculacion->format('d/m/Y') : 'No especificada' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="info-section">
                        <h5>Fechas</h5>
                        <div class="row mb-0">
                            <div class="col-md-6">
                                <p><span class="info-label">Fecha Entrada:</span> {{ $siniestro->fecha_entrada->format('d/m/Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><span class="info-label">Fecha Salida:</span> {{ $siniestro->fecha_salida ? $siniestro->fecha_salida->format('d/m/Y') : 'Pendiente' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    @if($siniestro->descripcion)
                        <div class="info-section mb-0">
                            <h5>Descripción</h5>
                            <p class="mb-0">{{ $siniestro->descripcion }}</p>
                        </div>
                    @endif
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
    
    .badge-pendiente {
        background-color: #ffc107;
        color: #212529;
    }
    
    .badge-proceso {
        background-color: var(--secondary-color);
        color: white;
    }
    
    .badge-finalizado {
        background-color: #198754;
        color: white;
    }
</style>
@endsection