<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Vehículos - {{ config('MiraCar', 'app.name') }}</title>
    
    <link rel="icon" href="{{ asset('galeria/logo.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('galeria/logo.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('galeria/logo.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('galeria/logo.png') }}">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #235390;
            --secondary-color: #4f8cff;
            --light-color: #e3ecff;
            --warning-color: #ffecb3;
            --success-color: #c8e6c9;
            --danger-color: #ffcdd2;
            --process-color: #ffe0b2;
            --border-radius: 0.75rem;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #f8fafc;
            padding-bottom: env(safe-area-inset-bottom);
        }
        
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
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
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .action-icons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .action-icons a, .action-icons button {
            color: var(--primary-color);
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin: 0;
            padding: 0;
            background: transparent;
            border: none;
        }
        
        .action-icons a:hover, .action-icons button:hover {
            color: var(--secondary-color);
            background-color: rgba(79, 140, 255, 0.1);
        }
        
        .action-icons a.edit-icon, .action-icons button.edit-icon {
            color: #0d6efd;
        }
        
        .action-icons a.view-icon, .action-icons button.view-icon {
            color: #198754;
        }
        
        .action-icons a.delete-icon, .action-icons button.delete-icon {
            color: #dc3545;
        }
        
        .action-icons a.edit-icon:hover, .action-icons button.edit-icon:hover {
            background-color: rgba(13, 110, 253, 0.1);
        }
        
        .action-icons a.view-icon:hover, .action-icons button.view-icon:hover {
            background-color: rgba(25, 135, 84, 0.1);
        }
        
        .action-icons a.delete-icon:hover, .action-icons button.delete-icon:hover {
            background-color: rgba(220, 53, 69, 0.1);
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
        
        .table td, .table th {
            text-align: center;
            vertical-align: middle;
        }
        
        .vehicle-card {
            display: none;
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
            padding: 1rem;
            position: relative;
        }
        
        .vehicle-card .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #eee;
        }
        
        .vehicle-card .card-header .numero {
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--primary-color);
        }
        
        .vehicle-card .card-content {
            margin-bottom: 0.75rem;
        }
        
        .vehicle-card .card-content .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }
        
        .vehicle-card .card-content .info-row .label {
            font-weight: 500;
            color: #666;
        }
        
        .vehicle-card .card-content .info-row .value {
            font-weight: 400;
            text-align: right;
        }
        
        .vehicle-card .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0.75rem;
            padding-top: 0.75rem;
            border-top: 1px solid #eee;
        }
        
        .vehicle-card .card-actions {
            display: flex;
            gap: 8px;
        }
        
        .vehicle-card .card-actions a, 
        .vehicle-card .card-actions button {
            color: var(--primary-color);
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin: 0;
            padding: 0;
            background: transparent;
            border: none;
        }
        
        .vehicle-card .card-actions a.edit-icon, 
        .vehicle-card .card-actions button.edit-icon {
            color: #0d6efd;
        }
        
        .vehicle-card .card-actions a.view-icon, 
        .vehicle-card .card-actions button.view-icon {
            color: #198754;
        }
        
        .vehicle-card .card-actions a.delete-icon, 
        .vehicle-card .card-actions button.delete-icon {
            color: #dc3545;
        }
        
        .vehicle-card .card-actions a:hover, 
        .vehicle-card .card-actions button:hover {
            background-color: rgba(79, 140, 255, 0.1);
        }
        
        .vehicle-card .card-actions a.edit-icon:hover, 
        .vehicle-card .card-actions button.edit-icon:hover {
            background-color: rgba(13, 110, 253, 0.1);
        }
        
        .vehicle-card .card-actions a.view-icon:hover, 
        .vehicle-card .card-actions button.view-icon:hover {
            background-color: rgba(25, 135, 84, 0.1);
        }
        
        .vehicle-card .card-actions a.delete-icon:hover, 
        .vehicle-card .card-actions button.delete-icon:hover {
            background-color: rgba(220, 53, 69, 0.1);
        }
        
        .action-icons a, .action-icons button,
        .vehicle-card .card-actions a, .vehicle-card .card-actions button {
            position: relative;
            overflow: hidden;
        }
        
        .action-icons a::after, .action-icons button::after,
        .vehicle-card .card-actions a::after, .vehicle-card .card-actions button::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }
        
        .action-icons a:focus:not(:active)::after, .action-icons button:focus:not(:active)::after,
        .vehicle-card .card-actions a:focus:not(:active)::after, .vehicle-card .card-actions button:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }
        
        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }
            20% {
                transform: scale(25, 25);
                opacity: 0.5;
            }
            100% {
                opacity: 0;
                transform: scale(40, 40);
            }
        }
        
        .floating-action-button {
            display: none;
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            border: none;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .floating-action-button:hover {
            background-color: var(--secondary-color);
            transform: scale(1.05);
        }
        
        @media (max-width: 991.98px) {
            .card-body {
                padding: 1.25rem !important;
            }
            
            .card-title {
                font-size: 1.5rem;
            }
            
            .table th {
                font-size: 0.9rem;
            }
            
            .table td {
                font-size: 0.9rem;
                padding: 0.5rem;
            }
            
            .action-icons a, .action-icons button {
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 767.98px) {
            .container {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
            
            .card-body {
                padding: 1rem !important;
            }
            
            .card-title {
                text-align: center;
                margin-bottom: 1.25rem;
            }
            
            .py-4 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }
            
            .mb-4 {
                margin-bottom: 1rem !important;
            }
            
            .table-responsive {
                display: none;
            }
            
            .vehicle-card {
                display: block;
            }
            
            .floating-action-button {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .desktop-add-button {
                display: none;
            }
            
            .search-container .input-group {
                border-radius: 2rem;
                overflow: hidden;
            }
            
            .search-container .form-control {
                border-radius: 2rem 0 0 2rem;
                padding-left: 1rem;
            }
            
            .search-container .btn {
                border-radius: 0 2rem 2rem 0;
            }
            
            .alert-info {
                font-size: 0.9rem;
                padding: 0.75rem;
            }
            
            .alert-info .float-end {
                float: none !important;
                display: block;
                margin-top: 0.5rem;
            }
            
            .pagination {
                justify-content: center;
            }
            
            .pagination .page-link {
                padding: 0.375rem 0.75rem;
            }
            
            .vehicle-card .card-actions a, 
            .vehicle-card .card-actions button {
                width: 44px;
                height: 44px;
                font-size: 1.25rem;
            }
        }
        
        @media (min-width: 768px) and (max-width: 991.98px) {
            .table th, .table td {
                padding: 0.5rem 0.25rem;
                font-size: 0.85rem;
            }
            
            .action-icons a, .action-icons button {
                width: 28px;
                height: 28px;
            }
            
            .btn {
                padding: 0.375rem 0.75rem;
                font-size: 0.9rem;
            }
        }
        
        @media (hover: none) and (pointer: coarse) {
            .btn {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
                touch-action: manipulation;
            }
            
            .action-icons a, .action-icons button,
            .vehicle-card .card-actions a, .vehicle-card .card-actions button {
                min-height: 44px;
                min-width: 44px;
            }
            
            .pagination .page-link {
                padding: 0.5rem 0.75rem;
                min-width: 40px;
                min-height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }
        
        .alert-info {
            background-color: var(--light-color);
            border-color: var(--secondary-color);
            color: var(--primary-color);
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        @media (max-width: 767.98px) {
            .alert-info {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .alert-info .float-end {
                margin-top: 0.5rem;
                align-self: flex-end;
            }
        }
        
        .pagination {
            gap: 0.25rem;
        }
        
        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .pagination .page-link {
            color: var(--primary-color);
            border-radius: 0.25rem;
        }
        
        .pagination .page-link:hover {
            background-color: var(--light-color);
        }
        
        @media (max-width: 767.98px) {
            .pagination .page-item:not(.active):not(:first-child):not(:last-child):not(.disabled) {
                display: none;
            }
            
            .pagination .page-item.active {
                flex-grow: 1;
            }
            
            .pagination .page-item.active .page-link {
                width: 100%;
                text-align: center;
            }
        }
        
        .delete-modal .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: calc(var(--border-radius) - 1px) calc(var(--border-radius) - 1px) 0 0;
        }
        
        .delete-modal .modal-content {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .delete-modal .modal-footer {
            border-top: 1px solid #f0f0f0;
            padding: 1rem;
        }
        
        .delete-modal .btn-cancel {
            background-color: #f8f9fa;
            border-color: #dee2e6;
            color: #6c757d;
        }
        
        .delete-modal .btn-cancel:hover {
            background-color: #e9ecef;
        }
        
        .delete-modal .btn-delete {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        
        .delete-modal .btn-delete:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        
        .delete-modal .warning-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border-radius: 50%;
            font-size: 1.75rem;
            margin: 0 auto 1.25rem;
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.4);
            }
            70% {
                transform: scale(1.05);
                box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
            }
        }
        
        .delete-modal .modal-body {
            padding: 1.5rem;
            text-align: center;
        }
        
        .delete-modal .vehicle-info {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .delete-modal .modal-footer {
            justify-content: center;
            gap: 1rem;
        }
        
        .delete-modal .modal-footer .btn {
            min-width: 120px;
            border-radius: 0.5rem;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
        }
        
        @media (max-width: 767.98px) {
            .delete-modal .modal-dialog {
                margin: 0.5rem;
            }
            
            .delete-modal .modal-content {
                border-radius: 0.75rem;
            }
            
            .delete-modal .modal-header {
                padding: 0.75rem 1rem;
            }
            
            .delete-modal .modal-body {
                padding: 1.25rem 1rem;
            }
            
            .delete-modal .modal-footer {
                padding: 0.75rem;
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .delete-modal .modal-footer .btn {
                width: 100%;
                margin: 0;
            }
            
            .delete-modal .warning-icon {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
                margin-bottom: 1rem;
            }
        }
        
        .empty-table-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            opacity: 0.7;
        }
    </style>
</head>
<body>
    @include('layouts.navigation')

    <div class="container py-3 py-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 mb-md-4">
                            <h2 class="card-title mb-3 mb-md-0">
                                <i class="bi bi-car-front-fill me-2 d-none d-sm-inline-block"></i>Gestión de Vehículos
                            </h2>
                        </div>
                        
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <div class="search-container mb-3 mb-md-4">
                            <form action="{{ route('vehiculos.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Buscar por marca, modelo, matrícula, dueño..." value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        @if(request('search'))
                            <div class="alert alert-info mb-3 mb-md-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-info-circle me-2"></i>
                                        <span class="d-none d-sm-inline">Mostrando resultados para:</span> 
                                        <strong>"{{ request('search') }}"</strong>
                                    </div>
                                    <a href="{{ route('vehiculos.index') }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-x-circle me-1"></i><span class="d-none d-sm-inline">Limpiar</span>
                                    </a>
                                </div>
                            </div>
                        @endif
                        
                        <div class="mb-3 mb-md-4 desktop-add-button">
                            <a href="{{ route('vehiculos.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg me-1"></i> Agregar Vehículo
                            </a>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="table-header">
                                        <th scope="col" width="150">Acciones</th>
                                        <th scope="col">Marca</th>
                                        <th scope="col">Modelo</th>
                                        <th scope="col">Matrícula</th>
                                        <th scope="col">Dueño</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($vehiculos as $vehiculo)
                                        <tr>
                                            <td class="action-icons">
                                                <a href="{{ route('vehiculos.edit', $vehiculo) }}" title="Editar" class="edit-icon">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="{{ route('vehiculos.show', $vehiculo) }}" title="Ver detalles" class="view-icon">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <button type="button" title="Eliminar" class="delete-icon" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal" 
                                                    data-id="{{ $vehiculo->id }}" 
                                                    data-marca="{{ $vehiculo->marca }}"
                                                    data-modelo="{{ $vehiculo->modelo }}"
                                                    data-matricula="{{ $vehiculo->matricula }}"
                                                    data-dueno="{{ $vehiculo->cliente->nombre }} {{ $vehiculo->cliente->apellidos }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                            <td>{{ $vehiculo->marca }}</td>
                                            <td>{{ $vehiculo->modelo }}</td>
                                            <td>{{ $vehiculo->matricula }}</td>
                                            <td>{{ $vehiculo->cliente->nombre }} {{ $vehiculo->cliente->apellidos }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                <div class="empty-table-icon">
                                                    <i class="bi bi-car-front"></i>
                                                </div>
                                                @if(request('search'))
                                                    No se encontraron vehículos que coincidan con los criterios de búsqueda.
                                                @else
                                                    No hay vehículos registrados.
                                                @endif
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mobile-cards">
                            @forelse($vehiculos as $vehiculo)
                                <div class="vehicle-card">
                                    <div class="card-header">
                                        <div class="numero">{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</div>
                                    </div>
                                    <div class="card-content">
                                        <div class="info-row">
                                            <div class="label">Matrícula:</div>
                                            <div class="value">{{ $vehiculo->matricula }}</div>
                                        </div>
                                        <div class="info-row">
                                            <div class="label">Dueño:</div>
                                            <div class="value">{{ $vehiculo->cliente->nombre }} {{ $vehiculo->cliente->apellidos }}</div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="card-actions">
                                            <a href="{{ route('vehiculos.edit', $vehiculo) }}" title="Editar" class="edit-icon">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="{{ route('vehiculos.show', $vehiculo) }}" title="Ver detalles" class="view-icon">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <button type="button" title="Eliminar" class="delete-icon" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal" 
                                                data-id="{{ $vehiculo->id }}" 
                                                data-marca="{{ $vehiculo->marca }}"
                                                data-modelo="{{ $vehiculo->modelo }}"
                                                data-matricula="{{ $vehiculo->matricula }}"
                                                data-dueno="{{ $vehiculo->cliente->nombre }} {{ $vehiculo->cliente->apellidos }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                        
                        @if($vehiculos->hasPages())
                            <div class="d-flex justify-content-center mt-3 mt-md-4">
                                {{ $vehiculos->appends(['search' => request('search')])->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <a href="{{ route('vehiculos.create') }}" class="floating-action-button">
        <i class="bi bi-plus-lg"></i>
    </a>

    <div class="modal fade delete-modal" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="warning-icon">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <p>¿Estás seguro de que deseas eliminar el vehículo <span class="vehicle-info" id="vehicleInfo"></span>?</p>
                    <p class="mb-1">Matrícula: <span class="vehicle-info" id="vehicleMatricula"></span></p>
                    <p>Propietario: <span class="vehicle-info" id="vehicleDueno"></span></p>
                    <p class="text-muted small mt-3">Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteModal = document.getElementById('deleteModal');
            if (deleteModal) {
                deleteModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const id = button.getAttribute('data-id');
                    const marca = button.getAttribute('data-marca');
                    const modelo = button.getAttribute('data-modelo');
                    const matricula = button.getAttribute('data-matricula');
                    const dueno = button.getAttribute('data-dueno');
                    
                    document.getElementById('vehicleInfo').textContent = marca + ' ' + modelo;
                    document.getElementById('vehicleMatricula').textContent = matricula;
                    document.getElementById('vehicleDueno').textContent = dueno;
                    
                    const deleteForm = document.getElementById('deleteForm');
                    if (deleteForm) {
                        deleteForm.action = `{{ route('vehiculos.destroy', '') }}/${id}`;
                    }
                });
                
                deleteModal.addEventListener('shown.bs.modal', function() {
                    const iconBox = this.querySelector('.warning-icon');
                    iconBox.style.animation = 'pulse 1s';
                });
            }
            
            if ('ontouchstart' in window) {
                const buttons = document.querySelectorAll('.btn, .card-actions a, .card-actions button, .action-icons a, .action-icons button');
                buttons.forEach(button => {
                    button.addEventListener('touchstart', function() {
                        this.style.opacity = '0.7';
                    });
                    
                    button.addEventListener('touchend', function() {
                        this.style.opacity = '1';
                    });
                });
            }
            
            const actionButtons = document.querySelectorAll('.action-icons a, .action-icons button, .card-actions a, .card-actions button');
            
            actionButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const ripple = document.createElement('span');
                    ripple.style.position = 'absolute';
                    ripple.style.width = '1px';
                    ripple.style.height = '1px';
                    ripple.style.borderRadius = '50%';
                    ripple.style.backgroundColor = 'rgba(255, 255, 255, 0.7)';
                    ripple.style.transform = 'scale(0)';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.style.animation = 'ripple-effect 0.6s linear';
                    
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });
        
        document.head.insertAdjacentHTML('beforeend', `
            <style>
                @keyframes ripple-effect {
                    0% {
                        transform: scale(0, 0);
                        opacity: 0.5;
                    }
                    100% {
                        transform: scale(35);
                        opacity: 0;
                    }
                }
            </style>
        `);
    </script>
</body>
</html>