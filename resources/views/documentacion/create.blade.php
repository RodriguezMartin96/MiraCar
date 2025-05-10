<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'MiraCar') }} - Documento</title>
    
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
            --success-color: #198754;
            --danger-color: #dc3545;
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
        
        .form-control.is-valid {
            border-color: var(--success-color);
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        
        .form-control.is-invalid {
            border-color: var(--danger-color);
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        
        .form-select.is-valid {
            border-color: var(--success-color);
            padding-right: 4.125rem;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e"), url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
            background-position: right 0.75rem center, center right 2.25rem;
            background-size: 16px 12px, calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        
        .form-select.is-invalid {
            border-color: var(--danger-color);
            padding-right: 4.125rem;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e"), url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-position: right 0.75rem center, center right 2.25rem;
            background-size: 16px 12px, calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        
        .valid-feedback {
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: var(--success-color);
        }
        
        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: var(--danger-color);
        }
        
        .was-validated .form-control:valid, .form-control.is-valid {
            border-color: var(--success-color);
        }
        
        .was-validated .form-control:invalid, .form-control.is-invalid {
            border-color: var(--danger-color);
        }
        
        .was-validated .form-control:valid ~ .valid-feedback,
        .was-validated .form-control:valid ~ .valid-tooltip, 
        .form-control.is-valid ~ .valid-feedback,
        .form-control.is-valid ~ .valid-tooltip {
            display: none;
        }
        
        .was-validated .form-control:invalid ~ .invalid-feedback,
        .was-validated .form-control:invalid ~ .invalid-tooltip, 
        .form-control.is-invalid ~ .invalid-feedback,
        .form-control.is-invalid ~ .invalid-tooltip {
            display: block;
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
        
        .text-center {
            text-align: center;
        }
        
        .add-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            z-index: 10;
        }
        
        .card-container {
            position: relative;
        }
        
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        .card-body {
            padding: 0;
        }
        
        .form-content {
            padding: 1.5rem;
        }
        
        @media (max-width: 767.98px) {
            .container {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
            
            .form-content {
                padding: 1.25rem;
            }
            
            .card-title {
                font-size: 1.5rem;
                margin-bottom: 1rem;
            }
            
            .mb-3 {
                margin-bottom: 0.75rem !important;
            }
            
            .mb-4 {
                margin-bottom: 1rem !important;
            }
            
            .form-control, .form-select {
                font-size: 0.95rem;
                padding: 0.375rem 0.75rem;
            }
            
            .form-text {
                font-size: 0.8rem;
            }
            
            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
                padding: 0.5rem 1rem;
            }
            
            .d-flex.justify-content-center {
                flex-direction: column;
            }
            
            .me-2 {
                margin-right: 0 !important;
            }
            
            .add-badge {
                width: 30px;
                height: 30px;
                font-size: 0.9rem;
            }
        }
        
        @media (min-width: 768px) and (max-width: 991.98px) {
            .form-content {
                padding: 1.75rem;
            }
            
            .btn {
                padding: 0.5rem 1.5rem;
            }
        }
        
        @media (hover: none) and (pointer: coarse) {
            .form-control, .form-select {
                padding: 0.5rem 0.75rem;
            }
            
            .btn {
                padding-top: 0.625rem;
                padding-bottom: 0.625rem;
            }
            
            input[type="file"] {
                padding: 0.75rem;
            }
            
            input[type="file"]::file-selector-button {
                padding: 0.5rem 1rem;
            }
        }
        
        .btn {
            transition: all 0.2s ease;
        }
        
        .btn:active {
            transform: scale(0.97);
        }
        
        @media (max-height: 500px) and (orientation: landscape) {
            .container {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
            }
            
            .form-content {
                padding: 1rem;
            }
            
            .card-title {
                font-size: 1.25rem;
                margin-bottom: 0.75rem;
            }
            
            .mb-3 {
                margin-bottom: 0.5rem !important;
            }
            
            .mb-4 {
                margin-bottom: 0.75rem !important;
            }
            
            .py-4 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }
        }
        
        @media (max-width: 375px) {
            .form-content {
                padding: 1rem;
            }
            
            .card-title {
                font-size: 1.25rem;
            }
            
            .form-label {
                font-size: 0.9rem;
            }
            
            .form-control, .form-select {
                font-size: 0.9rem;
                padding: 0.3rem 0.6rem;
            }
            
            .btn {
                font-size: 0.9rem;
            }
        }
        
        .file-input-container {
            position: relative;
        }
        
        .form-control[type="file"] {
            padding: 0.375rem;
        }
        
        .form-control[type="file"]::file-selector-button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 0.25rem;
            padding: 0.375rem 0.75rem;
            margin-right: 0.75rem;
            transition: background-color 0.2s;
        }
        
        .form-control[type="file"]::file-selector-button:hover {
            background-color: var(--secondary-color);
        }
        
        @media (max-width: 767.98px) {
            .action-buttons {
                display: flex;
                flex-direction: column;
                width: 100%;
            }
            
            .action-buttons .btn {
                margin-right: 0;
                margin-bottom: 0.5rem;
            }
            
            .action-buttons .btn:last-child {
                margin-bottom: 0;
                order: -1;
            }
        }
        
        .required-field::after {
            content: "*";
            color: red;
            margin-left: 4px;
        }
    </style>
</head>
<body>
    @include('layouts.navigation')

    <div class="container py-3 py-md-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card-container">
                    <div class="card">
                        <div class="add-badge d-flex">
                            <i class="bi bi-plus-lg"></i>
                        </div>
                        <div class="card-body">
                            <div class="form-content">
                                <h2 class="card-title mb-3 mb-md-4 text-center">
                                    <i class="bi bi-file-earmark-plus me-2 d-none d-sm-inline-block"></i>Agregar Documento
                                </h2>
                                
                                @if ($errors->any())
                                    <div class="alert alert-danger mb-3">
                                        <ul class="mb-0 ps-3">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                
                                <form action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data" id="documentoForm" class="needs-validation" novalidate>
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label required-field">Nombre</label>
                                        <select class="form-select @error('nombre') is-invalid @enderror" id="nombre" name="nombre" required>
                                            @foreach($categorias as $categoria)
                                                <option value="{{ $categoria }}" {{ old('nombre') == $categoria ? 'selected' : '' }}>{{ $categoria }}</option>
                                            @endforeach
                                        </select>
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            @error('nombre')
                                                {{ $message }}
                                            @else
                                                Por favor, seleccione un nombre para el documento.
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3" id="otroNombreDiv" style="{{ old('nombre') == 'otro' ? 'display: block;' : 'display: none;' }}">
                                        <label for="otroNombre" class="form-label required-field">Especificar otro nombre</label>
                                        <input type="text" class="form-control @error('otroNombre') is-invalid @enderror" id="otroNombre" name="otroNombre" value="{{ old('otroNombre') }}" minlength="1">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            @error('otroNombre')
                                                {{ $message }}
                                            @else
                                                Por favor, especifique un nombre para el documento (mínimo 1 carácter).
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="descripcion" class="form-label required-field">Descripción</label>
                                        <select class="form-select @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" required>
                                            @foreach($descripciones as $desc)
                                                <option value="{{ $desc }}" {{ old('descripcion') == $desc ? 'selected' : '' }}>{{ $desc }}</option>
                                            @endforeach
                                        </select>
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            @error('descripcion')
                                                {{ $message }}
                                            @else
                                                Por favor, seleccione una descripción para el documento.
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3" id="otraDescripcionDiv" style="{{ old('descripcion') == 'otro' ? 'display: block;' : 'display: none;' }}">
                                        <label for="otraDescripcion" class="form-label required-field">Especificar otra descripción</label>
                                        <input type="text" class="form-control @error('otraDescripcion') is-invalid @enderror" id="otraDescripcion" name="otraDescripcion" value="{{ old('otraDescripcion') }}" minlength="1">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            @error('otraDescripcion')
                                                {{ $message }}
                                            @else
                                                Por favor, especifique una descripción para el documento (mínimo 1 carácter).
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="archivo" class="form-label required-field">Archivo</label>
                                        <div class="file-input-container">
                                            <input type="file" class="form-control @error('archivo') is-invalid @enderror" id="archivo" name="archivo" required>
                                        </div>
                                        <div class="form-text mt-1">
                                            <i class="bi bi-info-circle me-1"></i>Formatos permitidos: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG. Tamaño máximo: 10MB.
                                        </div>
                                        <div class="invalid-feedback">
                                            @error('archivo')
                                                {{ $message }}
                                            @else
                                                Por favor, seleccione un archivo.
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="action-buttons d-flex justify-content-center">
                                        <a href="{{ route('documentos.index') }}" class="btn btn-secondary me-md-2">
                                            <i class="bi bi-arrow-left me-1"></i>Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-save me-1"></i>Guardar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('documentoForm');
            const nombreSelect = document.getElementById('nombre');
            const otroNombreDiv = document.getElementById('otroNombreDiv');
            const otroNombreInput = document.getElementById('otroNombre');
            const descripcionSelect = document.getElementById('descripcion');
            const otraDescripcionDiv = document.getElementById('otraDescripcionDiv');
            const otraDescripcionInput = document.getElementById('otraDescripcion');
            const archivoInput = document.getElementById('archivo');
            
            function validateField(input) {
                let isValid = true;
                
                if (input.id === 'otroNombre') {
                    if (nombreSelect.value === 'otro') {
                        isValid = input.value.trim().length >= 1;
                    } else {
                        return true;
                    }
                } else if (input.id === 'otraDescripcion') {
                    if (descripcionSelect.value === 'otro') {
                        isValid = input.value.trim().length >= 1;
                    } else {
                        return true;
                    }
                } else if (input.id === 'archivo') {
                    isValid = input.files.length > 0;
                }
                
                if (input.required && input.value.trim() === '') {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    return false;
                } else if (isValid) {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                    return true;
                } else {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    return false;
                }
            }
            
            nombreSelect.addEventListener('change', function() {
                if (this.value === 'otro') {
                    otroNombreDiv.style.display = 'block';
                    otroNombreInput.required = true;
                    otroNombreInput.focus();
                } else {
                    otroNombreDiv.style.display = 'none';
                    otroNombreInput.required = false;
                    otroNombreInput.value = '';
                    otroNombreInput.classList.remove('is-invalid');
                    otroNombreInput.classList.remove('is-valid');
                }
            });
            
            descripcionSelect.addEventListener('change', function() {
                if (this.value === 'otro') {
                    otraDescripcionDiv.style.display = 'block';
                    otraDescripcionInput.required = true;
                    otraDescripcionInput.focus();
                } else {
                    otraDescripcionDiv.style.display = 'none';
                    otraDescripcionInput.required = false;
                    otraDescripcionInput.value = '';
                    otraDescripcionInput.classList.remove('is-invalid');
                    otraDescripcionInput.classList.remove('is-valid');
                }
            });
            
            form.addEventListener('submit', function(event) {
                let formValid = true;
                
                if (nombreSelect.value === 'otro') {
                    const otroNombreValid = validateField(otroNombreInput);
                    formValid = formValid && otroNombreValid;
                }
                
                if (descripcionSelect.value === 'otro') {
                    const otraDescripcionValid = validateField(otraDescripcionInput);
                    formValid = formValid && otraDescripcionValid;
                }
                
                const archivoValid = validateField(archivoInput);
                formValid = formValid && archivoValid;
                
                if (!formValid) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                
                form.classList.add('was-validated');
            });
            
            otroNombreInput.addEventListener('input', function() {
                if (nombreSelect.value === 'otro') {
                    validateField(this);
                }
            });
            
            otraDescripcionInput.addEventListener('input', function() {
                if (descripcionSelect.value === 'otro') {
                    validateField(this);
                }
            });
            
            archivoInput.addEventListener('change', function() {
                validateField(this);
            });
            
            if (nombreSelect.value === 'otro') {
                otroNombreDiv.style.display = 'block';
                otroNombreInput.required = true;
            } else {
                otroNombreInput.required = false;
            }
            
            if (descripcionSelect.value === 'otro') {
                otraDescripcionDiv.style.display = 'block';
                otraDescripcionInput.required = true;
            } else {
                otraDescripcionInput.required = false;
            }
            
            if ('ontouchstart' in window) {
                if (archivoInput) {
                    archivoInput.addEventListener('touchstart', function() {
                        this.click();
                    });
                }
                
                function adjustForLandscape() {
                    if (window.innerHeight < 500 && window.innerWidth > window.innerHeight) {
                        document.body.classList.add('landscape-mode');
                    } else {
                        document.body.classList.remove('landscape-mode');
                    }
                }
                
                adjustForLandscape();
                window.addEventListener('resize', adjustForLandscape);
                window.addEventListener('orientationchange', adjustForLandscape);
            }
        });
    </script>
</body>
</html>