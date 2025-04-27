@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body p-0">
                    <!-- Contenido de los detalles -->
                    <div class="p-4">
                        <h2 class="card-title mb-4">Detalles del Documento</h2>
                        
                        <div class="mb-4">
                            <a href="{{ route('documentos.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Volver
                            </a>
                            <a href="{{ route('documentos.edit', $documento) }}" class="btn btn-outline-primary ms-2">
                                <i class="bi bi-pencil me-1"></i> Editar
                            </a>
                            @if($documento->ruta_archivo)
                                <a href="{{ route('documentos.download', $documento) }}" class="btn btn-outline-primary ms-2">
                                    <i class="bi bi-download me-1"></i> Descargar
                                </a>
                                <a href="{{ route('documentos.view', $documento) }}" class="btn btn-outline-primary ms-2" target="_blank">
                                    <i class="bi bi-eye me-1"></i> Ver
                                </a>
                            @endif
                        </div>
                        
                        <div class="info-section">
                            <h5>Información del Documento</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><span class="info-label">ID:</span> {{ $documento->id }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <span class="info-label">Nombre:</span> 
                                        @if($documento->nombre == 'otro' && $documento->otro_nombre)
                                            {{ $documento->otro_nombre }}
                                        @else
                                            {{ $documento->nombre }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p>
                                        <span class="info-label">Descripción:</span> 
                                        @if($documento->descripcion == 'otro' && $documento->otra_descripcion)
                                            {{ $documento->otra_descripcion }}
                                        @else
                                            {{ $documento->descripcion }}
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p><span class="info-label">Formato:</span> {{ $documento->formato }}</p>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><span class="info-label">Fecha de creación:</span> {{ $documento->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><span class="info-label">Última actualización:</span> {{ $documento->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        @if($documento->ruta_archivo)
                            <div class="info-section mb-0">
                                <h5>Archivo</h5>
                                <div class="file-preview text-center">
                                    @php
                                        $extension = pathinfo(storage_path('app/public/' . $documento->ruta_archivo), PATHINFO_EXTENSION);
                                        $iconClass = 'bi-file-earmark';
                                        
                                        if (in_array($extension, ['pdf'])) {
                                            $iconClass = 'bi-file-earmark-pdf';
                                        } elseif (in_array($extension, ['doc', 'docx'])) {
                                            $iconClass = 'bi-file-earmark-word';
                                        } elseif (in_array($extension, ['xls', 'xlsx'])) {
                                            $iconClass = 'bi-file-earmark-excel';
                                        } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                                            $iconClass = 'bi-file-earmark-image';
                                        }
                                    @endphp
                                    
                                    <div class="mb-3">
                                        <i class="bi {{ $iconClass }} file-icon"></i>
                                    </div>
                                    
                                    <p class="mb-2">{{ basename($documento->ruta_archivo) }}</p>
                                    
                                    <div class="btn-group">
                                        <a href="{{ route('documentos.download', $documento) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-download me-1"></i> Descargar archivo
                                        </a>
                                        <a href="{{ route('documentos.view', $documento) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                            <i class="bi bi-eye me-1"></i> Ver archivo
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection