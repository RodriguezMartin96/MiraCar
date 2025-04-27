@extends('layouts.app')

@section('styles')
<style>
    .siniestro-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .siniestro-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(79, 140, 255, 0.15) !important;
    }
    
    .empty-state {
        padding: 3rem 0;
    }
    
    .empty-state-icon {
        font-size: 4rem;
        color: #d1d9e6;
        margin-bottom: 1rem;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Mis Siniestros</h4>
                </div>
                <div class="card-body">
                    @if(isset($error))
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @elseif(empty($siniestrosPorTaller))
                        <div class="text-center py-5 empty-state">
                            <div class="empty-state-icon">
                                <i class="bi bi-car-front"></i>
                            </div>
                            <h5 class="text-muted">No tienes siniestros registrados</h5>
                            <p class="text-muted">Cuando lleves tu vehículo a un taller, podrás ver aquí la información de tus siniestros.</p>
                        </div>
                    @else
                        <div class="accordion" id="accordionTalleres">
                            @foreach($siniestrosPorTaller as $tallerId => $data)
                                <div class="accordion-item mb-3 border">
                                    <h2 class="accordion-header" id="heading{{ $tallerId }}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $tallerId }}" aria-expanded="true" aria-controls="collapse{{ $tallerId }}">
                                            <div class="d-flex align-items-center w-100">
                                                @if($data['taller']['logo'])
                                                    <img src="{{ asset('storage/' . $data['taller']['logo']) }}" alt="{{ $data['taller']['nombre'] }}" class="me-3" style="width: 40px; height: 40px; object-fit: contain;">
                                                @else
                                                    <div class="me-3 bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                        <i class="bi bi-building"></i>
                                                    </div>
                                                @endif
                                                <span class="fw-bold">{{ $data['taller']['nombre'] }}</span>
                                                <span class="ms-auto badge bg-primary rounded-pill">{{ count($data['siniestros']) }}</span>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $tallerId }}" class="accordion-collapse collapse show" aria-labelledby="heading{{ $tallerId }}" data-bs-parent="#accordionTalleres">
                                        <div class="accordion-body p-0">
                                            <div class="list-group list-group-flush">
                                                @foreach($data['siniestros'] as $siniestro)
                                                    <a href="{{ route('user.siniestro', $siniestro['id']) }}" class="list-group-item list-group-item-action siniestro-card">
                                                        <div class="d-flex w-100 justify-content-between align-items-center">
                                                            <div>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="me-3 bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                                        <i class="bi bi-car-front fs-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-0">{{ $siniestro['vehiculo']['marca'] }} {{ $siniestro['vehiculo']['modelo'] }}</h6>
                                                                        <small class="text-muted">{{ $siniestro['vehiculo']['matricula'] }}</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="text-end">
                                                                <span class="badge {{ $siniestro['estado'] == 'pendiente' ? 'bg-warning' : ($siniestro['estado'] == 'en_proceso' ? 'bg-info' : 'bg-success') }}">
                                                                    {{ ucfirst(str_replace('_', ' ', $siniestro['estado'])) }}
                                                                </span>
                                                                <div><small class="text-muted">{{ \Carbon\Carbon::parse($siniestro['fecha'])->format('d/m/Y') }}</small></div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animación de entrada para las tarjetas de siniestros
        const cards = document.querySelectorAll('.siniestro-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(10px)';
            
            setTimeout(() => {
                card.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100 + (index * 50));
        });
    });
</script>
@endsection