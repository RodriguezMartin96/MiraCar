<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'MiraCar') }} - Nuevo Vehículo</title>
    
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
            transition: var(--transition);
        }
        
        .card-title {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 1.5rem;
        }
        
        .form-label {
            font-weight: 500;
            color: #555;
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            border-radius: var(--border-radius);
            padding: 0.625rem 0.75rem;
            border: 1px solid #ced4da;
            transition: var(--transition);
            font-size: 16px;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(79, 140, 255, 0.25);
        }
        
        .btn {
            border-radius: var(--border-radius);
            padding: 0.625rem 1.5rem;
            font-weight: 500;
            transition: var(--transition);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        
        .btn-secondary:hover, .btn-secondary:focus {
            background-color: #5a6268;
            border-color: #545b62;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c2c7;
            border-radius: var(--border-radius);
        }
        
        .form-control.is-valid, .form-select.is-valid {
            border-color: var(--success-color);
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        
        .form-control.is-invalid, .form-select.is-invalid {
            border-color: var(--danger-color);
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        
        .form-select.is-valid {
            padding-right: 4.125rem;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e"), url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
            background-position: right 0.75rem center, center right 2.25rem;
            background-size: 16px 12px, calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        
        .form-select.is-invalid {
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
        
        @media (max-width: 767.98px) {
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }
            
            .card-body {
                padding: 1.25rem;
            }
            
            .card-title {
                font-size: 1.25rem;
                margin-bottom: 1rem;
                text-align: center;
            }
            
            .form-label {
                font-size: 0.95rem;
            }
            
            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
                min-height: 44px;
            }
            
            .d-flex {
                flex-direction: column;
            }
            
            .me-2 {
                margin-right: 0 !important;
            }
            
            .form-group-spacing {
                margin-bottom: 1rem;
            }
            
            .form-buttons {
                flex-direction: column;
            }
            
            .add-badge.d-none.d-md-flex {
                display: flex !important;
                width: 30px;
                height: 30px;
                top: -8px;
                right: -8px;
                font-size: 0.9rem;
            }
            
            .invalid-feedback {
                font-size: 0.8rem;
                margin-top: 0.2rem;
            }
            
            .form-control, .form-select {
                padding: 0.5rem 0.75rem;
                min-height: 44px;
            }
            
            .row {
                margin-left: -8px;
                margin-right: -8px;
            }
            
            .col-12, .col-md-6 {
                padding-left: 8px;
                padding-right: 8px;
            }
            
            .field-icon {
                width: 16px;
                height: 16px;
                margin-right: 0.2rem;
            }
        }
        
        @media (min-width: 768px) and (max-width: 991.98px) {
            .card-body {
                padding: 1.5rem;
            }
            
            .btn {
                padding: 0.5rem 1.25rem;
                min-height: 44px;
            }
            
            .form-group-spacing {
                margin-bottom: 1.25rem;
            }
            
            .form-control, .form-select {
                padding: 0.5rem 0.75rem;
                min-height: 44px;
            }
            
            .row {
                margin-left: -10px;
                margin-right: -10px;
            }
            
            .col-12, .col-md-6 {
                padding-left: 10px;
                padding-right: 10px;
            }
            
            .form-select {
                text-overflow: ellipsis;
            }
        }
        
        @media (hover: none) and (pointer: coarse) {
            .form-control, .form-select, .btn {
                font-size: 16px;
                min-height: 44px;
            }
            
            .btn:active {
                transform: scale(0.98);
            }
            
            .form-label {
                margin-bottom: 0.5rem;
            }
            
            .form-group-spacing {
                margin-bottom: 1.25rem;
            }
            
            .btn, .form-control, .form-select {
                touch-action: manipulation;
            }
            
            .form-control:active, .form-select:active {
                background-color: #f8f9fa;
            }
        }
        
        @media (max-height: 500px) and (orientation: landscape) {
            .container {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
                max-width: 100%;
            }
            
            .card-body {
                padding: 1rem;
            }
            
            .row.mb-3 {
                margin-bottom: 0.5rem !important;
            }
            
            .mb-4 {
                margin-bottom: 1rem !important;
            }
            
            .form-buttons {
                flex-direction: row;
                justify-content: center;
            }
            
            .form-buttons .btn {
                width: auto;
                margin: 0 0.5rem;
            }
            
            .form-group-spacing {
                margin-bottom: 0.75rem;
            }
            
            .card-title {
                font-size: 1.2rem;
                margin-bottom: 0.75rem;
            }
            
            .form-control, .form-select {
                padding: 0.4rem 0.6rem;
            }
            
            .invalid-feedback {
                font-size: 0.75rem;
                margin-top: 0.1rem;
            }
        }
        
        .form-group-spacing {
            margin-bottom: 1.5rem;
        }
        
        .form-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
        
        .btn {
            position: relative;
            overflow: hidden;
        }
        
        .btn::after {
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
        
        .btn:focus:not(:active)::after {
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
        
        .form-control:focus, .form-select:focus, .btn:focus {
            outline: 2px solid var(--secondary-color);
            outline-offset: 2px;
        }
        
        .required-field::after {
            content: "*";
            color: red;
            margin-left: 4px;
        }
        
        .field-icon {
            color: var(--primary-color);
            margin-right: 0.25rem;
        }
        
        @media (prefers-reduced-motion: reduce) {
            * {
                transition: none !important;
                animation: none !important;
            }
        }
        
        @media (prefers-contrast: more) {
            .form-label {
                color: #000;
                font-weight: 700;
            }
            
            .card-title {
                color: #000;
            }
            
            .required-field::after {
                font-size: 1.2em;
            }
            
            .form-control, .form-select {
                border-width: 2px;
            }
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(35, 83, 144, 0.4);
            }
            70% {
                transform: scale(1.05);
                box-shadow: 0 0 0 10px rgba(35, 83, 144, 0);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(35, 83, 144, 0);
            }
        }
        
        @media (prefers-reduced-motion: reduce) {
            .add-badge {
                animation: none;
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
                        <div class="card-body p-3 p-md-4">
                            <h2 class="card-title mb-3 mb-md-4 text-center text-md-start">
                                <i class="bi bi-car-front me-2 d-none d-sm-inline-block"></i>Nuevo Vehículo
                            </h2>
                            
                            @if ($errors->any())
                                <div class="alert alert-danger mb-4">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            <form action="{{ route('vehiculos.store') }}" method="POST" id="vehiculoForm" class="needs-validation" novalidate>
                                @csrf
                                
                                <div class="row form-group-spacing">
                                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                                        <label for="marca" class="form-label required-field">
                                            <i class="bi bi-car-front-fill field-icon"></i>Marca
                                        </label>
                                        <input type="text" class="form-control @error('marca') is-invalid @enderror" 
                                               id="marca" name="marca" value="{{ old('marca') }}" 
                                               placeholder="Ej: Bmw" required minlength="1" pattern="[A-Za-z0-9\s]+"
                                               autocomplete="off" inputmode="text">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            @error('marca')
                                                {{ $message }}
                                            @else
                                                La marca es obligatoria y solo puede contener letras, números y espacios.
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-md-6">
                                        <label for="modelo" class="form-label required-field">
                                            <i class="bi bi-car-front-fill field-icon"></i>Modelo
                                        </label>
                                        <input type="text" class="form-control @error('modelo') is-invalid @enderror" 
                                               id="modelo" name="modelo" value="{{ old('modelo') }}" 
                                               placeholder="Ej: X3" required minlength="1" pattern="[A-Za-z0-9\s]+"
                                               autocomplete="off" inputmode="text">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            @error('modelo')
                                                {{ $message }}
                                            @else
                                                El modelo es obligatorio y solo puede contener letras, números y espacios.
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row form-group-spacing">
                                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                                        <label for="matricula" class="form-label required-field">
                                            <i class="bi bi-credit-card-fill field-icon"></i>Matrícula
                                        </label>
                                        <input type="text" class="form-control @error('matricula') is-invalid @enderror" 
                                               id="matricula" name="matricula" value="{{ old('matricula') }}" 
                                               placeholder="Ej: AA0000AA" required
                                               autocomplete="off" inputmode="text">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            @error('matricula')
                                                {{ $message }}
                                            @else
                                                La matrícula debe tener uno de estos formatos: AA0000AA, 0000AAA o AAA0000.
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-md-6">
                                        <label for="bastidor" class="form-label">
                                            <i class="bi bi-upc-scan field-icon"></i>Bastidor
                                        </label>
                                        <input type="text" class="form-control @error('bastidor') is-invalid @enderror" 
                                               id="bastidor" name="bastidor" value="{{ old('bastidor') }}" 
                                               placeholder="Ej: WAUZZZ8V5KA123456"
                                               autocomplete="off" inputmode="text">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            @error('bastidor')
                                                {{ $message }}
                                            @else
                                                El bastidor solo puede contener letras y números.
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row form-group-spacing">
                                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                                        <label for="fecha_matriculacion" class="form-label">
                                            <i class="bi bi-calendar-date field-icon"></i>Fecha Matriculación
                                        </label>
                                        <input type="date" class="form-control @error('fecha_matriculacion') is-invalid @enderror" 
                                               id="fecha_matriculacion" name="fecha_matriculacion" value="{{ old('fecha_matriculacion') }}"
                                               max="{{ date('Y-m-d') }}">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            @error('fecha_matriculacion')
                                                {{ $message }}
                                            @else
                                                La fecha de matriculación no puede ser posterior a hoy.
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-md-6">
                                        <label for="color" class="form-label required-field">
                                            <i class="bi bi-palette-fill field-icon"></i>Color
                                        </label>
                                        <input type="text" class="form-control @error('color') is-invalid @enderror" 
                                               id="color" name="color" value="{{ old('color') }}" 
                                               placeholder="Ej: Blanco" required minlength="1"
                                               autocomplete="off" inputmode="text">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            @error('color')
                                                {{ $message }}
                                            @else
                                                El color es obligatorio y debe tener al menos 1 carácter.
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group-spacing">
                                    <label for="cliente_id" class="form-label required-field">
                                        <i class="bi bi-person-fill field-icon"></i>Dueño
                                    </label>
                                    <select class="form-select @error('cliente_id') is-invalid @enderror" 
                                            id="cliente_id" name="cliente_id" required>
                                        <option value="">Seleccionar dueño</option>
                                        @foreach($clientes as $cliente)
                                            <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                                {{ $cliente->nombre }} {{ $cliente->apellidos }} - {{ $cliente->dni }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">
                                        @error('cliente_id')
                                            {{ $message }}
                                        @else
                                            Debe seleccionar un dueño para el vehículo.
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-buttons mt-4">
                                    <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left me-1"></i>Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check2-circle me-1"></i>Guardar Vehículo
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
            const form = document.getElementById('vehiculoForm');
            const inputs = form.querySelectorAll('input, select');
            
            function validateField(input) {
                let isValid = true;
                
                switch(input.id) {
                    case 'marca':
                    case 'modelo':
                        const alphaNumPattern = /^[a-zA-Z0-9\s]+$/;
                        isValid = input.value.trim() !== '' && alphaNumPattern.test(input.value);
                        break;
                        
                    case 'matricula':
                        const matriculaPattern = /^([A-Z]{2}\d{4}[A-Z]{2}|\d{4}[A-Z]{3}|[A-Z]{3}\d{4})$/;
                        isValid = matriculaPattern.test(input.value);
                        break;
                        
                    case 'bastidor':
                        if (input.value.trim() === '') {
                            isValid = true;
                        } else {
                            const bastidorPattern = /^[A-Z0-9]+$/;
                            isValid = bastidorPattern.test(input.value);
                        }
                        break;
                        
                    case 'fecha_matriculacion':
                        if (input.value === '') {
                            isValid = true;
                        } else {
                            const selectedDate = new Date(input.value);
                            const today = new Date();
                            today.setHours(0, 0, 0, 0);
                            isValid = selectedDate <= today;
                        }
                        break;
                        
                    case 'color':
                        isValid = input.value.trim() !== '';
                        break;
                        
                    case 'cliente_id':
                        isValid = input.value !== '';
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
                    
                    const firstInvalid = form.querySelector('.is-invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstInvalid.focus();
                    }
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
            
            const matriculaInput = document.getElementById('matricula');
            if (matriculaInput) {
                matriculaInput.addEventListener('input', function() {
                    let value = this.value.toUpperCase();
                    value = value.replace(/[^A-Z0-9]/g, '');
                    this.value = value;
                    
                    validateField(this);
                });
            }
            
            const bastidorInput = document.getElementById('bastidor');
            if (bastidorInput) {
                bastidorInput.addEventListener('input', function() {
                    let value = this.value.toUpperCase();
                    value = value.replace(/[^A-Z0-9]/g, '');
                    this.value = value;
                    
                    validateField(this);
                });
            }
            
            const fechaMatriculacionInput = document.getElementById('fecha_matriculacion');
            if (fechaMatriculacionInput) {
                const today = new Date().toISOString().split('T')[0];
                fechaMatriculacionInput.setAttribute('max', today);
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
                
                inputs.forEach(function(input) {
                    input.addEventListener('focus', function() {
                        setTimeout(() => {
                            this.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }, 300);
                    });
                });
            }
        });
    </script>
</body>
</html>