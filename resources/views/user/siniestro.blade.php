@extends('layouts.app')

@section('styles')
<style>
    .detail-card {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .detail-header {
        background: linear-gradient(90deg, #4f8cff 0%, #235390 100%);
        padding: 1.5rem;
        color: white;
    }
    
    .detail-section {
        padding: 1.5rem;
        border-bottom: 1px solid #eee;
    }
    
    .detail-section:last-child {
        border-bottom: none;
    }
    
    .section-title {
        font-weight: 600;
        color: #235390;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e3ecff;
    }
    
    .taller-logo {
        width: 60px;
        height: 60px;
        object-fit: contain;
        background: white;
        padding: 5px;
        border-radius: 8px;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-4">
                <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Volver a mis siniestros
                </a>
            </div>
            
            <div class="card detail-card mb-4">
                <div class="detail-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">Detalles del Siniestro</h4>
                        <p class="mb-0 opacity-75">{{ $siniestro->vehiculo->marca }} {{ $siniestro->vehiculo->modelo }} - {{ $siniestro->vehiculo->matricula }}</p>
                    </div>
                    <span class="badge {{ $siniestro->estado == 'pendiente' ? 'bg-warning' : ($siniestro->estado == 'en_proceso' ? 'bg-info' : 'bg-success') }} fs-6">
                        {{ ucfirst(str_replace('_', ' ', $siniestro->estado)) }}
                    </span>
                </div>
                
                <div class="detail-section">
                    <h5 class="section-title">Información del Taller</h5>
                    <div class="d-flex align-items-center">
                        @if($siniestro->user->logo)
                            <img src="{{ asset('storage/' . $siniestro->user->logo) }}" alt="{{ $siniestro->user->name }}" class="taller-logo me-3">
                        @else
                            <div class="me-3 bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="bi bi-building fs-3"></i>
                            </div>
                        @endif
                        <div>
                            <h5 class="mb-1">{{ $siniestro->user->name }}</h5>
                            <p class="mb-0 text-muted">{{ $siniestro->user->email }}</p>
                            @if($siniestro->user->phone)
                                <p class="mb-0 text-muted">{{ $siniestro->user->phone }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="detail-section">
                    <h5 class="section-title">Información del Siniestro</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Número:</strong> {{ $siniestro->numero ?? 'N/A' }}</p>
                            <p><strong>Fecha de entrada:</strong> {{ \Carbon\Carbon::parse($siniestro->fecha_entrada ?? $siniestro->fecha)->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Estado:</strong> {{ ucfirst(str_replace('_', ' ', $siniestro->estado)) }}</p>
                            @if($siniestro->fecha_salida)
                                <p><strong>Fecha de salida:</strong> {{ \Carbon\Carbon::parse($siniestro->fecha_salida)->format('d/m/Y') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="detail-section">
                    <h5 class="section-title">Información del Vehículo</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Marca</label>
                                <input type="text" class="form-control" value="{{ $siniestro->vehiculo->marca }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Modelo</label>
                                <input type="text" class="form-control" value="{{ $siniestro->vehiculo->modelo }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Matrícula</label>
                                <input type="text" class="form-control" value="{{ $siniestro->vehiculo->matricula }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Color</label>
                                <input type="text" class="form-control" value="{{ $siniestro->vehiculo->color }}" readonly>
                            </div>
                        </div>
                    </div>
                    @if($siniestro->vehiculo->bastidor)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Bastidor</label>
                                <input type="text" class="form-control" value="{{ $siniestro->vehiculo->bastidor }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Fecha Matriculación</label>
                                <input type="text" class="form-control" value="{{ $siniestro->vehiculo->fecha_matriculacion ? \Carbon\Carbon::parse($siniestro->vehiculo->fecha_matriculacion)->format('d/m/Y') : 'No disponible' }}" readonly>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                
                <div class="detail-section">
                    <h5 class="section-title">Descripción del Siniestro</h5>
                    <div class="card">
                        <div class="card-body bg-light">
                            {{ $siniestro->descripcion }}
                        </div>
                    </div>
                </div>
                
                @if($siniestro->daños)
                <div class="detail-section">
                    <h5 class="section-title">Daños Detectados</h5>
                    <div class="card">
                        <div class="card-body bg-light">
                            {!! nl2br(e($siniestro->daños)) !!}
                        </div>
                    </div>
                </div>
                @endif
                
                @if(count($recambios) > 0)
                <div class="detail-section">
                    <h5 class="section-title">Recambios Utilizados</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th class="text-end">Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recambios as $recambio)
                                <tr>
                                    <td>{{ $recambio->nombre }}</td>
                                    <td>{{ $recambio->descripcion }}</td>
                                    <td>{{ $recambio->cantidad }}</td>
                                    <td class="text-end">{{ number_format($recambio->precio, 2) }} €</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Total:</th>
                                    <th class="text-end">{{ number_format($recambios->sum(function($recambio) { return $recambio->precio * $recambio->cantidad; }), 2) }} €</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection