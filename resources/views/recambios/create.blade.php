@extends('layouts.app')

@section('title', config('app.name', 'MiraCar') . ' - Recambios')

<link rel="icon" href="{{ asset('galeria/logo.ico') }}" type="image/x-icon">
<link rel="shortcut icon" href="{{ asset('galeria/logo.ico') }}" type="image/x-icon">
<link rel="apple-touch-icon" href="{{ asset('galeria/logo.png') }}">
<meta name="msapplication-TileImage" content="{{ asset('galeria/logo.png') }}">

@section('content')
<div class="container py-3 py-md-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card-container">
                <div class="card">
                    <div class="add-badge d-flex">
                        <i class="bi bi-plus-lg"></i>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title mb-3 mb-md-4">
                            <i class="bi bi-tools me-2 d-none d-sm-inline-block"></i>Nuevo Recambio
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
                        
                        <form action="{{ route('recambios.store') }}" method="POST" id="recambioForm" class="needs-validation" novalidate>
                            @csrf
                            
                            <div class="mb-3">
                                <label for="producto" class="form-label required-field">Producto</label>
                                <input type="text" class="form-control @error('producto') is-invalid @enderror" id="producto" name="producto" value="{{ old('producto') }}" required minlength="1" placeholder="Nombre del producto">
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback">
                                    @error('producto')
                                        {{ $message }}
                                    @else
                                        El producto es obligatorio.
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-12 col-sm-6 mb-3 mb-sm-0">
                                    <label for="cantidad" class="form-label required-field">Cantidad</label>
                                    <input type="number" class="form-control @error('cantidad') is-invalid @enderror" id="cantidad" name="cantidad" value="{{ old('cantidad', 1) }}" min="1" required placeholder="Cantidad">
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">
                                        @error('cantidad')
                                            {{ $message }}
                                        @else
                                            La cantidad debe ser al menos 1.
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12 col-sm-6">
                                    <label for="referencia" class="form-label required-field">Referencia</label>
                                    <input type="text" class="form-control @error('referencia') is-invalid @enderror" id="referencia" name="referencia" value="{{ old('referencia') }}" required placeholder="Código de referencia">
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">
                                        @error('referencia')
                                            {{ $message }}
                                        @else
                                            La referencia es obligatoria.
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="precio" class="form-label required-field">Precio</label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ old('precio') }}" step="0.01" min="0.01" required placeholder="0.00">
                                    <span class="input-group-text">€</span>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">
                                        @error('precio')
                                            {{ $message }}
                                        @else
                                            El precio debe ser mayor que 0.
                                        @enderror
                                    </div>
                                </div>
                                <small class="form-text text-muted">Precio sin IGIT</small>
                            </div>
                            
                            <div class="mb-4">
                                <label for="descripcion" class="form-label required-field">Descripción</label>
                                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3" required placeholder="Descripción del recambio">{{ old('descripcion') }}</textarea>
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
                                <a href="{{ route('recambios.index') }}" class="btn btn-secondary me-md-2 order-2 order-md-1">
                                    <i class="bi bi-arrow-left me-1"></i>Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary mb-3 mb-md-0 order-1 order-md-2">
                                    <i class="bi bi-check2-circle me-1"></i>Guardar Recambio
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
    
    #producto ~ .invalid-feedback,
    #referencia ~ .invalid-feedback {
        display: none;
    }
    
    #producto:focus.is-invalid ~ .invalid-feedback,
    #referencia:focus.is-invalid ~ .invalid-feedback {
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
    
    .was-validated #producto:invalid ~ .invalid-feedback,
    .was-validated #referencia:invalid ~ .invalid-feedback {
        display: none;
    }
    
    .was-validated #producto:focus:invalid ~ .invalid-feedback,
    .was-validated #referencia:focus:invalid ~ .invalid-feedback {
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
        
        .col-md-6, .col-md-4, .col-md-8, .col-sm-6 {
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
        
        .add-badge {
            width: 30px;
            height: 30px;
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
    }
    
    @media (hover: none) and (pointer: coarse) {
        .form-control {
            padding: 0.5rem 0.75rem;
        }
        
        .btn {
            padding-top: 0.625rem;
            padding-bottom: 0.625rem;
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
    }
    
    .required-field::after {
        content: "*";
        color: red;
        margin-left: 4px;
    }
    
    .input-group .form-control {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }
    
    .input-group-text {
        background-color: #f8f9fa;
        border-color: #ced4da;
        color: #495057;
    }
    
    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('recambioForm');
        const inputs = form.querySelectorAll('input, textarea');
        
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
                case 'producto':
                    isValid = input.value.trim().length > 0;
                    break;
                    
                case 'referencia':
                    isValid = input.value.trim().length > 0;
                    break;
                    
                case 'cantidad':
                    isValid = input.value >= 1;
                    break;
                    
                case 'precio':
                    isValid = input.value > 0;
                    break;
                    
                case 'descripcion':
                    isValid = validarDescripcion(input.value);
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
                    if (input.type === 'number') {
                        input.setAttribute('inputmode', 'numeric');
                    }
                });
            }
        });
        
        const numberInputs = document.querySelectorAll('input[type="number"]');
        numberInputs.forEach(input => {
            input.addEventListener('wheel', function(e) {
                e.preventDefault();
            });
            
            if (window.matchMedia('(max-width: 767.98px)').matches) {
                const inputContainer = document.createElement('div');
                inputContainer.className = 'input-number-container d-flex align-items-center mt-2 d-md-none';
                
                const decrementBtn = document.createElement('button');
                decrementBtn.type = 'button';
                decrementBtn.className = 'btn btn-sm btn-outline-secondary';
                decrementBtn.innerHTML = '<i class="bi bi-dash"></i>';
                decrementBtn.addEventListener('click', function() {
                    const currentValue = parseFloat(input.value) || 0;
                    const step = parseFloat(input.step) || 1;
                    const min = parseFloat(input.min) || 0;
                    
                    if (currentValue > min) {
                        input.value = (currentValue - step).toFixed(2);
                        input.dispatchEvent(new Event('input'));
                    }
                });
                
                const incrementBtn = document.createElement('button');
                incrementBtn.type = 'button';
                incrementBtn.className = 'btn btn-sm btn-outline-secondary ms-2';
                incrementBtn.innerHTML = '<i class="bi bi-plus"></i>';
                incrementBtn.addEventListener('click', function() {
                    const currentValue = parseFloat(input.value) || 0;
                    const step = parseFloat(input.step) || 1;
                    
                    input.value = (currentValue + step).toFixed(2);
                    input.dispatchEvent(new Event('input'));
                });
                
                const valueDisplay = document.createElement('span');
                valueDisplay.className = 'mx-3';
                valueDisplay.textContent = input.value;
                
                input.addEventListener('input', function() {
                    valueDisplay.textContent = input.value;
                });
                
                inputContainer.appendChild(decrementBtn);
                inputContainer.appendChild(valueDisplay);
                inputContainer.appendChild(incrementBtn);
                
                if (input.id === 'cantidad' || input.id === 'precio') {
                    input.parentNode.appendChild(inputContainer);
                }
            }
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
    });
</script>
@endsection