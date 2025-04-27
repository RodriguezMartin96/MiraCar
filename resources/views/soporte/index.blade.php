@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Solicitudes de Soporte</h1>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('soporte.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva Solicitud
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Asunto</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($soportes as $soporte)
                            <tr>
                                <td>{{ $soporte->id }}</td>
                                <td>{{ $soporte->email }}</td>
                                <td>{{ $soporte->asunto }}</td>
                                <td>
                                    <span class="badge bg-{{ $soporte->estado == 'Pendiente' ? 'warning' : ($soporte->estado == 'En proceso' ? 'info' : ($soporte->estado == 'Resuelto' ? 'success' : 'secondary')) }}">
                                        {{ $soporte->estado }}
                                    </span>
                                </td>
                                <td>{{ $soporte->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('soporte.show', $soporte->id) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('soporte.edit', $soporte->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('soporte.destroy', $soporte->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta solicitud?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No hay solicitudes de soporte registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $soportes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection