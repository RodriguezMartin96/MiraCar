@extends('layouts.app')

@section('styles')
    <style>
        :root {
            --primary-color: #235390;
            --secondary-color: #4f8cff;
            --light-color: #e3ecff;
            --bg-light: #f8faff;
        }
        
        .card {
            transition: transform 0.2s, box-shadow 0.2s;
            border: none;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(79, 140, 255, 0.15) !important;
        }
        
        .icon-lg {
            font-size: 2.5rem;
            height: 80px;
            width: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 1rem;
        }
        
        .text-primary {
            color: var(--primary-color) !important;
        }
        
        .text-secondary-custom {
            color: var(--secondary-color) !important;
        }
        
        .bg-primary-light {
            background-color: var(--light-color);
        }
        
        .modal-content {
            border: none;
            overflow: hidden;
        }
    </style>
@endsection

@section('content')
<div class="container py-5">
    <!-- Encabezado de bienvenida -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold text-primary mb-2">Bienvenido a MiraCar</h1>
            <p class="lead text-secondary-custom">Selecciona un video tutorial para aprender a usar cada sección del sistema de gestión de taller.</p>
        </div>
    </div>
    
    <!-- Primera fila de videos: Cliente, Vehículo, Siniestro -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm rounded-4 p-3" data-bs-toggle="modal" data-bs-target="#videoModal" data-video-title="Cliente" data-video-src="https://player.vimeo.com/video/76979871" role="button">
                <div class="card-body text-center">
                    <div class="icon-lg bg-primary-light text-primary">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3 class="h4 fw-bold text-primary mb-2">Cliente</h3>
                    <p class="text-muted mb-0">Aprende a gestionar los datos de tus clientes</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card h-100 shadow-sm rounded-4 p-3" data-bs-toggle="modal" data-bs-target="#videoModal" data-video-title="Vehículo" data-video-src="https://player.vimeo.com/video/76979871" role="button">
                <div class="card-body text-center">
                    <div class="icon-lg bg-success-subtle text-success">
                        <i class="bi bi-car-front"></i>
                    </div>
                    <h3 class="h4 fw-bold text-success mb-2">Vehículo</h3>
                    <p class="text-muted mb-0">Gestiona la información de los vehículos</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card h-100 shadow-sm rounded-4 p-3" data-bs-toggle="modal" data-bs-target="#videoModal" data-video-title="Siniestro" data-video-src="https://player.vimeo.com/video/76979871" role="button">
                <div class="card-body text-center">
                    <div class="icon-lg bg-danger-subtle text-danger">
                        <i class="bi bi-tools"></i>
                    </div>
                    <h3 class="h4 fw-bold text-danger mb-2">Siniestro</h3>
                    <p class="text-muted mb-0">Administra los siniestros y reparaciones</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Segunda fila de videos: Recambios, Documentación, Soporte -->
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm rounded-4 p-3" data-bs-toggle="modal" data-bs-target="#videoModal" data-video-title="Recambios" data-video-src="https://player.vimeo.com/video/76979871" role="button">
                <div class="card-body text-center">
                    <div class="icon-lg bg-warning-subtle text-warning">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <h3 class="h4 fw-bold text-warning mb-2">Recambios</h3>
                    <p class="text-muted mb-0">Control de inventario de recambios</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card h-100 shadow-sm rounded-4 p-3" data-bs-toggle="modal" data-bs-target="#videoModal" data-video-title="Documentación" data-video-src="https://player.vimeo.com/video/76979871" role="button">
                <div class="card-body text-center">
                    <div class="icon-lg bg-info-subtle text-info">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <h3 class="h4 fw-bold text-info mb-2">Documentación</h3>
                    <p class="text-muted mb-0">Gestión de documentos y archivos</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card h-100 shadow-sm rounded-4 p-3" data-bs-toggle="modal" data-bs-target="#videoModal" data-video-title="Soporte" data-video-src="https://player.vimeo.com/video/76979871" role="button">
                <div class="card-body text-center">
                    <div class="icon-lg bg-secondary-subtle text-secondary">
                        <i class="bi bi-headset"></i>
                    </div>
                    <h3 class="h4 fw-bold text-secondary mb-2">Soporte</h3>
                    <p class="text-muted mb-0">Obtén ayuda y soporte técnico</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para reproducir videos -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-primary" id="videoModalLabel">Tutorial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <div class="ratio ratio-16x9 rounded-4 overflow-hidden">
                    <iframe id="videoFrame" src="/placeholder.svg" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manejar la apertura del modal de video
        const videoModal = document.getElementById('videoModal');
        const videoFrame = document.getElementById('videoFrame');
        const videoModalLabel = document.getElementById('videoModalLabel');
        
        if (videoModal) {
            videoModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const videoTitle = button.getAttribute('data-video-title');
                const videoSrc = button.getAttribute('data-video-src');
                
                videoModalLabel.textContent = 'Tutorial: ' + videoTitle;
                videoFrame.src = videoSrc;
            });
            
            // Detener el video cuando se cierra el modal
            videoModal.addEventListener('hidden.bs.modal', function() {
                videoFrame.src = '';
            });
        }
        
        // Animación de entrada para las tarjetas
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100 + (index * 100));
        });
    });
</script>
@endsection