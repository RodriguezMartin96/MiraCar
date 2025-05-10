@extends('layouts.app')

<title>{{ config('app.name', 'MiraCar') }} - Inicio</title>

<link rel="icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
<link rel="shortcut icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
<link rel="apple-touch-icon" href="{{ asset('galeria/logo.png') }}">
<meta name="msapplication-TileImage" content="{{ asset('galeria/logo.png') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

@section('content')
<div class="container mt-3 mt-md-5">
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 fs-5 fs-md-4">Mis Siniestros</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title fs-6 fs-md-5">Bienvenido, {{ Auth::user()->name }}</h5>
                    <p class="card-text small">Aquí puedes ver el estado de tus vehículos y siniestros.</p>
                </div>
            </div>
        </div>
    </div>

    @if(isset($error))
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            @if(empty($siniestrosPorTaller))
                <div class="alert alert-info">
                    <p class="mb-0 text-center">No tienes siniestros registrados actualmente.</p>
                </div>
            @else
                @foreach($siniestrosPorTaller as $tallerData)
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-light">
                            <div class="d-flex align-items-center">
                                @if(isset($tallerData['taller']['logo']) && $tallerData['taller']['logo'])
                                    <img src="{{ asset('storage/' . $tallerData['taller']['logo']) }}" 
                                         alt="{{ $tallerData['taller']['nombre'] }}" 
                                         class="me-2 me-md-3" style="width: 32px; height: 32px; object-fit: cover; border-radius: 6px;"
                                         onerror="this.onerror=null; this.src='{{ asset('galeria/logo.png') }}';">
                                @else
                                    <div class="me-2 me-md-3 d-flex align-items-center justify-content-center bg-primary text-white" 
                                         style="width: 32px; height: 32px; border-radius: 6px;">
                                        <i class="bi bi-building"></i>
                                    </div>
                                @endif
                                <h5 class="mb-0 fs-6 fs-md-5 text-truncate">{{ $tallerData['taller']['nombre'] }}</h5>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive d-none d-md-block">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr style="background-color: #235390; color: white;">
                                            <th style="text-align: center; vertical-align: middle;">Fecha</th>
                                            <th style="text-align: center; vertical-align: middle;">Vehículo</th>
                                            <th style="text-align: center; vertical-align: middle;">Estado</th>
                                            <th style="text-align: center; vertical-align: middle;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tallerData['siniestros'] as $siniestro)
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    {{ \Carbon\Carbon::parse($siniestro['fecha'])->format('d/m/Y') }}
                                                </td>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    {{ $siniestro['vehiculo']['marca'] }} {{ $siniestro['vehiculo']['modelo'] }} - {{ $siniestro['vehiculo']['matricula'] }}
                                                </td>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    @switch($siniestro['estado'])
                                                        @case('pendiente')
                                                            <div style="display: inline-block; padding: 6px 12px; border-radius: 20px; min-width: 100px; font-weight: 500; background-color: #ffcdd2; color: #000;">
                                                                Pendiente
                                                            </div>
                                                            @break
                                                        @case('en_proceso')
                                                            <div style="display: inline-block; padding: 6px 12px; border-radius: 20px; min-width: 100px; font-weight: 500; background-color: #ffe0b2; color: #000;">
                                                                En proceso
                                                            </div>
                                                            @break
                                                        @case('completado')
                                                            <div style="display: inline-block; padding: 6px 12px; border-radius: 20px; min-width: 100px; font-weight: 500; background-color: #c8e6c9; color: #000;">
                                                                Completado
                                                            </div>
                                                            @break
                                                        @default
                                                            <div style="display: inline-block; padding: 6px 12px; border-radius: 20px; min-width: 100px; font-weight: 500; background-color: #e9ecef; color: #000;">
                                                                {{ ucfirst($siniestro['estado']) }}
                                                            </div>
                                                    @endswitch
                                                </td>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    <a href="{{ route('user.siniestro', $siniestro['id']) }}" class="btn btn-sm btn-primary">
                                                        <i class="bi bi-eye me-1"></i> Ver detalles
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="d-md-none">
                                @foreach($tallerData['siniestros'] as $siniestro)
                                    <div class="border-bottom p-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="text-muted small">{{ \Carbon\Carbon::parse($siniestro['fecha'])->format('d/m/Y') }}</span>
                                            @switch($siniestro['estado'])
                                                @case('pendiente')
                                                    <div style="display: inline-block; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem; font-weight: 500; background-color: #ffcdd2; color: #000;">
                                                        Pendiente
                                                    </div>
                                                    @break
                                                @case('en_proceso')
                                                    <div style="display: inline-block; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem; font-weight: 500; background-color: #ffe0b2; color: #000;">
                                                        En proceso
                                                    </div>
                                                    @break
                                                @case('completado')
                                                    <div style="display: inline-block; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem; font-weight: 500; background-color: #c8e6c9; color: #000;">
                                                        Completado
                                                    </div>
                                                    @break
                                                @default
                                                    <div style="display: inline-block; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem; font-weight: 500; background-color: #e9ecef; color: #000;">
                                                        {{ ucfirst($siniestro['estado']) }}
                                                    </div>
                                            @endswitch
                                        </div>
                                        <div class="fw-bold mb-2 text-center">
                                            {{ $siniestro['vehiculo']['marca'] }} {{ $siniestro['vehiculo']['modelo'] }} - {{ $siniestro['vehiculo']['matricula'] }}
                                        </div>
                                        <div class="text-center">
                                            <a href="{{ route('user.siniestro', $siniestro['id']) }}" class="btn btn-sm btn-primary w-100">
                                                <i class="bi bi-eye me-1"></i> Ver detalles
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
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
    
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
    }
    
    .btn-sm {
        border-radius: 6px;
    }
    
    @media (max-width: 767.98px) {
        .container {
            padding-left: 10px;
            padding-right: 10px;
        }
        
        .card-header h4 {
            font-size: 1.1rem;
        }
        
        .card-title {
            font-size: 1rem;
        }
        
        .card-text {
            font-size: 0.875rem;
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
    }
    
    @media (min-width: 768px) and (max-width: 991.98px) {
        .container {
            padding-left: 15px;
            padding-right: 15px;
        }
    }
</style>
@endpush