    <!-- Favicon -->
    <link rel="icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('galeria/logo.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('galeria/logo.png') }}">

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left"></i> Volver al dashboard
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Detalles del Siniestro</h4>
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
                        <div class="col-md-6">
                            <h5 class="section-title">Información General</h5>
                            <div class="mb-2">
                                <strong>Fecha de entrada:</strong> 
                                {{ \Carbon\Carbon::parse($siniestro->fecha_entrada ?? $siniestro->fecha)->format('d/m/Y') }}
                            </div>
                            <div class="mb-2">
                                <strong>Fecha estimada de salida:</strong> 
                                {{ $siniestro->fecha_salida ? \Carbon\Carbon::parse($siniestro->fecha_salida)->format('d/m/Y') : 'No especificada' }}
                            </div>
                            <div class="mb-2">
                                <strong>Taller:</strong> {{ $siniestro->user->name }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="section-title">Vehículo</h5>
                            <div class="mb-2">
                                <strong>Marca:</strong> {{ $siniestro->vehiculo->marca }}
                            </div>
                            <div class="mb-2">
                                <strong>Modelo:</strong> {{ $siniestro->vehiculo->modelo }}
                            </div>
                            <div class="mb-2">
                                <strong>Matrícula:</strong> {{ $siniestro->vehiculo->matricula }}
                            </div>
                            <div class="mb-2">
                                <strong>Color:</strong> {{ $siniestro->vehiculo->color }}
                            </div>
                        </div>
                    </div>
                    
                    <h5 class="section-title">Descripción del Siniestro</h5>
                    <div class="p-3 bg-light rounded mb-4">
                        {{ $siniestro->descripcion ?? 'No hay descripción disponible.' }}
                    </div>
                    
                    <h5 class="section-title">Observaciones</h5>
                    <div class="p-3 bg-light rounded">
                        {{ $siniestro->observaciones ?? 'No hay observaciones disponibles.' }}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Recambios</h5>
                </div>
                <div class="card-body">
                    @if($recambios->isEmpty())
                        <p class="text-muted">No hay recambios registrados para este siniestro.</p>
                    @else
                        <div class="list-group">
                            @foreach($recambios as $recambio)
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $recambio->nombre }}</h6>
                                        <small>{{ $recambio->precio }}€</small>
                                    </div>
                                    <p class="mb-1">{{ $recambio->descripcion }}</p>
                                    <small class="text-muted">
                                        Estado: 
                                        @switch($recambio->estado)
                                            @case('pendiente')
                                                <span class="badge bg-warning">Pendiente</span>
                                                @break
                                            @case('pedido')
                                                <span class="badge bg-info">Pedido</span>
                                                @break
                                            @case('recibido')
                                                <span class="badge bg-success">Recibido</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">{{ ucfirst($recambio->estado) }}</span>
                                        @endswitch
                                    </small>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            
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
                            <h6 class="mb-0">{{ $siniestro->user->name }}</h6>
                            <small class="text-muted">{{ $siniestro->user->company_name ?? '' }}</small>
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
    }
    
    .section-title {
        font-weight: 600;
        color: #235390;
        margin-bottom: 1rem;
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
</style>
@endpush
