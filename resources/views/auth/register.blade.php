<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Registro</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('galeria/logo.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('galeria/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(120deg, #e3ecff 0%, #f4f6f8 60%, #d0e2ff 100%);
            font-family: 'Instrument Sans', sans-serif;
            padding: 0;
            margin: 0;
        }
        
        .auth-bg-blur {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: 0;
            pointer-events: none;
            background: radial-gradient(circle at 80% 10%, #4f8cff33 0, transparent 60%),
                        radial-gradient(circle at 10% 90%, #23539022 0, transparent 70%);
            filter: blur(32px);
        }
        
        .auth-card {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 8px 40px 0 rgba(79,140,255,0.13), 0 1.5px 8px 0 rgba(79,140,255,0.07);
            padding: 1.5rem 1rem;
            width: 100%;
            max-width: 540px;
            margin: 1rem auto;
            position: relative;
            z-index: 1;
        }
        
        .auth-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #235390;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            color: #235390;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }
        
        .form-control, .form-select {
            border-radius: 0.75rem;
            border: 1.5px solid #e3ecff;
            padding: 0.75rem;
            font-size: 0.95rem;
            margin-bottom: 0.75rem;
            background: #fafdff;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #4f8cff;
            box-shadow: 0 0 0 0.2rem #b6d0ff55;
            background: #fff;
        }
        
        .form-control.is-valid, .form-select.is-valid {
            border-color: #198754;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
            padding-right: calc(1.5em + 0.75rem);
        }
        
        .form-control.is-invalid, .form-select.is-invalid {
            border-color: #dc3545;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
            padding-right: calc(1.5em + 0.75rem);
        }
        
        /* Ajuste para los iconos en campos de contraseña */
        .password-input.is-valid, .password-input.is-invalid {
            background-position: right calc(2.5em + 0.1875rem) center;
        }
        
        .btn-primary {
            background: linear-gradient(90deg, #4f8cff, #235390 90%);
            border: none;
            border-radius: 0.75rem;
            font-weight: 700;
            font-size: 1rem;
            padding: 0.75rem 0;
            transition: background 0.18s, box-shadow 0.18s, transform 0.13s;
            box-shadow: 0 2px 12px rgba(79,140,255,0.13);
        }
        
        .btn-primary:hover {
            background: linear-gradient(90deg, #235390, #4f8cff 90%);
            transform: translateY(-2px) scale(1.03);
        }
        
        .btn-outline-secondary {
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .auth-links {
            text-align: center;
            margin-top: 1.25rem;
        }
        
        .auth-links a {
            color: #4f8cff;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
        }
        
        .auth-links a:hover {
            color: #235390;
            text-decoration: underline;
        }
        
        .rounded-circle {
            border: 2px solid #e3ecff;
            background: #fafdff;
        }
        
        .invalid-feedback, .text-danger {
            font-size: 0.85rem;
        }
        
        .alert {
            border-radius: 0.75rem;
            font-size: 0.9rem;
        }
        
        .logo-container, .avatar-container {
            border: 2px dashed #b6d0ff;
            background: #fafdff;
            transition: border-color 0.18s, box-shadow 0.18s;
            width: 100px;
            height: 100px;
        }
        
        .logo-container img, .avatar-container img {
            border-radius: 50%;
        }
        
        .logo-container:focus-within, .avatar-container:focus-within {
            border-color: #4f8cff;
        }
        
        .btn-primary, .btn-outline-primary {
            box-shadow: 0 2px 12px rgba(79,140,255,0.13);
        }
        
        .btn-primary:hover, .btn-outline-primary:hover {
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 4px 18px rgba(79,140,255,0.18);
        }
        
        .btn-outline-primary {
            border: 2px solid #4f8cff;
            color: #235390;
            background: #fff;
            font-size: 0.9rem;
        }
        
        .btn-outline-primary:hover {
            background: #4f8cff;
            color: #fff;
        }
        
        /* Estilos para el campo de contraseña con icono */
        .password-container {
            position: relative;
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #235390;
            z-index: 10;
            padding: 0.5rem;
            font-size: 1.1rem;
        }
        
        .password-toggle:hover {
            color: #4f8cff;
        }
        
        /* Ajuste para el icono dentro del input */
        .password-input {
            padding-right: 40px;
        }
        
        /* Estilos para campos requeridos */
        .required-field::after {
            content: "*";
            color: #dc3545;
            margin-left: 4px;
        }
        
        /* Estilos para requisitos de contraseña */
        .password-requirements {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 0.25rem;
            display: none; /* Oculto por defecto */
            transition: opacity 0.2s ease-in-out;
        }
        
        .password-requirements.visible {
            display: block;
        }
        
        /* Estilos para ayuda de documentos */
        .document-help {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 0.25rem;
            display: none; /* Oculto por defecto */
            transition: opacity 0.2s ease-in-out;
        }
        
        .document-help.visible {
            display: block;
        }
        
        /* Estilos para feedback de coincidencia de contraseñas */
        .password-match-feedback {
            font-size: 0.8rem;
            margin-top: 0.25rem;
            display: none;
            margin-right: 50px; /* Espacio para evitar superposición con el icono */
            padding-left: 5px; /* Espacio a la izquierda */
        }
        
        .password-match-feedback.valid {
            color: #198754;
            display: block;
        }
        
        .password-match-feedback.invalid {
            color: #dc3545;
            display: block;
        }
        
        /* Media queries para tablets */
        @media (min-width: 768px) {
            .auth-card {
                padding: 2rem 1.5rem;
                margin: 2rem auto;
                border-radius: 1.25rem;
            }
            
            .auth-title {
                font-size: 2rem;
                margin-bottom: 2rem;
            }
            
            .form-label {
                font-size: 1rem;
                margin-bottom: 0.5rem;
            }
            
            .form-control, .form-select {
                padding: 0.85rem 1rem;
                font-size: 1rem;
                margin-bottom: 1rem;
            }
            
            .btn-primary {
                font-size: 1.1rem;
                padding: 0.8rem 0;
            }
            
            .logo-container, .avatar-container {
                width: 120px;
                height: 120px;
            }
            
            .btn-outline-secondary {
                font-size: 0.95rem;
            }
            
            .auth-links a {
                font-size: 1rem;
            }
        }
        
        /* Media queries para desktop */
        @media (min-width: 992px) {
            .auth-card {
                padding: 2.5rem 2rem;
                margin: 3rem auto;
                max-width: 540px;
            }
            
            .logo-container, .avatar-container {
                width: 120px;
                height: 120px;
            }
        }
        
        /* Ajustes específicos para móviles pequeños */
        @media (max-width: 375px) {
            .auth-card {
                padding: 1.25rem 0.75rem;
                margin: 0.5rem auto;
                border-radius: 0.75rem;
            }
            
            .auth-title {
                font-size: 1.5rem;
                margin-bottom: 1.25rem;
            }
            
            .logo-container, .avatar-container {
                width: 90px;
                height: 90px;
            }
            
            .form-control, .form-select {
                padding: 0.65rem;
                font-size: 0.9rem;
            }
            
            .btn-primary, .btn-outline-primary {
                font-size: 0.9rem;
                padding: 0.65rem 0;
            }
        }
    </style>
</head>
<body>
    <div class="auth-bg-blur"></div>
    <div class="container px-2 py-2 py-md-4">
        <div class="auth-card">
            <div class="auth-title">Registrarse</div>
            <form method="POST" action="{{ route('registrarse') }}" enctype="multipart/form-data" id="registerForm">
                @csrf

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @enderror

                <div class="mb-3">
                    <label for="user_type" class="form-label required-field">Tipo de usuario</label>
                    <select id="user_type" name="user_type" class="form-select @error('user_type') is-invalid @enderror" required>
                        <option value="" selected disabled>Elige uno...</option>
                        <option value="user" {{ old('user_type') == 'user' ? 'selected' : '' }}>Usuario</option>
                        <option value="taller" {{ old('user_type') == 'taller' ? 'selected' : '' }}>Taller</option>
                    </select>
                    @error('user_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Formulario para Taller -->
                <div id="taller_section" class="row g-2 g-md-3 {{ old('user_type') == 'taller' ? '' : 'd-none' }}">
                    <div class="col-12 col-md-4 text-center mb-3">
                        <div class="logo-container mx-auto mb-2 mb-md-3 rounded-circle d-flex justify-content-center align-items-center bg-info bg-opacity-10" style="overflow: hidden;">
                            <i class="bi bi-person text-info" style="font-size: 36px;"></i>
                        </div>
                        <label for="logo" class="btn btn-outline-secondary btn-sm w-100">
                            <i class="bi bi-upload me-1"></i> Insertar Logo
                            <input id="logo" type="file" name="logo" accept="image/*" class="d-none" />
                        </label>
                        @error('logo')
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="mb-2">
                            <label for="company_name" class="form-label required-field">Nombre empresa</label>
                            <input id="company_name" type="text" name="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name') }}" />
                            <div id="company_name_feedback" class="invalid-feedback"></div>
                            @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="company_nif" class="form-label required-field">NIF</label>
                            <input id="company_nif" type="text" name="company_nif" class="form-control @error('company_nif') is-invalid @enderror" value="{{ old('company_nif') }}" />
                            <div id="company_nif_help" class="document-help">
                                Formato: CIF (B12345678) o NIF (12345678Z)
                            </div>
                            <div id="company_nif_feedback" class="invalid-feedback"></div>
                            @error('company_nif')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="company_email" class="form-label required-field">Email</label>
                            <input id="company_email" type="email" name="company_email" class="form-control @error('company_email') is-invalid @enderror" value="{{ old('company_email') }}" />
                            <div id="company_email_feedback" class="invalid-feedback"></div>
                            @error('company_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="company_phone" class="form-label required-field">Teléfono</label>
                            <input id="company_phone" type="tel" name="company_phone" class="form-control @error('company_phone') is-invalid @enderror" value="{{ old('company_phone') }}" required />
                            <div id="company_phone_feedback" class="invalid-feedback"></div>
                            @error('company_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="company_password" class="form-label required-field">Contraseña</label>
                            <div class="password-container">
                                <input id="company_password" type="password" name="company_password" class="form-control password-input @error('company_password') is-invalid @enderror" minlength="6" />
                                <span class="password-toggle" onclick="togglePasswordVisibility('company_password')">
                                    <i class="bi bi-eye-slash" id="company_password_toggle_icon"></i>
                                </span>
                            </div>
                            <div id="company_password_requirements" class="password-requirements">
                                La contraseña debe tener al menos:
                                <ul>
                                    <li>6 caracteres</li>
                                    <li>Una letra mayúscula</li>
                                    <li>Una letra minúscula</li>
                                    <li>Un número</li>
                                    <li>Un carácter especial (@-_+*/#()[]{})</li>
                                </ul>
                            </div>
                            <div id="company_password_feedback" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2">
                            <label for="company_password_confirmation" class="form-label required-field">Repetir contraseña</label>
                            <div class="password-container">
                                <input id="company_password_confirmation" type="password" name="company_password_confirmation" class="form-control password-input @error('company_password_confirmation') is-invalid @enderror" />
                                <span class="password-toggle" onclick="togglePasswordVisibility('company_password_confirmation')">
                                    <i class="bi bi-eye-slash" id="company_password_confirmation_toggle_icon"></i>
                                </span>
                            </div>
                            <div id="company_password_match" class="password-match-feedback">Las contraseñas coinciden</div>
                            <div id="company_password_mismatch" class="password-match-feedback">Las contraseñas no coinciden</div>
                            @error('company_password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Formulario para Usuario -->
                <div id="user_section" class="row g-2 g-md-3 {{ old('user_type') == 'user' ? '' : 'd-none' }}">
                    <div class="col-12 col-md-4 text-center mb-3">
                        <div class="avatar-container mx-auto mb-2 mb-md-3 rounded-circle d-flex justify-content-center align-items-center bg-info bg-opacity-10" style="overflow: hidden;">
                            <i class="bi bi-person text-info" style="font-size: 36px;"></i>
                        </div>
                        <label for="avatar" class="btn btn-outline-secondary btn-sm w-100">
                            <i class="bi bi-upload me-1"></i> Insertar Avatar
                            <input id="avatar" type="file" name="avatar" accept="image/*" class="d-none" />
                        </label>
                        @error('avatar')
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="mb-2">
                            <label for="name" class="form-label required-field">Nombre</label>
                            <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" />
                            <div id="name_feedback" class="invalid-feedback"></div>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="lastname" class="form-label required-field">Apellidos</label>
                            <input id="lastname" type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}" />
                            <div id="lastname_feedback" class="invalid-feedback"></div>
                            @error('lastname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="dni" class="form-label required-field">DNI/NIE</label>
                            <input id="dni" type="text" name="dni" class="form-control @error('dni') is-invalid @enderror" value="{{ old('dni') }}" />
                            <div id="dni_help" class="document-help">
                                Formato: DNI (12345678Z) o NIE (X1234567L)
                            </div>
                            <div id="dni_feedback" class="invalid-feedback"></div>
                            @error('dni')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label required-field">Email</label>
                            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" />
                            <div id="email_feedback" class="invalid-feedback"></div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="phone" class="form-label required-field">Teléfono</label>
                            <input id="phone" type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required />
                            <div id="phone_feedback" class="invalid-feedback"></div>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label required-field">Contraseña</label>
                            <div class="password-container">
                                <input id="password" type="password" name="password" class="form-control password-input @error('password') is-invalid @enderror" minlength="6" />
                                <span class="password-toggle" onclick="togglePasswordVisibility('password')">
                                    <i class="bi bi-eye-slash" id="password_toggle_icon"></i>
                                </span>
                            </div>
                            <div id="password_requirements" class="password-requirements">
                                La contraseña debe tener al menos:
                                <ul>
                                    <li>6 caracteres</li>
                                    <li>Una letra mayúscula</li>
                                    <li>Una letra minúscula</li>
                                    <li>Un número</li>
                                    <li>Un carácter especial (@-_+*/#()[]{})</li>
                                </ul>
                            </div>
                            <div id="password_feedback" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-2">
                            <label for="password_confirmation" class="form-label required-field">Repetir contraseña</label>
                            <div class="password-container">
                                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control password-input @error('password_confirmation') is-invalid @enderror" />
                                <span class="password-toggle" onclick="togglePasswordVisibility('password_confirmation')">
                                    <i class="bi bi-eye-slash" id="password_confirmation_toggle_icon"></i>
                                </span>
                            </div>
                            <div id="password_match" class="password-match-feedback">Las contraseñas coinciden</div>
                            <div id="password_mismatch" class="password-match-feedback">Las contraseñas no coinciden</div>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-end gap-2 mt-3 mt-md-4">
                    <a href="/login" class="btn btn-outline-primary w-100 w-md-auto mb-2 mb-md-0 order-2 order-md-1">
                        <i class="bi bi-box-arrow-in-left me-1"></i>Acceder
                    </a>
                    <button type="submit" class="btn btn-primary w-100 w-md-auto order-1 order-md-2" id="submitBtn">
                        <i class="bi bi-person-plus-fill me-1"></i>Guardar
                    </button>
                </div>
            </form>
            <div class="auth-links d-md-none">
                <a href="/login" class="btn btn-link text-decoration-none p-0">
                    <i class="bi bi-box-arrow-in-left me-1"></i>¿Ya tienes cuenta? Accede aquí
                </a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userTypeSelect = document.getElementById('user_type');
            const tallerSection = document.getElementById('taller_section');
            const userSection = document.getElementById('user_section');
            const logoInput = document.getElementById('logo');
            const logoContainer = document.querySelector('.logo-container');
            const avatarInput = document.getElementById('avatar');
            const avatarContainer = document.querySelector('.avatar-container');
            const registerForm = document.getElementById('registerForm');
            const submitBtn = document.getElementById('submitBtn');
            
            // Ayuda para documentos
            const companyNifHelp = document.getElementById('company_nif_help');
            const dniHelp = document.getElementById('dni_help');
            
            // Campos de texto
            const companyName = document.getElementById('company_name');
            const userName = document.getElementById('name');
            const userLastname = document.getElementById('lastname');
            
            // Campos de email
            const companyEmail = document.getElementById('company_email');
            const userEmail = document.getElementById('email');
            
            // Campos de NIF/DNI
            const companyNif = document.getElementById('company_nif');
            const userDni = document.getElementById('dni');
            
            // Campos de contraseña
            const companyPassword = document.getElementById('company_password');
            const companyPasswordConfirm = document.getElementById('company_password_confirmation');
            const userPassword = document.getElementById('password');
            const userPasswordConfirm = document.getElementById('password_confirmation');
            
            // Campos de teléfono
            const companyPhone = document.getElementById('company_phone');
            const userPhone = document.getElementById('phone');
            
            // Elementos de requisitos de contraseña
            const companyPasswordRequirements = document.getElementById('company_password_requirements');
            const passwordRequirements = document.getElementById('password_requirements');
            
            // Elementos de feedback
            const companyNameFeedback = document.getElementById('company_name_feedback');
            const companyNifFeedback = document.getElementById('company_nif_feedback');
            const companyEmailFeedback = document.getElementById('company_email_feedback');
            const companyPhoneFeedback = document.getElementById('company_phone_feedback');
            const nameFeedback = document.getElementById('name_feedback');
            const lastnameFeedback = document.getElementById('lastname_feedback');
            const dniUserFeedback = document.getElementById('dni_feedback');
            const emailFeedback = document.getElementById('email_feedback');
            const phoneFeedback = document.getElementById('phone_feedback');
            const companyPasswordMatch = document.getElementById('company_password_match');
            const companyPasswordMismatch = document.getElementById('company_password_mismatch');
            const passwordMatch = document.getElementById('password_match');
            const passwordMismatch = document.getElementById('password_mismatch');
            
            // Cambio de tipo de usuario
            userTypeSelect.addEventListener('change', function() {
                if (this.value === 'taller') {
                    tallerSection.classList.remove('d-none');
                    userSection.classList.add('d-none');
                    
                    // Hacer requeridos los campos de taller
                    setRequiredFields('taller', true);
                    setRequiredFields('user', false);
                    
                } else if (this.value === 'user') {
                    userSection.classList.remove('d-none');
                    tallerSection.classList.add('d-none');
                    
                    // Hacer requeridos los campos de usuario
                    setRequiredFields('user', true);
                    setRequiredFields('taller', false);
                    
                } else {
                    tallerSection.classList.add('d-none');
                    userSection.classList.add('d-none');
                    
                    // Quitar requeridos de todos los campos
                    setRequiredFields('user', false);
                    setRequiredFields('taller', false);
                }
            });
            
            // Función para establecer campos como requeridos o no
            function setRequiredFields(type, isRequired) {
                if (type === 'taller') {
                    document.getElementById('company_name').required = isRequired;
                    document.getElementById('company_nif').required = isRequired;
                    document.getElementById('company_email').required = isRequired;
                    document.getElementById('company_phone').required = isRequired;
                    document.getElementById('company_password').required = isRequired;
                    document.getElementById('company_password_confirmation').required = isRequired;
                } else if (type === 'user') {
                    document.getElementById('name').required = isRequired;
                    document.getElementById('lastname').required = isRequired;
                    document.getElementById('dni').required = isRequired;
                    document.getElementById('email').required = isRequired;
                    document.getElementById('phone').required = isRequired;
                    document.getElementById('password').required = isRequired;
                    document.getElementById('password_confirmation').required = isRequired;
                }
            }
            
            // Establecer campos requeridos según el tipo de usuario seleccionado inicialmente
            if (userTypeSelect.value === 'taller') {
                setRequiredFields('taller', true);
                setRequiredFields('user', false);
                tallerSection.classList.remove('d-none');
                userSection.classList.add('d-none');
            } else if (userTypeSelect.value === 'user') {
                setRequiredFields('user', true);
                setRequiredFields('taller', false);
                userSection.classList.remove('d-none');
                tallerSection.classList.add('d-none');
            } else {
                setRequiredFields('user', false);
                setRequiredFields('taller', false);
            }
            
            // Previsualización de imágenes
            logoInput.addEventListener('change', function() {
                handleImagePreview(this, logoContainer);
            });
            
            avatarInput.addEventListener('change', function() {
                handleImagePreview(this, avatarContainer);
            });
            
            function handleImagePreview(input, container) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        while (container.firstChild) {
                            container.removeChild(container.firstChild);
                        }
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'img-fluid';
                        img.style.width = '100%';
                        img.style.height = '100%';
                        img.style.objectFit = 'cover';
                        container.appendChild(img);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
            
            // Validación de campos de texto
            if (companyName) {
                companyName.addEventListener('input', function() {
                    validateTextField(this, companyNameFeedback);
                });
            }
            
            if (userName) {
                userName.addEventListener('input', function() {
                    validateTextField(this, nameFeedback);
                });
            }
            
            if (userLastname) {
                userLastname.addEventListener('input', function() {
                    validateTextField(this, lastnameFeedback);
                });
            }
            
            // Función para validar campos de texto
            function validateTextField(input, feedbackElement) {
                const value = input.value.trim();
                
                // Si está vacío, no validamos aún
                if (!value) {
                    input.classList.remove('is-valid', 'is-invalid');
                    if (feedbackElement) feedbackElement.textContent = '';
                    return false;
                }
                
                // Validar que tenga al menos 2 caracteres
                let isValid = value.length >= 2;
                let message = '';
                
                if (!isValid) {
                    message = 'Debe tener al menos 2 caracteres.';
                }
                
                // Actualizar UI según validación
                if (isValid) {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                    if (feedbackElement) feedbackElement.textContent = '';
                } else {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    if (feedbackElement) feedbackElement.textContent = message;
                }
                
                return isValid;
            }
            
            // Validación de email
            if (companyEmail) {
                companyEmail.addEventListener('input', function() {
                    validateEmail(this, companyEmailFeedback);
                });
            }
            
            if (userEmail) {
                userEmail.addEventListener('input', function() {
                    validateEmail(this, emailFeedback);
                });
            }
            
            // Función para validar email
            function validateEmail(input, feedbackElement) {
                const value = input.value.trim();
                
                // Si está vacío, no validamos aún
                if (!value) {
                    input.classList.remove('is-valid', 'is-invalid');
                    if (feedbackElement) feedbackElement.textContent = '';
                    return false;
                }
                
                // Validar formato de email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                let isValid = emailRegex.test(value);
                let message = '';
                
                if (!isValid) {
                    message = 'Formato de email no válido.';
                }
                
                // Actualizar UI según validación
                if (isValid) {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                    if (feedbackElement) feedbackElement.textContent = '';
                } else {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    if (feedbackElement) feedbackElement.textContent = message;
                }
                
                return isValid;
            }
            
            // Mostrar/ocultar requisitos de contraseña al hacer focus/blur
            if (companyPassword) {
                companyPassword.addEventListener('focus', function() {
                    companyPasswordRequirements.classList.add('visible');
                });
                
                companyPassword.addEventListener('blur', function() {
                    companyPasswordRequirements.classList.remove('visible');
                });
                
                // También mostrar al hacer clic en el icono de toggle
                document.getElementById('company_password_toggle_icon').parentElement.addEventListener('click', function() {
                    companyPasswordRequirements.classList.add('visible');
                    setTimeout(() => companyPassword.focus(), 100);
                });
            }
            
            if (userPassword) {
                userPassword.addEventListener('focus', function() {
                    passwordRequirements.classList.add('visible');
                });
                
                userPassword.addEventListener('blur', function() {
                    passwordRequirements.classList.remove('visible');
                });
                
                // También mostrar al hacer clic en el icono de toggle
                document.getElementById('password_toggle_icon').parentElement.addEventListener('click', function() {
                    passwordRequirements.classList.add('visible');
                    setTimeout(() => userPassword.focus(), 100);
                });
            }
            
            // Mostrar/ocultar ayuda de NIF/DNI al hacer focus/blur
            if (companyNif) {
                companyNif.addEventListener('focus', function() {
                    companyNifHelp.classList.add('visible');
                });
                
                companyNif.addEventListener('blur', function() {
                    companyNifHelp.classList.remove('visible');
                });
            }
            
            if (userDni) {
                userDni.addEventListener('focus', function() {
                    dniHelp.classList.add('visible');
                });
                
                userDni.addEventListener('blur', function() {
                    dniHelp.classList.remove('visible');
                });
            }
            
            // Validación de teléfono
            if (companyPhone) {
                companyPhone.addEventListener('input', function() {
                    validatePhone(this, companyPhoneFeedback);
                });
            }
            
            if (userPhone) {
                userPhone.addEventListener('input', function() {
                    validatePhone(this, phoneFeedback);
                });
            }
            
            // Función para validar teléfono
            function validatePhone(input, feedbackElement) {
                const value = input.value.trim();
                
                // Si está vacío, no validamos aún
                if (!value) {
                    input.classList.remove('is-valid', 'is-invalid');
                    if (feedbackElement) feedbackElement.textContent = '';
                    return false;
                }
                
                // Validar formato de teléfono (9 dígitos para España o formato internacional)
                const phoneRegex = /^(\+\d{1,3})?[0-9]{9,15}$/;
                
                let isValid = phoneRegex.test(value);
                let message = '';
                
                if (!isValid) {
                    message = 'Formato de teléfono no válido.';
                }
                
                // Actualizar UI según validación
                if (isValid) {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                    if (feedbackElement) feedbackElement.textContent = '';
                } else {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    if (feedbackElement) feedbackElement.textContent = message;
                }
                
                return isValid;
            }
            
            // Validación de NIF
            if (companyNif) {
                companyNif.addEventListener('input', function() {
                    validateSpanishNIF(this, companyNifFeedback);
                });
            }
            
            if (userDni) {
                userDni.addEventListener('input', function() {
                    validateSpanishNIF(this, dniUserFeedback);
                });
            }
            
            // Función para validar NIF/CIF español
            function validateSpanishNIF(input, feedbackElement) {
                const value = input.value.toUpperCase().trim();
                
                // Si está vacío, no validamos aún
                if (!value) {
                    input.classList.remove('is-valid', 'is-invalid');
                    if (feedbackElement) feedbackElement.textContent = '';
                    return false;
                }
                
                // Expresiones regulares para diferentes tipos de documentos
                const dniRegex = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/;
                const nieRegex = /^[XYZ][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKE]$/;
                const cifRegex = /^[ABCDEFGHJKLMNPQRSUVW][0-9]{7}[0-9A-J]$/;
                
                let isValid = false;
                
                // Validar DNI
                if (dniRegex.test(value)) {
                    const numero = value.substr(0, 8);
                    const letra = value.substr(8, 1);
                    const letraCalculada = calcularLetraDNI(numero);
                    
                    if (letra === letraCalculada) {
                        isValid = true;
                    }
                }
                // Validar NIE
                else if (nieRegex.test(value)) {
                    const primeraLetra = value.charAt(0);
                    let numero = value.substr(1, 7);
                    const letra = value.substr(8, 1);
                    
                    // Convertir la primera letra a número según normativa
                    if (primeraLetra === 'X') numero = '0' + numero;
                    else if (primeraLetra === 'Y') numero = '1' + numero;
                    else if (primeraLetra === 'Z') numero = '2' + numero;
                    
                    const letraCalculada = calcularLetraDNI(numero);
                    
                    if (letra === letraCalculada) {
                        isValid = true;
                    }
                }
                // Validar CIF
                else if (cifRegex.test(value)) {
                    isValid = validarCIF(value);
                }
                
                // Actualizar UI según validación
                if (isValid) {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                    if (feedbackElement) feedbackElement.textContent = '';
                } else {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    if (feedbackElement) feedbackElement.textContent = 'DNI/NIF no válido';
                }
                
                return isValid;
            }
            
            // Función para calcular la letra del DNI
            function calcularLetraDNI(numero) {
                const letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
                const indice = parseInt(numero) % 23;
                return letras.charAt(indice);
            }
            
            // Función para validar CIF
            function validarCIF(cif) {
                const match = cif.match(/^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/);
                if (!match) return false;
                
                const letra = match[1];
                const numero = match[2];
                const control = match[3];
                
                // Cálculo del dígito de control
                let suma = 0;
                
                for (let i = 0; i < numero.length; i++) {
                    let digito = parseInt(numero[i]);
                    
                    // Posiciones pares (0, 2, 4, 6)
                    if (i % 2 === 0) {
                        digito *= 2;
                        if (digito > 9) {
                            digito = Math.floor(digito / 10) + (digito % 10);
                        }
                    }
                    
                    suma += digito;
                }
                
                let controlCalculado;
                const resto = suma % 10;
                if (resto === 0) {
                    controlCalculado = '0';
                } else {
                    controlCalculado = (10 - resto).toString();
                }
                
                // Para entidades que usan letra como dígito de control
                if (/[ABCDEFGHJUV]/.test(letra)) {
                    const letrasControl = 'JABCDEFGHI';
                    if (control === letrasControl.charAt(parseInt(controlCalculado))) {
                        return true;
                    }
                    return control === controlCalculado;
                }
                
                // Para el resto de entidades
                return control === controlCalculado;
            }
            
            // Validación de contraseñas
            if (companyPassword) {
                companyPassword.addEventListener('input', function() {
                    validatePassword(this, 'company_password_feedback');
                    checkPasswordsMatch(companyPassword, companyPasswordConfirm, companyPasswordMatch, companyPasswordMismatch);
                });
            }
            
            if (companyPasswordConfirm) {
                companyPasswordConfirm.addEventListener('input', function() {
                    checkPasswordsMatch(companyPassword, companyPasswordConfirm, companyPasswordMatch, companyPasswordMismatch);
                });
            }
            
            if (userPassword) {
                userPassword.addEventListener('input', function() {
                    validatePassword(this, 'password_feedback');
                    checkPasswordsMatch(userPassword, userPasswordConfirm, passwordMatch, passwordMismatch);
                });
            }
            
            if (userPasswordConfirm) {
                userPasswordConfirm.addEventListener('input', function() {
                    checkPasswordsMatch(userPassword, userPasswordConfirm, passwordMatch, passwordMismatch);
                });
            }
            
            // Validación del formulario antes de enviar
            registerForm.addEventListener('submit', function(event) {
                let isValid = true;
                
                // Validar según el tipo de usuario
                if (userTypeSelect.value === 'taller') {
                    if (!validateTextField(companyName, companyNameFeedback)) {
                        isValid = false;
                    }
                    
                    if (!validateEmail(companyEmail, companyEmailFeedback)) {
                        isValid = false;
                    }
                    
                    if (!validatePassword(companyPassword, 'company_password_feedback')) {
                        isValid = false;
                    }
                    
                    if (companyPassword.value !== companyPasswordConfirm.value) {
                        companyPasswordConfirm.classList.add('is-invalid');
                        companyPasswordMismatch.classList.add('invalid');
                        companyPasswordMatch.classList.remove('valid');
                        isValid = false;
                    }
                    
                    if (!validateSpanishNIF(companyNif, companyNifFeedback)) {
                        isValid = false;
                    }
                    
                    if (!validatePhone(companyPhone, companyPhoneFeedback)) {
                        isValid = false;
                    }
                    
                    // Convertir NIF a mayúsculas
                    companyNif.value = companyNif.value.toUpperCase();
                    
                    // Convertir nombre de empresa a Title Case
                    companyName.value = toTitleCase(companyName.value);
                    
                } else if (userTypeSelect.value === 'user') {
                    if (!validateTextField(userName, nameFeedback)) {
                        isValid = false;
                    }
                    
                    if (!validateTextField(userLastname, lastnameFeedback)) {
                        isValid = false;
                    }
                    
                    if (!validateEmail(userEmail, emailFeedback)) {
                        isValid = false;
                    }
                    
                    if (!validatePassword(userPassword, 'password_feedback')) {
                        isValid = false;
                    }
                    
                    if (userPassword.value !== userPasswordConfirm.value) {
                        userPasswordConfirm.classList.add('is-invalid');
                        passwordMismatch.classList.add('invalid');
                        passwordMatch.classList.remove('valid');
                        isValid = false;
                    }
                    
                    if (!validateSpanishNIF(userDni, dniUserFeedback)) {
                        isValid = false;
                    }
                    
                    if (!validatePhone(userPhone, phoneFeedback)) {
                        isValid = false;
                    }
                    
                    // Convertir DNI a mayúsculas
                    userDni.value = userDni.value.toUpperCase();
                    
                    // Convertir nombre y apellidos a Title Case
                    userName.value = toTitleCase(userName.value);
                    userLastname.value = toTitleCase(userLastname.value);
                }
                
                if (!isValid) {
                    event.preventDefault();
                }
            });
            
            // Función para convertir texto a Title Case (primera letra de cada palabra en mayúscula)
            function toTitleCase(str) {
                return str.replace(/\w\S*/g, function(txt) {
                    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
                });
            }
            
            // Función para validar contraseña
            function validatePassword(input, feedbackId) {
                const value = input.value;
                const hasLowerCase = /[a-z]/.test(value);
                const hasUpperCase = /[A-Z]/.test(value);
                const hasNumber = /\d/.test(value);
                const hasSpecial = /[@\-_+*/#()\[\]{}]/.test(value);
                const isLongEnough = value.length >= 6;
                
                let isValid = true;
                let message = '';
                
                if (!isLongEnough) {
                    isValid = false;
                    message += 'La contraseña debe tener al menos 6 caracteres. ';
                }
                if (!hasLowerCase) {
                    isValid = false;
                    message += 'Debe incluir al menos una letra minúscula. ';
                }
                if (!hasUpperCase) {
                    isValid = false;
                    message += 'Debe incluir al menos una letra mayúscula. ';
                }
                if (!hasNumber) {
                    isValid = false;
                    message += 'Debe incluir al menos un número. ';
                }
                if (!hasSpecial) {
                    isValid = false;
                    message += 'Debe incluir al menos un carácter especial (@-_+*/#()[]{}). ';
                }
                
                const feedbackElement = document.getElementById(feedbackId);
                
                if (isValid) {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                    if (feedbackElement) {
                        feedbackElement.textContent = '';
                    }
                } else {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    if (feedbackElement) {
                        feedbackElement.textContent = message;
                    }
                }
                
                return isValid;
            }
            
            // Función para verificar que las contraseñas coinciden
            function checkPasswordsMatch(passwordInput, confirmInput, matchElement, mismatchElement) {
                if (!passwordInput.value || !confirmInput.value) {
                    matchElement.classList.remove('valid');
                    mismatchElement.classList.remove('invalid');
                    confirmInput.classList.remove('is-valid', 'is-invalid');
                    return;
                }
                
                if (passwordInput.value === confirmInput.value) {
                    confirmInput.classList.remove('is-invalid');
                    confirmInput.classList.add('is-valid');
                    matchElement.classList.add('valid');
                    mismatchElement.classList.remove('invalid');
                } else {
                    confirmInput.classList.remove('is-valid');
                    confirmInput.classList.add('is-invalid');
                    matchElement.classList.remove('valid');
                    mismatchElement.classList.add('invalid');
                }
            }
        });
        
        // Función para mostrar/ocultar contraseña
        function togglePasswordVisibility(inputId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(inputId + '_toggle_icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            }
        }
    </script>
</body>
</html>