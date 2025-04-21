@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container mt-4">
    <div class="dashboard-content">
        <!-- Encabezado de bienvenida -->
        <div class="welcome-header">
            <h1 class="welcome-title">Bienvenido a MiraCar</h1>
            <p class="welcome-subtitle">Selecciona un video tutorial para aprender a usar cada sección del sistema de gestión de taller.</p>
        </div>
        
        <!-- Primera fila de videos: Cliente, Vehículo, Siniestro -->
        <div class="row video-section">
            <div class="col-md-4">
                <div class="video-card cliente" data-bs-toggle="modal" data-bs-target="#videoModal" data-video-title="Cliente" data-video-src="https://player.vimeo.com/video/76979871">
                    <div class="video-content">
                        <div class="video-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3 class="video-title">Cliente</h3>
                        <p class="video-description">Aprende a gestionar los datos de tus clientes</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="video-card vehiculo" data-bs-toggle="modal" data-bs-target="#videoModal" data-video-title="Vehículo" data-video-src="https://player.vimeo.com/video/76979871">
                    <div class="video-content">
                        <div class="video-icon">
                            <i class="bi bi-car-front"></i>
                        </div>
                        <h3 class="video-title">Vehículo</h3>
                        <p class="video-description">Gestiona la información de los vehículos</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="video-card siniestro" data-bs-toggle="modal" data-bs-target="#videoModal" data-video-title="Siniestro" data-video-src="https://player.vimeo.com/video/76979871">
                    <div class="video-content">
                        <div class="video-icon">
                            <i class="bi bi-tools"></i>
                        </div>
                        <h3 class="video-title">Siniestro</h3>
                        <p class="video-description">Administra los siniestros y reparaciones</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Segunda fila de videos: Recambios, Documentación, Soporte -->
        <div class="row video-section">
            <div class="col-md-4">
                <div class="video-card recambios" data-bs-toggle="modal" data-bs-target="#videoModal" data-video-title="Recambios" data-video-src="https://player.vimeo.com/video/76979871">
                    <div class="video-content">
                        <div class="video-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <h3 class="video-title">Recambios</h3>
                        <p class="video-description">Control de inventario de recambios</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="video-card documentacion" data-bs-toggle="modal" data-bs-target="#videoModal" data-video-title="Documentación" data-video-src="https://player.vimeo.com/video/76979871">
                    <div class="video-content">
                        <div class="video-icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <h3 class="video-title">Documentación</h3>
                        <p class="video-description">Gestión de documentos y archivos</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="video-card soporte" data-bs-toggle="modal" data-bs-target="#videoModal" data-video-title="Soporte" data-video-src="https://player.vimeo.com/video/76979871">
                    <div class="video-content">
                        <div class="video-icon">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h3 class="video-title">Soporte</h3>
                        <p class="video-description">Obtén ayuda y soporte técnico</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para reproducir videos -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoModalLabel">Tutorial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ratio ratio-16x9">
                    <iframe id="videoFrame" src="/placeholder.svg" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection