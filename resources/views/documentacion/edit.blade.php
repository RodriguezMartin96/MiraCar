<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Editar Documento - {{ config('app.name', 'MiraCar') }}</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
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
        
        .form-label {
            font-weight: 500;
            color: #555;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(79, 140, 255, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.5rem 2rem;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            padding: 0.5rem 2rem;
            font-weight: 500;
        }
        
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c2c7;
        }
        
        .nav-tabs {
            border-bottom: 1px solid #dee2e6;
        }
        
        .nav-tabs .nav-link {
            margin-bottom: -1px;
            border: 1px solid transparent;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
            color: #6c757d;
            font-weight: 500;
        }
        
        .nav-tabs .nav-link.active {
            color: white;
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .nav-tabs .nav-link:hover:not(.active) {
            background-color: #f8f9fa;
            border-color: #e9ecef #e9ecef #dee2e6;
        }
        
        .current-file {
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        
        .file-icon {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
    <!-- Incluir la barra de navegación -->
    @include('layouts.navigation')

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body p-0">
                        <!-- Pestañas de navegación -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="{{ route('dashboard') }}">Inicio</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="{{ route('clientes.index') }}">Cliente</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="{{ route('vehiculos.index') }}">Vehículo</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="{{ route('siniestros.index') }}">Siniestros Vehículos</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="{{ route('recambios.index') }}">Recambios Stock</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="{{ route('soporte.create') }}">Soporte</a>
                            </li>
                        </ul>
                        
                        <!-- Contenido del formulario -->
                        <div class="p-4">
                            <h2 class="card-title mb-4">Editar Documento</h2>
                            
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            <form action="{{ route('documentos.update', $documento) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <select class="form-select" id="nombre" name="nombre">
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria }}" {{ old('nombre', $documento->nombre) == $categoria ? 'selected' : '' }}>{{ $categoria }}</option>
                                        @endforeach
                                        <option value="otro" {{ old('nombre', $documento->nombre) == 'otro' ? 'selected' : '' }}>Otro...</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3" id="otroNombreDiv" style="{{ old('nombre', $documento->nombre) == 'otro' ? 'display: block;' : 'display: none;' }}">
                                    <label for="otroNombre" class="form-label">Especificar otro nombre</label>
                                    <input type="text" class="form-control" id="otroNombre" name="otroNombre" value="{{ old('otroNombre', $documento->otro_nombre) }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <select class="form-select" id="descripcion" name="descripcion">
                                        @foreach($descripciones as $desc)
                                            <option value="{{ $desc }}" {{ old('descripcion', $documento->descripcion) == $desc ? 'selected' : '' }}>{{ $desc }}</option>
                                        @endforeach
                                        <option value="otro" {{ old('descripcion', $documento->descripcion) == 'otro' ? 'selected' : '' }}>Otro...</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3" id="otraDescripcionDiv" style="{{ old('descripcion', $documento->descripcion) == 'otro' ? 'display: block;' : 'display: none;' }}">
                                    <label for="otraDescripcion" class="form-label">Especificar otra descripción</label>
                                    <input type="text" class="form-control" id="otraDescripcion" name="otraDescripcion" value="{{ old('otraDescripcion', $documento->otra_descripcion) }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="formato" class="form-label">Formato</label>
                                    <input type="text" class="form-control" id="formato" name="formato" value="{{ old('formato', $documento->formato) }}">
                                </div>
                                
                                <div class="mb-4">
                                    <label for="archivo" class="form-label">Archivo</label>
                                    
                                    @if($documento->ruta_archivo)
                                        <div class="current-file d-flex align-items-center">
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
                                            
                                            <i class="bi {{ $iconClass }} file-icon"></i>
                                            <span>{{ basename($documento->ruta_archivo) }}</span>
                                        </div>
                                    @endif
                                    
                                    <input type="file" class="form-control" id="archivo" name="archivo">
                                    <div class="form-text">
                                        @if($documento->ruta_archivo)
                                            Sube un nuevo archivo para reemplazar el actual, o deja este campo vacío para mantener el archivo actual.
                                        @else
                                            Formatos permitidos: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG. Tamaño máximo: 10MB.
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('documentos.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Script para mostrar/ocultar campos adicionales
        document.addEventListener('DOMContentLoaded', function() {
            const nombreSelect = document.getElementById('nombre');
            const otroNombreDiv = document.getElementById('otroNombreDiv');
            const otroNombreInput = document.getElementById('otroNombre');
            const descripcionSelect = document.getElementById('descripcion');
            const otraDescripcionDiv = document.getElementById('otraDescripcionDiv');
            const otraDescripcionInput = document.getElementById('otraDescripcion');
            
            nombreSelect.addEventListener('change', function() {
                if (this.value === 'otro') {
                    otroNombreDiv.style.display = 'block';
                    otroNombreInput.focus();
                } else {
                    otroNombreDiv.style.display = 'none';
                }
            });
            
            descripcionSelect.addEventListener('change', function() {
                if (this.value === 'otro') {
                    otraDescripcionDiv.style.display = 'block';
                    otraDescripcionInput.focus();
                } else {
                    otraDescripcionDiv.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>