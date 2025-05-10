<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app()->name', 'MiraCar') }} - Nuevo Siniestro</title>
    
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
        
        .form-control.is-valid:focus {
            border-color: var(--success-color);
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
        }
        
        .form-control.is-invalid:focus {
            border-color: var(--danger-color);
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
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
        
        @media (max-width: 767.98px) {
            .container {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
            
            .card-body {
                padding: 1.25rem !important;
            }
            
            .card-title {
                font-size: 1.5rem;
                margin-bottom: 1rem;
                text-align: center;
            }
            
            .row {
                margin-left: -0.5rem;
                margin-right: -0.5rem;
            }
            
            .col-md-6 {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }
            
            .mb-3 {
                margin-bottom: 0.75rem !important;
            }
            
            .mb-4 {
                margin-bottom: 1rem !important;
            }
            
            .my-4 {
                margin-top: 1rem !important;
                margin-bottom: 1rem !important;
            }
            
            .form-control, .form-select {
                font-size: 0.95rem;
                padding: 0.375rem 0.75rem;
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
            
            .alert-danger {
                padding: 0.75rem;
                margin-bottom: 1rem;
            }
            
            .alert-danger ul {
                padding-left: 1rem;
                margin-bottom: 0;
            }
            
            .add-badge {
                width: 30px;
                height: 30px;
                top: -8px;
                right: -8px;
                font-size: 0.9rem;
            }
        }
        
        input[type="date"] {
            position: relative;
        }
        
        input[type="date"].is-valid,
        input[type="date"].is-invalid {
            background-position: right 0.75rem center;
            padding-right: 2.5rem;
        }
        
        @media (min-width: 768px) and (max-width: 991.98px) {
            .card-body {
                padding: 1.75rem !important;
            }
            
            .btn {
                padding: 0.5rem 1.5rem;
            }
        }
        
        @media (hover: none) and (pointer: coarse) {
            .form-control, .form-select {
                padding: 0.5rem 0.75rem;
                font-size: 16px;
            }
            
            .btn {
                padding-top: 0.625rem;
                padding-bottom: 0.625rem;
            }
            
            select.form-select {
                background-position: right 0.75rem center;
                padding-right: 2.25rem;
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
            
            .card-body {
                padding: 1rem !important;
            }
            
            .card-title {
                font-size: 1.25rem;
                margin-bottom: 0.75rem;
            }
            
            .row.mb-3, .mb-3, .mb-4 {
                margin-bottom: 0.5rem !important;
            }
            
            .my-4 {
                margin-top: 0.5rem !important;
                margin-bottom: 0.5rem !important;
            }
            
            .py-4 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }
        }
        
        @media (max-width: 375px) {
            .card-body {
                padding: 1rem !important;
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
        
        .required-field::after {
            content: "*";
            color: red;
            margin-left: 4px;
        }
        
        .input-icon {
            position: relative;
        }
        
        .input-icon i {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 0.75rem;
            color: #6c757d;
        }
        
        .input-icon .form-control,
        .input-icon .form-select {
            padding-left: 2.5rem;
        }
        
        .form-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .form-header i {
            font-size: 1.5rem;
            margin-right: 0.75rem;
            color: var(--primary-color);
        }
        
        @media (max-width: 767.98px) {
            .form-header {
                flex-direction: column;
                text-align: center;
            }
            
            .form-header i {
                margin-right: 0;
                margin-bottom: 0.5rem;
                font-size: 1.75rem;
            }
        }
        
        .btn-group-responsive {
            display: flex;
            gap: 0.5rem;
        }
        
        @media (max-width: 767.98px) {
            .btn-group-responsive {
                flex-direction: column;
                width: 100%;
            }
            
            .btn-group-responsive .btn {
                width: 100%;
            }
        }
        
        @media (max-width: 767.98px) {
            textarea.form-control {
                min-height: 100px;
            }
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
                            <div class="form-header">
                                <i class="bi bi-car-front-fill d-none d-sm-inline-block"></i>
                                <h2 class="card-title mb-3 mb-md-4">Nuevo Siniestro</h2>
                            </div>
                            
                            @if ($errors->any())
                                <div class="alert alert-danger mb-3">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            <form action="{{ route('siniestros.store') }}" method="POST" id="siniestroForm" class="needs-validation" novalidate>
                                @csrf
                                
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label for="cliente_id" class="form-label required-field">Cliente</label>
                                        <select class="form-select @error('cliente_id') is-invalid @enderror" id="cliente_id" name="cliente_id" required>
                                            <option value="">Seleccionar cliente</option>
                                            @foreach($clientes as $cliente)
                                                <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                                    {{ $cliente->dni }} - {{ $cliente->nombre }} {{ $cliente->apellidos }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            @error('cliente_id')
                                                {{ $message }}
                                            @else
                                                Por favor, seleccione un cliente.
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="vehiculo_id" class="form-label required-field">Vehículo</label>
                                        <select class="form-select @error('vehiculo_id') is-invalid @enderror" id="vehiculo_id" name="vehiculo_id" required>
                                            <option value="">Seleccionar vehículo</option>
                                            @foreach($vehiculos as $vehiculo)
                                                <option value="{{ $vehiculo->id }}" {{ old('vehiculo_id') == $vehiculo->id ? 'selected' : '' }}>
                                                    {{ $vehiculo->matricula }} - {{ $vehiculo->marca }} {{ $vehiculo->modelo }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            @error('vehiculo_id')
                                                {{ $message }}
                                            @else
                                                Por favor, seleccione un vehículo.
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label for="fecha_entrada" class="form-label required-field">Fecha Entrada</label>
                                        <input type="date" class="form-control @error('fecha_entrada') is-invalid @enderror" id="fecha_entrada" name="fecha_entrada" value="{{ old('fecha_entrada', date('Y-m-d')) }}" required>
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            @error('fecha_entrada')
                                                {{ $message }}
                                            @else
                                                La fecha debe ser hoy o posterior.
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="fecha_salida" class="form-label">Fecha Salida</label>
                                        <input type="date" class="form-control @error('fecha_salida') is-invalid @enderror" id="fecha_salida" name="fecha_salida" value="{{ old('fecha_salida') }}">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            @error('fecha_salida')
                                                {{ $message }}
                                            @else
                                                La fecha debe ser igual o posterior a la fecha de entrada.
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="estado" class="form-label">Estado</label>
                                    <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado">
                                        <option value="Pendiente" {{ old('estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        <option value="En proceso" {{ old('estado') == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                                        <option value="Finalizado" {{ old('estado') == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                                    </select>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">
                                        @error('estado')
                                            {{ $message }}
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="descripcion" class="form-label required-field">Descripción</label>
                                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion') }}</textarea>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">
                                        @error('descripcion')
                                            {{ $message }}
                                        @else
                                            La descripción debe contener al menos una palabra de más de un carácter.
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-center flex-column flex-md-row">
                                    <a href="{{ route('siniestros.index') }}" class="btn btn-secondary me-md-2 order-2 order-md-1">
                                        <i class="bi bi-arrow-left me-1"></i>Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-primary mb-3 mb-md-0 order-1 order-md-2">
                                        <i class="bi bi-check2-circle me-1"></i>Guardar Siniestro
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('siniestroForm');
            const inputs = form.querySelectorAll('input, textarea, select');
            
            const clienteSelect = document.getElementById('cliente_id');
            const vehiculoSelect = document.getElementById('vehiculo_id');
            const fechaEntrada = document.getElementById('fecha_entrada');
            const fechaSalida = document.getElementById('fecha_salida');
            const descripcion = document.getElementById('descripcion');
            const estadoSelect = document.getElementById('estado');
            
            const today = new Date().toISOString().split('T')[0];
            fechaEntrada.setAttribute('min', today);
            
            function validarDescripcion(texto) {
                const textoLimpio = texto.trim();
                
                const palabras = textoLimpio.split(/\s+/);
                for (let i = 0; i < palabras.length; i++) {
                    if (palabras[i].length > 1) {
                        return true;
                    }
                }
                
                return false;
            }
            
            function validateField(input) {
                let isValid = true;
                
                switch(input.id) {
                    case 'cliente_id':
                        isValid = input.value !== '';
                        break;
                        
                    case 'vehiculo_id':
                        isValid = input.value !== '';
                        break;
                        
                    case 'fecha_entrada':
                        isValid = input.value !== '' && input.value >= today;
                        break;
                        
                    case 'fecha_salida':
                        if (input.value === '') {
                            return true;
                        }
                        isValid = input.value >= fechaEntrada.value;
                        break;
                        
                    case 'descripcion':
                        isValid = validarDescripcion(input.value);
                        break;
                        
                    case 'estado':
                        isValid = true;
                        break;
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
            
            form.addEventListener('submit', function(event) {
                let formValid = true;
                
                inputs.forEach(function(input) {
                    if (input.required || input.value.trim() !== '') {
                        const fieldValid = validateField(input);
                        formValid = formValid && fieldValid;
                    }
                });
                
                if (!formValid) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                
                form.classList.add('was-validated');
            });
            
            inputs.forEach(function(input) {
                input.addEventListener('input', function() {
                    validateField(this);
                });
                
                input.addEventListener('blur', function() {
                    validateField(this);
                });
                
                if (input.value.trim() !== '') {
                    validateField(input);
                }
            });
            
            fechaEntrada.addEventListener('change', function() {
                validateField(this);
                
                if (fechaSalida) {
                    fechaSalida.setAttribute('min', this.value);
                    
                    if (fechaSalida.value && fechaSalida.value < this.value) {
                        fechaSalida.value = '';
                        fechaSalida.classList.remove('is-valid');
                        fechaSalida.classList.remove('is-invalid');
                    } else if (fechaSalida.value) {
                        validateField(fechaSalida);
                    }
                }
            });
            
            if (fechaSalida) {
                fechaSalida.addEventListener('change', function() {
                    validateField(this);
                });
                
                if (fechaEntrada.value) {
                    fechaSalida.setAttribute('min', fechaEntrada.value);
                } else {
                    fechaSalida.setAttribute('min', today);
                }
            }
            
            if ('ontouchstart' in window) {
                const buttons = document.querySelectorAll('.btn');
                buttons.forEach(button => {
                    button.addEventListener('touchstart', function() {
                        this.style.opacity = '0.7';
                    });
                    
                    button.addEventListener('touchend', function() {
                        this.style.opacity = '1';
                    });
                });
                
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
                
                const selects = document.querySelectorAll('select.form-select');
                selects.forEach(select => {
                    select.addEventListener('change', function() {
                        const selectedOption = this.options[this.selectedIndex];
                        if (selectedOption.textContent.length > 30) {
                            this.title = selectedOption.textContent;
                        } else {
                            this.title = '';
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>