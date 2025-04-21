<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Siniestros - MiraCar</title>
    
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
        .estado-pendiente {
            background-color: #ffecb3;
        }
        .estado-finalizado {
            background-color: #c8e6c9;
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
                        <h2 class="card-title mb-4">Gestión de Siniestros</h2>
                        
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
                            <a href="{{ route('siniestros.create') }}" class="btn btn-outline-primary">
                                <i class="bi bi-plus"></i> Agregar
                            </a>
                        </div>
                        
                        <!-- Tabla de siniestros -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="table-header">
                                        <th scope="col" width="120">Acciones</th>
                                        <th scope="col">Número</th>
                                        <th scope="col">Vehículo</th>
                                        <th scope="col">Matrícula</th>
                                        <th scope="col">Cliente</th>
                                        <th scope="col">Fecha Entrada</th>
                                        <th scope="col">Fecha Salida</th>
                                        <th scope="col">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($siniestros as $siniestro)
                                        <tr class="{{ $siniestro->estado == 'Finalizado' ? 'estado-finalizado' : 'estado-pendiente' }}">
                                            <td class="action-icons text-center">
                                                <a href="{{ route('siniestros.edit', $siniestro) }}" title="Editar"><i class="bi bi-pencil"></i></a>
                                                <a href="{{ route('siniestros.show', $siniestro) }}" title="Ver detalles"><i class="bi bi-eye"></i></a>
                                                <form action="{{ route('siniestros.destroy', $siniestro) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link p-0" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este siniestro?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>{{ $siniestro->numero }}</td>
                                            <td>{{ $siniestro->vehiculo->marca }} {{ $siniestro->vehiculo->modelo }}</td>
                                            <td>{{ $siniestro->vehiculo->matricula }}</td>
                                            <td>{{ $siniestro->cliente->nombre }} {{ $siniestro->cliente->apellidos }}</td>
                                            <td>{{ $siniestro->fecha_entrada->format('d/m/Y') }}</td>
                                            <td>{{ $siniestro->fecha_salida ? $siniestro->fecha_salida->format('d/m/Y') : 'Pendiente' }}</td>
                                            <td>{{ $siniestro->estado }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No hay siniestros registrados.</td>
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