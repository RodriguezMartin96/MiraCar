<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Recambios - MiraCar</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        .table-header {
            background-color: #4CAF50;
            color: white;
        }
        .action-icons a {
            margin-right: 5px;
            color: #333;
        }
        .search-container {
            margin-bottom: 15px;
        }
        .stock-bajo {
            background-color: #ffcdd2;
        }
    </style>
</head>
<body class="bg-light" style="font-family: 'Instrument Sans', sans-serif;">
    <!-- Incluir la barra de navegación -->
    @include('layouts.navigation')

    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title mb-4">Gestión de Recambios</h2>
                        
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <!-- Barra de búsqueda -->
                        <div class="search-container">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Buscar..." aria-label="Buscar">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Botón Agregar -->
                        <div class="mb-3">
                            <a href="{{ route('recambios.create') }}" class="btn btn-outline-primary">
                                <i class="bi bi-plus"></i> Agregar
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recambios as $recambio)
                                        <tr class="{{ $recambio->cantidad < 5 ? 'stock-bajo' : '' }}">
                                            <td class="action-icons text-center">
                                                <a href="{{ route('recambios.edit', $recambio) }}" title="Editar"><i class="bi bi-pencil"></i></a>
                                                <a href="{{ route('recambios.show', $recambio) }}" title="Ver detalles"><i class="bi bi-eye"></i></a>
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
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No hay recambios registrados.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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