@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body p-4">
                    <h2 class="card-title mb-4">Detalles del Vehículo</h2>
                    
                    <div class="mb-4">
                        <a href="{{ route('vehiculos.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Volver
                        </a>
                        <a href="{{ route('vehiculos.edit', $vehiculo) }}" class="btn btn-outline-primary ms-2">
                            <i class="bi bi-pencil me-1"></i> Editar
                        </a>
                    </div>
                    
                    <div class="info-section">
                        <h5>Información del Vehículo</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><span class="info-label">Marca:</span> {{ $vehiculo->marca }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><span class="info-label">Modelo:</span> {{ $vehiculo->modelo }}</p>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><span class="info-label">Matrícula:</span> {{ $vehiculo->matricula }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><span class="info-label">Bastidor:</span> {{ $vehiculo->bastidor ?? 'No especificado' }}</p>
                            </div>
                        </div>
                        
                        <div class="row mb-0">
                            <div class="col-md-6">
                                <p><span class="info-label">Fecha Matriculación:</span> {{ $vehiculo->fecha_matriculacion ? $vehiculo->fecha_matriculacion->format('d/m/Y') : 'No especificada' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><span class="info-label">Color:</span> {{ $vehiculo->color ?? 'No especificado' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="info-section mb-0">
                        <h5>Información del Propietario</h5>
                        <p><span class="info-label">Dueño:</span> {{ $vehiculo->cliente->nombre }} {{ $vehiculo->cliente->apellidos }}</p>
                        <p class="mb-0"><span class="info-label">DNI:</span> {{ $vehiculo->cliente->dni }}</p>
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