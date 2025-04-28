<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Documentos - {{ config('app.name', 'MiraCar') }}</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('galeria/logo.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('galeria/logo.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('galeria/logo.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('galeria/logo.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #235390;
            --secondary-color: #4f8cff;
            --light-color: #e3ecff;
        }
        
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #f8fafc;
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
            text-align: center;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .search-container .btn-outline-secondary {
            border-color: #ced4da;
        }
        
        .search-container .btn-outline-secondary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }
        
        .action-icons a, .action-icons button {
            color: var(--primary-color);
            transition: all 0.3s ease;
            margin: 0 5px;
            font-size: 1.1rem;
        }
        
        .action-icons a:hover, .action-icons button:hover {
            color: var(--secondary-color);
        }
        
        /* Centrar texto en la tabla */
        .table td, .table th {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <!-- Incluir la barra de navegación -->
    @include('layouts.navigation')

    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Título de la página -->
                        <div class="page-header">
                            <h2 class="card-title mb-4">Gestión de Documentos</h2>
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
                                        <input type="text" class="form-control" name="search" placeholder="Buscar por nombre, descripción, etc..." value="{{ request('search') }}">
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
                                    <a href="{{ route('documentos.index') }}" class="float-end text-decoration-none">
                                        <i class="bi bi-x-circle"></i> Limpiar filtro
                                    </a>
                                </div>
                            @endif
                            
                            <!-- Botón Agregar -->
                            <div class="mb-4">
                                <a href="{{ route('documentos.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-lg me-1"></i> Agregar Documento
                                </a>
                            </div>
                            
                            <!-- Tabla de documentos -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="table-header">
                                            <th scope="col" width="120">Acciones</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Descripción</th>
                                            <th scope="col">Formato</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($documentos as $documento)
                                            <tr>
                                                <td class="action-icons">
                                                    <a href="{{ route('documentos.edit', $documento) }}" title="Editar" class="me-2"><i class="bi bi-pencil"></i></a>
                                                    <a href="{{ route('documentos.show', $documento) }}" title="Ver detalles" class="me-2"><i class="bi bi-eye"></i></a>
                                                    <form action="{{ route('documentos.destroy', $documento) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link p-0" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este documento?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>