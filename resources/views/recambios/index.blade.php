@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-4">
                    <h2 class="card-title mb-4">Gestión de Recambios</h2>
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <!-- Barra de búsqueda -->
                    <div class="search-container mb-4">
                        <form action="{{ route('recambios.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Buscar por producto, referencia o descripción..." value="{{ request('search') }}">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Información de búsqueda -->
                    @if(request('search'))
                        <div class="alert alert-info mb-4">
                            <i class="bi bi-info-circle me-2"></i>
                            Mostrando resultados para: <strong>"{{ request('search') }}"</strong>
                            <a href="{{ route('recambios.index') }}" class="float-end text-decoration-none">
                                <i class="bi bi-x-circle"></i> Limpiar filtro
                            </a>
                        </div>
                    @endif
                    
                    <!-- Botón Agregar -->
                    <div class="mb-4">
                        <a href="{{ route('recambios.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i> Agregar Recambio
                        </a>
                    </div>
                    
                    <!-- Tabla de recambios -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="table-header">
                                    <th scope="col" width="120">Acciones</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Referencia</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Siniestro</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recambios as $recambio)
                                    <tr class="{{ $recambio->cantidad < 5 ? 'stock-bajo' : '' }}">
                                        <td class="action-icons text-center">
                                            <a href="{{ route('recambios.edit', $recambio) }}" title="Editar" class="me-2"><i class="bi bi-pencil"></i></a>
                                            <a href="{{ route('recambios.show', $recambio) }}" title="Ver detalles" class="me-2"><i class="bi bi-eye"></i></a>
                                            <form action="{{ route('recambios.destroy', $recambio) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este recambio?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>{{ $recambio->producto }}</td>
                                        <td>{{ $recambio->cantidad }}</td>
                                        <td>{{ $recambio->referencia ?? 'N/A' }}</td>
                                        <td>{{ $recambio->precio ? number_format($recambio->precio, 2) . ' €' : 'N/A' }}</td>
                                        <td>
                                            @if($recambio->siniestro)
                                                <a href="{{ route('siniestros.show', $recambio->siniestro) }}">{{ $recambio->siniestro->numero ?? $recambio->siniestro->id }}</a>
                                            @else
                                                <span class="text-muted">No asignado</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            @if(request('search'))
                                                No se encontraron recambios que coincidan con "{{ request('search') }}".
                                            @else
                                                No hay recambios registrados.
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Paginación -->
                    @if($recambios->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $recambios->appends(['search' => request('search')])->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    :root {
        --primary-color: #235390;
        --secondary-color: #4f8cff;
        --light-color: #e3ecff;
        --warning-color: #ffcdd2;
    }
    
    .card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    
    .card-title {
        color: var(--primary-color);
        font-weight: 600;
    }
    
    .table-header {
        background-color: var(--primary-color);
        color: white;
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-primary:hover {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
    }
    
    .btn-outline-primary {
        color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-outline-primary:hover {
        background-color: var(--primary-color);
        color: white;
    }
    
    .action-icons a, .action-icons button {
        color: var(--primary-color);
        transition: all 0.3s ease;
    }
    
    .action-icons a:hover, .action-icons button:hover {
        color: var(--secondary-color);
    }
    
    .search-container .btn-outline-secondary {
        border-color: #ced4da;
    }
    
    .search-container .btn-outline-secondary:hover {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }
    
    .alert-success {
        background-color: #d1e7dd;
        border-color: #badbcc;
        color: #0f5132;
    }
    
    .stock-bajo {
        background-color: var(--warning-color);
    }
</style>
@endsection