@extends('layouts.app')

<title>{{ config('app.name', 'MiraCar') }} - Siniestro</title>

<link rel="icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
<link rel="shortcut icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
<link rel="apple-touch-icon" href="{{ asset('galeria/logo.png') }}">
<meta name="msapplication-TileImage" content="{{ asset('galeria/logo.png') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

@section('content')
<div class="container mt-3 mt-md-5">
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-primary btn-sm btn-md">
                <i class="bi bi-arrow-left"></i> Volver al inicio
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 d-md-none mb-3">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0 fs-6">Contacto del Taller</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        @if($siniestro->user->logo)
                            <img src="{{ asset('storage/' . $siniestro->user->logo) }}" 
                                 alt="{{ $siniestro->user->name }}" 
                                 class="me-2" style="width: 40px; height: 40px; object-fit: cover; border-radius: 6px;"
                                 onerror="this.onerror=null; this.src='{{ asset('galeria/logo.png') }}';">
                        @else
                            <div class="me-2 d-flex align-items-center justify-content-center bg-primary text-white" 
                                 style="width: 40px; height: 40px; border-radius: 6px;">
                                <i class="bi bi-building"></i>
                            </div>
                        @endif
                        <div>
                            <h6 class="mb-0 fs-6">{{ $siniestro->user->company_name }}</h6>
                        </div>
                    </div>
                    
                    <div class="mb-2 small">
                        <i class="bi bi-envelope me-2"></i> {{ $siniestro->user->email }}
                    </div>
                    
                    @if($siniestro->user->phone)
                        <div class="mb-2 small">
                            <i class="bi bi-telephone me-2"></i> {{ $siniestro->user->phone }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fs-5 fs-md-4">Detalles del Siniestro</h4>
                    <span class="badge bg-light text-primary">
                        @switch($siniestro->estado)
                            @case('pendiente')
                                Pendiente
                                @break
                            @case('en_proceso')
                                En proceso
                                @break
                            @case('completado')
                                Completado
                                @break
                            @default
                                {{ ucfirst($siniestro->estado) }}
                        @endswitch
                    </span>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-12 col-md-6 mb-3 mb-md-0">
                            <h5 class="section-title fs-6 fs-md-5">Información General</h5>
                            <div class="mb-2 small">
                                <strong>Fecha de entrada:</strong> 
                                {{ \Carbon\Carbon::parse($siniestro->fecha_entrada ?? $siniestro->fecha)->format('d/m/Y') }}
                            </div>
                            <div class="mb-2 small">
                                <strong>Fecha estimada de salida:</strong> 
                                {{ $siniestro->fecha_salida ? \Carbon\Carbon::parse($siniestro->fecha_salida)->format('d/m/Y') : 'No especificada' }}
                            </div>
                            <div class="mb-2 small">
                                <strong>Taller:</strong> {{ $siniestro->user->name }}
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <h5 class="section-title fs-6 fs-md-5">Vehículo</h5>
                            <div class="mb-2 small">
                                <strong>Marca:</strong> {{ $siniestro->vehiculo->marca }}
                            </div>
                            <div class="mb-2 small">
                                <strong>Modelo:</strong> {{ $siniestro->vehiculo->modelo }}
                            </div>
                            <div class="mb-2 small">
                                <strong>Matrícula:</strong> {{ $siniestro->vehiculo->matricula }}
                            </div>
                            <div class="mb-2 small">
                                <strong>Color:</strong> {{ $siniestro->vehiculo->color }}
                            </div>
                        </div>
                    </div>
                    
                    <h5 class="section-title fs-6 fs-md-5">Descripción del Siniestro</h5>
                    <div class="p-2 p-md-3 bg-light rounded mb-4 small">
                        {{ $siniestro->descripcion ?? 'No hay descripción disponible.' }}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 d-none d-md-block">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Contacto del Taller</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        @if($siniestro->user->logo)
                            <img src="{{ asset('storage/' . $siniestro->user->logo) }}" 
                                 alt="{{ $siniestro->user->name }}" 
                                 class="me-3" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;"
                                 onerror="this.onerror=null; this.src='{{ asset('galeria/logo.png') }}';">
                        @else
                            <div class="me-3 d-flex align-items-center justify-content-center bg-primary text-white" 
                                 style="width: 50px; height: 50px; border-radius: 8px;">
                                <i class="bi bi-building"></i>
                            </div>
                        @endif
                        <div>
                            <h6 class="mb-0">{{ $siniestro->user->company_name }}</h6>
                        </div>
                    </div>
                    
                    <div class="mb-2">
                        <i class="bi bi-envelope me-2"></i> {{ $siniestro->user->email }}
                    </div>
                    
                    @if($siniestro->user->phone)
                        <div class="mb-2">
                            <i class="bi bi-telephone me-2"></i> {{ $siniestro->user->phone }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 20px;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    
    .section-title {
        font-weight: 600;
        color: #235390;
        margin-bottom: 0.75rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e3ecff;
    }
    
    .badge {
        font-weight: 500;
        padding: 0.5em 0.8em;
    }
    
    .list-group-item {
        border-left: none;
        border-right: none;
    }
    
    .list-group-item:first-child {
        border-top: none;
    }
    
    .list-group-item:last-child {
        border-bottom: none;
    }
    
    @media (max-width: 767.98px) {
        .container {
            padding-left: 10px;
            padding-right: 10px;
        }
        
        .card-header h4 {
            font-size: 1.1rem;
        }
        
        .section-title {
            font-size: 1rem;
            margin-bottom: 0.5rem;
            padding-bottom: 0.25rem;
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
        
        .btn-md {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }
    }
    
    @media (min-width: 768px) and (max-width: 991.98px) {
        .container {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        .section-title {
            font-size: 1.1rem;
        }
    }
</style>
@endpush