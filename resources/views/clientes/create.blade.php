<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'MiraCar') }} - Nuevo Cliente</title>
    
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
        
        .form-control:focus {
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
        
        #dni ~ .invalid-feedback,
        #telefono ~ .invalid-feedback {
            display: none;
        }
        
        #dni:focus.is-invalid ~ .invalid-feedback,
        #telefono:focus.is-invalid ~ .invalid-feedback {
            display: block;
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
        
        .was-validated #dni:invalid ~ .invalid-feedback,
        .was-validated #telefono:invalid ~ .invalid-feedback {
            display: none;
        }
        
        .was-validated #dni:focus:invalid ~ .invalid-feedback,
        .was-validated #telefono:focus:invalid ~ .invalid-feedback {
            display: block;
        }
        
        .document-type-selector {
            display: flex;
            margin-bottom: 0.5rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            overflow: hidden;
        }
        
        .document-type-selector label {
            flex: 1;
            text-align: center;
            padding: 0.375rem 0.75rem;
            cursor: pointer;
            background-color: #f8f9fa;
            border-right: 1px solid #ced4da;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }
        
        .document-type-selector label:last-child {
            border-right: none;
        }
        
        .document-type-selector input[type="radio"] {
            display: none;
        }
        
        .document-type-selector input[type="radio"]:checked + label {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
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
        
        .card-container {
            position: relative;
        }
        
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        @media (max-width: 767.98px) {
            .container {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
            
            .card-body {
                padding: 1.25rem;
            }
            
            .card-title {
                font-size: 1.5rem;
                margin-bottom: 1rem;
            }
            
            .row {
                margin-left: -0.5rem;
                margin-right: -0.5rem;
            }
            
            .col-md-6, .col-md-4, .col-md-8 {
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
            
            .form-control {
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
            
            h5 {
                font-size: 1.1rem;
            }
            
            .document-type-selector label {
                padding: 0.3rem 0.5rem;
                font-size: 0.85rem;
            }
            
            input, select, textarea {
                font-size: 16px !important;
            }
            
            .add-badge {
                width: 30px;
                height: 30px;
                top: -8px;
                right: -8px;
                font-size: 0.9rem;
            }
        }
        
        @media (min-width: 768px) and (max-width: 991.98px) {
            .card-body {
                padding: 1.75rem;
            }
            
            .btn {
                padding: 0.5rem 1.5rem;
            }
            
            .document-type-selector label {
                padding: 0.4rem 0.6rem;
            }
            
            input, select, textarea {
                font-size: 16px !important;
            }
        }
        
        @media (hover: none) and (pointer: coarse) {
            .form-control {
                padding: 0.5rem 0.75rem;
            }
            
            .btn {
                padding-top: 0.625rem;
                padding-bottom: 0.625rem;
            }
            
            .document-type-selector label {
                padding: 0.5rem 0.75rem;
            }
            
            .form-label {
                font-weight: 600;
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
                max-width: 100%;
            }
            
            .card-body {
                padding: 1rem;
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
            
            h5 {
                font-size: 1rem;
                margin-bottom: 0.5rem !important;
            }
            
            .py-4 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }
            
            .row {
                display: flex;
                flex-wrap: nowrap;
                overflow-x: auto;
                padding-bottom: 0.5rem;
            }
            
            .row::-webkit-scrollbar {
                height: 4px;
            }
            
            .row::-webkit-scrollbar-thumb {
                background-color: rgba(0,0,0,0.2);
                border-radius: 4px;
            }
        }
        
        @media (max-width: 375px) {
            .card-body {
                padding: 1rem;
            }
            
            .card-title {
                font-size: 1.25rem;
            }
            
            .form-label {
                font-size: 0.9rem;
            }
            
            .form-control {
                font-size: 0.9rem;
                padding: 0.3rem 0.6rem;
            }
            
            .btn {
                font-size: 0.9rem;
            }
            
            .document-type-selector label {
                font-size: 0.8rem;
                padding: 0.25rem 0.4rem;
            }
            
            .invalid-feedback {
                font-size: 0.8rem;
            }
        }
        
        .required-field::after {
            content: "*";
            color: red;
            margin-left: 4px;
        }
        
        @media (prefers-reduced-motion: reduce) {
            * {
                transition: none !important;
                animation: none !important;
            }
        }
        
        @media (prefers-contrast: more) {
            .form-control {
                border-width: 2px;
            }
            
            .required-field::after {
                font-size: 1.2em;
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
                        <div class="add-badge">
                            <i class="bi bi-plus-lg"></i>
                        </div>
                        <div class="card-body">
                            <h2 class="card-title mb-3 mb-md-4">
                                <i class="bi bi-person-plus-fill me-2 d-none d-sm-inline-block"></i>Nuevo Cliente
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
                            
                            <form action="{{ route('clientes.store') }}" method="POST" id="clienteForm" class="needs-validation" novalidate>
                                @csrf
                                
                                <div class="row mb-3">
                                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                                        <label for="nombre" class="form-label required-field">Nombre</label>
                                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required minlength="2">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            @error('nombre')
                                                {{ $message }}
                                            @else
                                                El nombre es obligatorio y debe tener al menos 2 caracteres.
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-md-6">
                                        <label for="apellidos" class="form-label required-field">Apellidos</label>
                                        <input type="text" class="form-control @error('apellidos') is-invalid @enderror" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" required minlength="2">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            @error('apellidos')
                                                {{ $message }}
                                            @else
                                                Los apellidos son obligatorios y deben tener al menos 2 caracteres.
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                                        <label class="form-label required-field">Tipo de documento</label>
                                        
                                        <div class="document-type-selector mb-2">
                                            <input type="radio" name="document_type" id="dni_type" value="dni" {{ old('document_type', 'dni') == 'dni' ? 'checked' : '' }}>
                                            <label for="dni_type">DNI</label>
                                            
                                            <input type="radio" name="document_type" id="nie_type" value="nie" {{ old('document_type') == 'nie' ? 'checked' : '' }}>
                                            <label for="nie_type">NIE</label>
                                            
                                            <input type="radio" name="document_type" id="other_type" value="other" {{ old('document_type') == 'other' ? 'checked' : '' }}>
                                            <label for="other_type">Otro</label>
                                        </div>
                                        
                                        <input type="text" class="form-control @error('dni') is-invalid @enderror" id="dni" name="dni" value="{{ old('dni') }}" required maxlength="9" placeholder="Introduce el documento">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            @error('dni')
                                                {{ $message }}
                                            @else
                                                <span id="dni_error_message">El formato del documento no es válido.</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-md-6">
                                        <label for="telefono" class="form-label required-field">Teléfono</label>
                                        <input type="tel" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono') }}" required placeholder="612345678" minlength="6" inputmode="numeric">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            @error('telefono')
                                                {{ $message }}
                                            @else
                                                El teléfono debe tener al menos 6 números o comenzar con # seguido de al menos 6 números.
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label required-field">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required inputmode="email">
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">
                                        @error('email')
                                            {{ $message }}
                                        @else
                                            Introduce un email válido.
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="direccion" class="form-label required-field">Dirección</label>
                                    <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion" value="{{ old('direccion') }}" required>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">
                                        @error('direccion')
                                            {{ $message }}
                                        @else
                                            La dirección es obligatoria.
                                        @enderror
                                    </div>
                                </div>
                                
                                <hr class="my-3 my-md-4">
                                <h5 class="mb-3 text-secondary">
                                    <i class="bi bi-building me-1"></i>Información Jurídica (Opcional)
                                </h5>
                                
                                <div class="row mb-4">
                                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                                        <label for="cif" class="form-label">CIF</label>
                                        <input type="text" class="form-control @error('cif') is-invalid @enderror" id="cif" name="cif" value="{{ old('cif') }}">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            @error('cif')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <label for="direccion_juridica" class="form-label">Dirección Jurídica</label>
                                        <input type="text" class="form-control @error('direccion_juridica') is-invalid @enderror" id="direccion_juridica" name="direccion_juridica" value="{{ old('direccion_juridica') }}">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">
                                            @error('direccion_juridica')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-center flex-column flex-md-row">
                                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary me-md-2 order-2 order-md-1">
                                        <i class="bi bi-arrow-left me-1"></i>Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-primary mb-3 mb-md-0 order-1 order-md-2">
                                        <i class="bi bi-check2-circle me-1"></i>Guardar Cliente
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
            const form = document.getElementById('clienteForm');
            const inputs = form.querySelectorAll('input');
            
            const dniTypeRadio = document.getElementById('dni_type');
            const nieTypeRadio = document.getElementById('nie_type');
            const otherTypeRadio = document.getElementById('other_type');
            const dniInput = document.getElementById('dni');
            const dniErrorMessage = document.getElementById('dni_error_message');
            
            const telefonoInput = document.getElementById('telefono');
            
            function validateSpanishDNI(dni) {
                const dniPattern = /^[0-9]{8}[A-Za-z]$/;
                if (!dniPattern.test(dni)) {
                    return false;
                }
                
                const letters = 'TRWAGMYFPDXBNJZSQVHLCKE';
                const number = dni.substring(0, 8);
                const letter = dni.charAt(8).toUpperCase();
                const index = parseInt(number) % 23;
                
                return letters.charAt(index) === letter;
            }
            
            function validateNIE(nie) {
                const niePattern = /^[XYZ][0-9]{7}[A-Za-z]$/;
                if (!niePattern.test(nie)) {
                    return false;
                }
                
                const letters = 'TRWAGMYFPDXBNJZSQVHLCKE';
                let firstChar = nie.charAt(0);
                let number;
                
                if (firstChar === 'X') {
                    number = '0' + nie.substring(1, 8);
                } else if (firstChar === 'Y') {
                    number = '1' + nie.substring(1, 8);
                } else if (firstChar === 'Z') {
                    number = '2' + nie.substring(1, 8);
                }
                
                const letter = nie.charAt(8).toUpperCase();
                const index = parseInt(number) % 23;
                
                return letters.charAt(index) === letter;
            }
            
            function validateOtherDocument(doc) {
                return doc.length >= 5;
            }
            
            function updateDocumentErrorMessage() {
                if (dniTypeRadio.checked) {
                    dniInput.placeholder = '12345678A';
                    dniInput.maxLength = 9;
                    dniErrorMessage.textContent = 'El DNI debe tener 8 números seguidos de una letra válida.';
                } else if (nieTypeRadio.checked) {
                    dniInput.placeholder = 'X1234567A';
                    dniInput.maxLength = 9;
                    dniErrorMessage.textContent = 'El NIE debe comenzar con X, Y o Z, seguido de 7 números y una letra válida.';
                } else {
                    dniInput.placeholder = 'Documento de identidad';
                    dniInput.maxLength = 20;
                    dniErrorMessage.textContent = 'El documento debe tener al menos 5 caracteres.';
                }
            }
            
            function validateField(input) {
                let isValid = true;
                
                switch(input.id) {
                    case 'nombre':
                    case 'apellidos':
                        const namePattern = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,}$/;
                        isValid = input.value.trim() !== '' && namePattern.test(input.value);
                        break;
                        
                    case 'dni':
                        if (dniTypeRadio.checked) {
                            isValid = validateSpanishDNI(input.value);
                        } else if (nieTypeRadio.checked) {
                            isValid = validateNIE(input.value);
                        } else {
                            isValid = validateOtherDocument(input.value);
                        }
                        break;
                        
                    case 'telefono':
                        const phonePattern = /^(#?\d{6,})$/;
                        isValid = phonePattern.test(input.value);
                        break;
                        
                    case 'email':
                        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        isValid = emailPattern.test(input.value);
                        break;
                        
                    case 'direccion':
                        isValid = input.value.trim() !== '';
                        break;
                        
                    case 'cif':
                    case 'direccion_juridica':
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
                
                input.addEventListener('focus', function() {
                    this.classList.add('input-focused');
                });
                
                input.addEventListener('blur', function() {
                    this.classList.remove('input-focused');
                });
                
                if ('ontouchstart' in window) {
                    input.addEventListener('touchstart', function(e) {
                        if (input.type === 'tel' || input.type === 'email') {
                            input.setAttribute('inputmode', input.type === 'tel' ? 'numeric' : 'email');
                        }
                    });
                }
            });
            
            dniTypeRadio.addEventListener('change', updateDocumentErrorMessage);
            nieTypeRadio.addEventListener('change', updateDocumentErrorMessage);
            otherTypeRadio.addEventListener('change', updateDocumentErrorMessage);
            
            dniTypeRadio.addEventListener('change', function() {
                validateField(dniInput);
            });
            
            nieTypeRadio.addEventListener('change', function() {
                validateField(dniInput);
            });
            
            otherTypeRadio.addEventListener('change', function() {
                validateField(dniInput);
            });
            
            updateDocumentErrorMessage();
            
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
            
            if ('ontouchstart' in window) {
                inputs.forEach(function(input) {
                    input.addEventListener('focus', function() {
                        setTimeout(function() {
                            input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }, 300);
                    });
                });
            }
        });
    </script>
</body>
</html>