@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Título de la página -->
                    <div class="page-header">
                        <h2 class="card-title">Gestión de Documentos</h2>
                    </div>
                    
                    <!-- Contenido de la tabla -->
                    <div>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        
                        <!-- Barra de búsqueda -->
                        <div class="search-container mb-4">
                            <form action="{{ route('documentos.index') }}" method="GET">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                                    <input type="text" class="form-control" name="search" placeholder="Search" value="{{ request('search') }}">
                                </div>
                            </form>
                        </div>
                        
                        <!-- Botón Agregar -->
                        <div class="add-button text-center">
                            <a href="{{ route('documentos.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg btn-icon"></i> Agregar
                            </a>
                        </div>
                        
                        <!-- Tabla de documentos -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="table-header">
                                        <th scope="col" class="text-center">Acciones</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Formato</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($documentos as $documento)
                                        <tr>
                                            <td class="text-center action-cell">
                                                <div class="action-icons">
                                                    <a href="{{ route('documentos.destroy', $documento) }}" 
                                                       onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas eliminar este documento?')) document.getElementById('delete-form-{{ $documento->id }}').submit();" 
                                                       title="Eliminar">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $documento->id }}" action="{{ route('documentos.destroy', $documento) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    
                                                    <a href="{{ route('documentos.edit', $documento) }}" title="Editar">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    
                                                    <a href="{{ route('documentos.view', $documento) }}" title="Ver" target="_blank">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                @if($documento->nombre == 'otro' && $documento->otro_nombre)
                                                    {{ $documento->otro_nombre }}
                                                @else
                                                    {{ $documento->nombre }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($documento->descripcion == 'otro' && $documento->otra_descripcion)
                                                    {{ $documento->otra_descripcion }}
                                                @else
                                                    {{ $documento->descripcion }}
                                                @endif
                                            </td>
                                            <td>{{ $documento->formato }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">
                                                @if(request('search'))
                                                    No se encontraron documentos que coincidan con "{{ request('search') }}".
                                                @else
                                                    No hay documentos registrados.
                                                @endif
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Paginación -->
                        @if($documentos->hasPages())
                            <div class="d-flex justify-content-center mt-4">
                                {{ $documentos->appends(['search' => request('search')])->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection