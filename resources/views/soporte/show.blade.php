    <!-- Favicon -->
    <link rel="icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('galeria/logo.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('galeria/logo.png') }}">

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Detalles de Solicitud de Soporte</h1>
    
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">{{ $soporte->asunto }}</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Email:</strong> {{ $soporte->email }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Estado:</strong> 
                        <span class="badge bg-{{ $soporte->estado == 'Pendiente' ? 'warning' : ($soporte->estado == 'En proceso' ? 'info' : ($soporte->estado == 'Resuelto' ? 'success' : 'secondary')) }}">
                            {{ $soporte->estado }}
                        </span>
                    </p>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Fecha de creación:</strong> {{ $soporte->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Última actualización:</strong> {{ $soporte->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
            
            <div class="mb-4">
                <h5>Descripción:</h5>
                <div class="p-3 bg-light rounded">
                    {{ $soporte->descripcion }}
                </div>
            </div>
            
            @if($soporte->respuesta)
                <div class="mb-4">
                    <h5>Respuesta:</h5>
                    <div class="p-3 bg-light rounded">
                        {{ $soporte->respuesta }}
                    </div>
                </div>
            @endif
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <a href="{{ route('soporte.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
                <div>
                    <a href="{{ route('soporte.edit', $soporte->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <form action="{{ route('soporte.destroy', $soporte->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta solicitud?')">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection