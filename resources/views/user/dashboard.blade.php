@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Mi Dashboard</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Bienvenido, {{ Auth::user()->name }}</h5>
                    <p class="card-text">Aquí puedes ver el estado de tus vehículos y siniestros.</p>
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

    @if(empty($siniestrosPorTaller))
        <div class="alert alert-info">
            <p>No tienes siniestros registrados actualmente.</p>
        </div>
    @else
        @foreach($siniestrosPorTaller as $tallerData)
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <div class="d-flex align-items-center">
                        @if(isset($tallerData['taller']['logo']) && $tallerData['taller']['logo'])
                            <img src="{{ asset('storage/' . $tallerData['taller']['logo']) }}" 
                                 alt="{{ $tallerData['taller']['nombre'] }}" 
                                 class="me-3" style="width: 40px; height: 40px; object-fit: cover; border-radius: 8px;"
                                 onerror="this.onerror=null; this.src='{{ asset('galeria/logo.png') }}';">
                        @else
                            <div class="me-3 d-flex align-items-center justify-content-center bg-primary text-white" 
                                 style="width: 40px; height: 40px; border-radius: 8px;">
                                <i class="bi bi-building"></i>
                            </div>
                        @endif
                        <h5 class="mb-0">{{ $tallerData['taller']['nombre'] }}</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Vehículo</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tallerData['siniestros'] as $siniestro)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($siniestro['fecha'])->format('d/m/Y') }}</td>
                                        <td>
                                            {{ $siniestro['vehiculo']['marca'] }} {{ $siniestro['vehiculo']['modelo'] }}
                                            <br>
                                            <small class="text-muted">{{ $siniestro['vehiculo']['matricula'] }}</small>
                                        </td>
                                        <td>
                                            @switch($siniestro['estado'])
                                                @case('pendiente')
                                                    <span class="badge bg-warning">Pendiente</span>
                                                    @break
                                                @case('en_proceso')
                                                    <span class="badge bg-info">En proceso</span>
                                                    @break
                                                @case('completado')
                                                    <span class="badge bg-success">Completado</span>
                                                    @break
                                                @default
                                                    <span class="badge bg-secondary">{{ ucfirst($siniestro['estado']) }}</span>
                                            @endswitch
                                        </td>
                                        <td>
                                            <a href="{{ route('user.siniestro', $siniestro['id']) }}" class="btn btn-sm btn-primary">
                                                <i class="bi bi-eye"></i> Ver detalles
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    
    .badge {
        font-weight: 500;
        padding: 0.5em 0.8em;
    }
    
    .btn-sm {
        border-radius: 6px;
    }
</style>
@endpush
