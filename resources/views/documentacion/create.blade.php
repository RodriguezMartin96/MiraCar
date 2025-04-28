<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Agregar Documento - {{ config('app.name', 'MiraCar') }}</title>
    
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
        
        /* Centrar texto */
        .text-center {
            text-align: center;
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
                        <!-- Contenido del formulario -->
                        <div class="p-4">
                            <h2 class="card-title mb-4 text-center">Agregar Documento</h2>
                            
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            <form action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <select class="form-select" id="nombre" name="nombre">
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria }}" {{ old('nombre') == $categoria ? 'selected' : '' }}>{{ $categoria }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3" id="otroNombreDiv" style="{{ old('nombre') == 'otro' ? 'display: block;' : 'display: none;' }}">
                                    <label for="otroNombre" class="form-label">Especificar otro nombre</label>
                                    <input type="text" class="form-control" id="otroNombre" name="otroNombre" value="{{ old('otroNombre') }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <select class="form-select" id="descripcion" name="descripcion">
                                        @foreach($descripciones as $desc)
                                            <option value="{{ $desc }}" {{ old('descripcion') == $desc ? 'selected' : '' }}>{{ $desc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3" id="otraDescripcionDiv" style="{{ old('descripcion') == 'otro' ? 'display: block;' : 'display: none;' }}">
                                    <label for="otraDescripcion" class="form-label">Especificar otra descripción</label>
                                    <input type="text" class="form-control" id="otraDescripcion" name="otraDescripcion" value="{{ old('otraDescripcion') }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="formato" class="form-label">Formato</label>
                                    <input type="text" class="form-control" id="formato" name="formato" value="{{ old('formato', 'pdf') }}">
                                </div>
                                
                                <div class="mb-4">
                                    <label for="archivo" class="form-label">Archivo</label>
                                    <input type="file" class="form-control" id="archivo" name="archivo" required>
                                    <div class="form-text">Formatos permitidos: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG. Tamaño máximo: 10MB.</div>
                                </div>
                                
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('documentos.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
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
            
            // Verificar estado inicial
            if (nombreSelect.value === 'otro') {
                otroNombreDiv.style.display = 'block';
            }
            
            if (descripcionSelect.value === 'otro') {
                otraDescripcionDiv.style.display = 'block';
            }
        });
    </script>
</body>
</html>