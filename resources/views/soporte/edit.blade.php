    <!-- Favicon -->
    <link rel="icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('galeria/logo.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('galeria/logo.png') }}">

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Editar Solicitud de Soporte</h1>
    
    <form action="{{ route('soporte.update', $soporte->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $soporte->email) }}" readonly>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="asunto" class="form-label">Asunto</label>
                    <input type="text" class="form-control @error('asunto') is-invalid @enderror" id="asunto" name="asunto" value="{{ old('asunto', $soporte->asunto) }}">
                    @error('asunto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="5">{{ old('descripcion', $soporte->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado">
                        <option value="Pendiente" {{ old('estado', $soporte->estado) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="En proceso" {{ old('estado', $soporte->estado) == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                        <option value="Resuelto" {{ old('estado', $soporte->estado) == 'Resuelto' ? 'selected' : '' }}>Resuelto</option>
                        <option value="Cerrado" {{ old('estado', $soporte->estado) == 'Cerrado' ? 'selected' : '' }}>Cerrado</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="respuesta" class="form-label">Respuesta</label>
                    <textarea class="form-control @error('respuesta') is-invalid @enderror" id="respuesta" name="respuesta" rows="5">{{ old('respuesta', $soporte->respuesta) }}</textarea>
                    @error('respuesta')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('soporte.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection