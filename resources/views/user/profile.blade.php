<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('galeria/logo.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('galeria/logo.png') }}">

    <title>{{ config('app.name', 'MiraCar') }} - Perfil de Usuario</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Estilos personalizados -->
    <style>
        body {
            background: linear-gradient(120deg, #e3ecff 0%, #f4f6f8 60%, #d0e2ff 100%);
            font-family: 'Instrument Sans', sans-serif;
            padding-top: 80px;
            min-height: 100vh;
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
        
        .profile-card {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 8px 40px 0 rgba(79,140,255,0.13), 0 1.5px 8px 0 rgba(79,140,255,0.07);
            overflow: hidden;
            position: relative;
            z-index: 1;
        }
        
        .profile-header {
            background: linear-gradient(90deg, #4f8cff 0%, #235390 100%);
            padding: 1.5rem;
            color: white;
        }
        
        .profile-section {
            padding: 1.5rem;
            border-bottom: 1px solid #e3ecff;
        }
        
        .profile-section:last-child {
            border-bottom: none;
        }
        
        .section-title {
            font-weight: 600;
            color: #235390;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e3ecff;
        }
        
        .profile-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border: 4px solid #fff;
        }
        
        .btn-action {
            border-radius: 0.75rem;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.2s;
            box-shadow: 0 2px 12px rgba(79,140,255,0.13);
        }
        
        .btn-action:hover {
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 4px 18px rgba(79,140,255,0.18);
        }
        
        .danger-section {
            background-color: #fff8f8;
            border-top: 1px solid #ffdddd;
        }
        
        .btn-danger-action {
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 0.75rem;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.2s;
            box-shadow: 0 2px 12px rgba(220, 53, 69, 0.2);
        }
        
        .btn-danger-action:hover {
            background-color: #c82333;
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 4px 18px rgba(220, 53, 69, 0.3);
        }
        
        .modal-danger .modal-header {
            background-color: #dc3545;
            color: white;
        }
        
        .modal-danger .btn-close {
            filter: brightness(0) invert(1);
        }
        
        /* Estilos para el campo de contraseña con icono de ojo */
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
            background: none;
            border: none;
        }
        
        .password-toggle:hover {
            color: #4f8cff;
        }
        
        .password-toggle:focus {
            outline: none;
        }
        
        /* Ajuste para el icono dentro del input */
        .password-input {
            padding-right: 40px;
        }
        
        /* Estilos para formularios */
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
            padding: 0.75rem 1.5rem;
            transition: background 0.18s, box-shadow 0.18s, transform 0.13s;
            box-shadow: 0 2px 12px rgba(79,140,255,0.13);
        }
        
        .btn-primary:hover {
            background: linear-gradient(90deg, #235390, #4f8cff 90%);
            transform: translateY(-2px) scale(1.03);
        }
        
        .btn-secondary {
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .invalid-feedback, .text-danger {
            font-size: 0.85rem;
        }
        
        .alert {
            border-radius: 0.75rem;
            font-size: 0.9rem;
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
        
        /* Estilos para el modal */
        .modal-content {
            border-radius: 1rem;
            border: none;
            box-shadow: 0 8px 40px 0 rgba(79,140,255,0.13), 0 1.5px 8px 0 rgba(79,140,255,0.07);
        }
        
        .modal-header {
            background: linear-gradient(90deg, #4f8cff 0%, #235390 100%);
            color: white;
            border-bottom: none;
            padding: 1.25rem 1.5rem;
        }
        
        .modal-title {
            font-weight: 600;
        }
        
        .modal-body {
            padding: 1.5rem;
        }
        
        .modal-footer {
            border-top: 1px solid #e3ecff;
            padding: 1rem 1.5rem;
        }
        
        /* Estilos para la imagen de perfil */
        .profile-image-container {
            border: 2px dashed #b6d0ff;
            background: #fafdff;
            transition: border-color 0.18s, box-shadow 0.18s;
            width: 120px;
            height: 120px;
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .profile-image-container:focus-within {
            border-color: #4f8cff;
        }
    </style>
</head>
<body>
    <!-- Fondo con degradado y blur -->
    <div class="auth-bg-blur"></div>
    
    <!-- Incluir la barra de navegación -->
    @include('layouts.navigation')
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="profile-card mb-4">
                    <div class="profile-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0">Mi Perfil</h4>
                            <p class="mb-0 opacity-75">Gestiona tu información personal</p>
                        </div>
                        <span class="badge bg-primary fs-6">
                            {{ ucfirst(Auth::user()->role) }}
                        </span>
                    </div>
                    
                    <div class="profile-section">
                        <div class="row">
                            <div class="col-md-4 text-center mb-4 mb-md-0">
                                <div class="mb-3">
                                    @if(Auth::user()->role === 'taller' && Auth::user()->logo)
                                        <img src="{{ asset('storage/' . Auth::user()->logo) }}" 
                                             alt="Logo" class="profile-image" 
                                             onerror="this.onerror=null; this.src='{{ asset('galeria/logo.png') }}';">
                                    @elseif(Auth::user()->role === 'user' && Auth::user()->avatar)
                                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                             alt="Avatar" class="profile-image" 
                                             onerror="this.onerror=null; this.src='{{ asset('galeria/logo.png') }}';">
                                    @else
                                        <img src="{{ asset('galeria/logo.png') }}" 
                                             alt="Imagen por defecto" class="profile-image">
                                    @endif
                                </div>
                                <h5 class="mb-1">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</h5>
                                <p class="text-muted mb-3">{{ Auth::user()->email }}</p>
                                
                                <button type="button" class="btn btn-primary btn-action" data-bs-toggle="modal" data-bs-target="#editImageModal">
                                    <i class="bi bi-image me-1"></i>Cambiar {{ Auth::user()->role === 'taller' ? 'Logo' : 'Avatar' }}
                                </button>
                            </div>
                            
                            <div class="col-md-8">
                                <h5 class="section-title">Información Personal</h5>
                                <div class="row mb-3">
                                    <div class="col-md-4 fw-bold">Nombre:</div>
                                    <div class="col-md-8">{{ Auth::user()->name }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4 fw-bold">Apellidos:</div>
                                    <div class="col-md-8">{{ Auth::user()->lastname ?? 'No especificado' }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4 fw-bold">Email:</div>
                                    <div class="col-md-8">{{ Auth::user()->email }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4 fw-bold">DNI:</div>
                                    <div class="col-md-8">{{ Auth::user()->dni ?? 'No especificado' }}</div>
                                </div>
                                @if(Auth::user()->role === 'taller')
                                <div class="row mb-3">
                                    <div class="col-md-4 fw-bold">Nombre de la Empresa:</div>
                                    <div class="col-md-8">{{ Auth::user()->company_name ?? 'No especificado' }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4 fw-bold">NIF/CIF:</div>
                                    <div class="col-md-8">{{ Auth::user()->company_nif ?? 'No especificado' }}</div>
                                </div>
                                @endif
                                <div class="row mb-3">
                                    <div class="col-md-4 fw-bold">Teléfono:</div>
                                    <div class="col-md-8">{{ Auth::user()->phone ?? 'No especificado' }}</div>
                                </div>
                                
                                <div class="mt-4">
                                    <button type="button" class="btn btn-primary btn-action" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                        <i class="bi bi-pencil-square me-1"></i>Editar Información
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="profile-section">
                        <h5 class="section-title">Seguridad</h5>
                        <p class="text-muted mb-4">Gestiona tu contraseña y la seguridad de tu cuenta</p>
                        
                        <button type="button" class="btn btn-primary btn-action" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            <i class="bi bi-key me-1"></i>Cambiar Contraseña
                        </button>
                    </div>
                    
                    <!-- Nueva sección para eliminar cuenta -->
                    <div class="profile-section danger-section">
                        <h5 class="section-title text-danger">Eliminar Cuenta</h5>
                        <p class="text-muted mb-4">Una vez que elimines tu cuenta, todos tus recursos y datos serán eliminados permanentemente. Esta acción no se puede deshacer.</p>
                        
                        <button type="button" class="btn btn-danger-action" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                            <i class="bi bi-trash me-1"></i>Eliminar Cuenta
                        </button>
                    </div>
                </div>
                
                @if(session('status') === 'profile-updated')
                    <div class="alert alert-success alert-dismissible fade show">
                        Perfil actualizado correctamente.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if(session('status') === 'logo-updated' || session('status') === 'avatar-updated')
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ Auth::user()->role === 'taller' ? 'Logo' : 'Avatar' }} actualizado correctamente.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if(session('status') === 'password-updated')
                    <div class="alert alert-success alert-dismissible fade show">
                        Contraseña actualizada correctamente.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal para editar perfil -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('user.profile.update') }}" id="editProfileForm">
                    @csrf
                    @method('patch')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileModalLabel">Editar Perfil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if(Auth::user()->role === 'taller')
                            <div class="mb-3">
                                <label for="name" class="form-label required-field">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                                <div id="name_feedback" class="invalid-feedback"></div>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="company_name" class="form-label required-field">Nombre empresa</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', Auth::user()->company_name) }}" required>
                                <div id="company_name_feedback" class="invalid-feedback"></div>
                                @error('company_name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="company_nif" class="form-label required-field">NIF/CIF</label>
                                <input type="text" class="form-control" id="company_nif" name="company_nif" value="{{ old('company_nif', Auth::user()->company_nif) }}" required>
                                <div id="company_nif_help" class="document-help">
                                    Formato: CIF (B12345678) o NIF (12345678Z)
                                </div>
                                <div id="company_nif_feedback" class="invalid-feedback"></div>
                                @error('company_nif')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="phone" class="form-label required-field">Teléfono</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}" required>
                                <div id="phone_feedback" class="invalid-feedback"></div>
                                @error('phone')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        @else
                            <div class="mb-3">
                                <label for="name" class="form-label required-field">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                                <div id="name_feedback" class="invalid-feedback"></div>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname', Auth::user()->lastname) }}">
                                <div id="lastname_feedback" class="invalid-feedback"></div>
                                @error('lastname')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="dni" class="form-label">DNI/NIE</label>
                                <input type="text" class="form-control" id="dni" name="dni" value="{{ old('dni', Auth::user()->dni) }}">
                                <div id="dni_help" class="document-help">
                                    Formato: DNI (12345678Z) o NIE (X1234567L)
                                </div>
                                <div id="dni_feedback" class="invalid-feedback"></div>
                                @error('dni')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="phone" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}">
                                <div id="phone_feedback" class="invalid-feedback"></div>
                                @error('phone')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para cambiar imagen (logo o avatar) -->
    <div class="modal fade" id="editImageModal" tabindex="-1" aria-labelledby="editImageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('user.profile.logo') }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editImageModalLabel">Cambiar {{ Auth::user()->role === 'taller' ? 'Logo' : 'Avatar' }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <div class="profile-image-container mx-auto mb-3">
                                @if(Auth::user()->role === 'taller' && Auth::user()->logo)
                                    <img id="logoPreview" src="{{ asset('storage/' . Auth::user()->logo) }}" 
                                         alt="Logo" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;"
                                         onerror="this.onerror=null; this.src='{{ asset('galeria/logo.png') }}';">
                                @elseif(Auth::user()->role === 'user' && Auth::user()->avatar)
                                    <img id="logoPreview" src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                         alt="Avatar" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;"
                                         onerror="this.onerror=null; this.src='{{ asset('galeria/logo.png') }}';">
                                @else
                                    <img id="logoPreview" src="{{ asset('galeria/logo.png') }}" 
                                         alt="Imagen por defecto" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                                @endif
                            </div>
                            
                            <label for="logo" class="btn btn-outline-primary">
                                <i class="bi bi-upload me-1"></i>Seleccionar nueva imagen
                                <input type="file" class="form-control d-none" id="logo" name="logo" accept="image/*" required>
                            </label>
                            <div class="form-text mt-2">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB.</div>
                            @error('logo')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Subir Imagen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para cambiar contraseña -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('password.update') }}" id="changePasswordForm">
                    @csrf
                    @method('put')
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Cambiar Contraseña</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="current_password" class="form-label required-field">Contraseña Actual</label>
                            <div class="password-container">
                                <input type="password" class="form-control password-input" id="current_password" name="current_password" required>
                                <button type="button" class="password-toggle" onclick="togglePasswordVisibility('current_password')">
                                    <i class="bi bi-eye-slash" id="current_password_toggle_icon"></i>
                                </button>
                            </div>
                            @error('current_password', 'updatePassword')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label required-field">Nueva Contraseña</label>
                            <div class="password-container">
                                <input type="password" class="form-control password-input" id="password" name="password" required minlength="6">
                                <button type="button" class="password-toggle" onclick="togglePasswordVisibility('password')">
                                    <i class="bi bi-eye-slash" id="password_toggle_icon"></i>
                                </button>
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
                            @error('password', 'updatePassword')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label required-field">Confirmar Nueva Contraseña</label>
                            <div class="password-container">
                                <input type="password" class="form-control password-input" id="password_confirmation" name="password_confirmation" required>
                                <button type="button" class="password-toggle" onclick="togglePasswordVisibility('password_confirmation')">
                                    <i class="bi bi-eye-slash" id="password_confirmation_toggle_icon"></i>
                                </button>
                            </div>
                            <div id="password_match" class="password-match-feedback">Las contraseñas coinciden</div>
                            <div id="password_mismatch" class="password-match-feedback">Las contraseñas no coinciden</div>
                            @error('password_confirmation', 'updatePassword')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Modal para eliminar cuenta -->
    <div class="modal fade modal-danger" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAccountModalLabel">¿Estás seguro de que quieres eliminar tu cuenta?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Advertencia:</strong> Esta acción no se puede deshacer.
                    </div>
                    <p>Una vez que elimines tu cuenta, todos tus recursos y datos serán eliminados permanentemente.</p>
                    <form method="post" action="{{ route('profile.destroy') }}" id="deleteAccountForm">
                        @csrf
                        @method('delete')
                        <div class="mb-3">
                            <label for="delete_password" class="form-label required-field">Ingresa tu contraseña para confirmar</label>
                            <div class="password-container">
                                <input type="password" class="form-control password-input" id="delete_password" name="password" required>
                                <button type="button" class="password-toggle" onclick="togglePasswordVisibility('delete_password')">
                                    <i class="bi bi-eye-slash" id="delete_password_toggle_icon"></i>
                                </button>
                            </div>
                            @error('password', 'userDeletion')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="document.getElementById('deleteAccountForm').submit();">
                        <i class="bi bi-trash me-1"></i>Eliminar Cuenta
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Scripts personalizados -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Previsualización de imagen
            document.getElementById('logo').onchange = function(evt) {
                const [file] = this.files;
                if (file) {
                    const preview = document.getElementById('logoPreview');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';
                }
            };
            
            // Mostrar los modales si hay errores de validación
            @if($errors->has('updatePassword') && $errors->updatePassword->any())
                new bootstrap.Modal(document.getElementById('changePasswordModal')).show();
            @endif
            
            @if($errors->has('logo'))
                new bootstrap.Modal(document.getElementById('editImageModal')).show();
            @endif
            
            @if($errors->hasAny(['name', 'lastname', 'dni', 'company_name', 'company_nif', 'phone']))
                new bootstrap.Modal(document.getElementById('editProfileModal')).show();
            @endif
            
            @if($errors->has('userDeletion') && $errors->userDeletion->any())
                new bootstrap.Modal(document.getElementById('deleteAccountModal')).show();
            @endif
            
            // Validación de campos de texto
            const textFields = document.querySelectorAll('input[type="text"]');
            textFields.forEach(function(input) {
                input.addEventListener('input', function() {
                    validateTextField(this);
                });
            });
            
            // Validación de teléfono
            const phoneFields = document.querySelectorAll('input[type="tel"]');
            phoneFields.forEach(function(input) {
                input.addEventListener('input', function() {
                    validatePhone(this);
                });
            });
            
            // Validación de NIF/DNI
            const dniField = document.getElementById('dni');
            if (dniField) {
                dniField.addEventListener('input', function() {
                    validateSpanishNIF(this);
                });
                
                dniField.addEventListener('focus', function() {
                    document.getElementById('dni_help').classList.add('visible');
                });
                
                dniField.addEventListener('blur', function() {
                    document.getElementById('dni_help').classList.remove('visible');
                });
            }
            
            const companyNifField = document.getElementById('company_nif');
            if (companyNifField) {
                companyNifField.addEventListener('input', function() {
                    validateSpanishNIF(this);
                });
                
                companyNifField.addEventListener('focus', function() {
                    document.getElementById('company_nif_help').classList.add('visible');
                });
                
                companyNifField.addEventListener('blur', function() {
                    document.getElementById('company_nif_help').classList.remove('visible');
                });
            }
            
            // Validación de contraseñas
            const passwordField = document.getElementById('password');
            const passwordConfirmField = document.getElementById('password_confirmation');
            
            if (passwordField) {
                passwordField.addEventListener('input', function() {
                    validatePassword(this);
                    if (passwordConfirmField.value) {
                        checkPasswordsMatch();
                    }
                });
                
                passwordField.addEventListener('focus', function() {
                    document.getElementById('password_requirements').classList.add('visible');
                });
                
                passwordField.addEventListener('blur', function() {
                    document.getElementById('password_requirements').classList.remove('visible');
                });
            }
            
            if (passwordConfirmField) {
                passwordConfirmField.addEventListener('input', function() {
                    checkPasswordsMatch();
                });
            }
            
            // Validación del formulario de edición de perfil
            const editProfileForm = document.getElementById('editProfileForm');
            if (editProfileForm) {
                editProfileForm.addEventListener('submit', function(event) {
                    let isValid = true;
                    
                    // Validar campos de texto
                    const requiredFields = this.querySelectorAll('input[required]');
                    requiredFields.forEach(function(field) {
                        if (field.type === 'text') {
                            if (!validateTextField(field)) {
                                isValid = false;
                            }
                        } else if (field.type === 'tel') {
                            if (!validatePhone(field)) {
                                isValid = false;
                            }
                        } else if (field.id === 'company_nif') {
                            if (!validateSpanishNIF(field)) {
                                isValid = false;
                            }
                        }
                    });
                    
                    if (!isValid) {
                        event.preventDefault();
                    }
                });
            }
            
            // Validación del formulario de cambio de contraseña
            const changePasswordForm = document.getElementById('changePasswordForm');
            if (changePasswordForm) {
                changePasswordForm.addEventListener('submit', function(event) {
                    let isValid = true;
                    
                    if (!validatePassword(passwordField)) {
                        isValid = false;
                    }
                    
                    if (passwordField.value !== passwordConfirmField.value) {
                        passwordConfirmField.classList.add('is-invalid');
                        document.getElementById('password_mismatch').classList.add('invalid');
                        document.getElementById('password_match').classList.remove('valid');
                        isValid = false;
                    }
                    
                    if (!isValid) {
                        event.preventDefault();
                    }
                });
            }
            
            // Función para validar campos de texto
            function validateTextField(input) {
                const value = input.value.trim();
                const feedbackId = input.id + '_feedback';
                const feedbackElement = document.getElementById(feedbackId);
                
                // Si está vacío y es requerido
                if (value === '' && input.hasAttribute('required')) {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    if (feedbackElement) {
                        feedbackElement.textContent = 'Este campo es obligatorio.';
                    }
                    return false;
                }
                
                // Si está vacío pero no es requerido
                if (value === '' && !input.hasAttribute('required')) {
                    input.classList.remove('is-valid', 'is-invalid');
                    if (feedbackElement) {
                        feedbackElement.textContent = '';
                    }
                    return true;
                }
                
                // Validar que tenga al menos 2 caracteres
                if (value.length < 2) {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    if (feedbackElement) {
                        feedbackElement.textContent = 'Debe tener al menos 2 caracteres.';
                    }
                    return false;
                }
                
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
                if (feedbackElement) {
                    feedbackElement.textContent = '';
                }
                return true;
            }
            
            // Función para validar teléfono
            function validatePhone(input) {
                const value = input.value.trim();
                const feedbackId = input.id + '_feedback';
                const feedbackElement = document.getElementById(feedbackId);
                
                // Si está vacío y es requerido
                if (value === '' && input.hasAttribute('required')) {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    if (feedbackElement) {
                        feedbackElement.textContent = 'Este campo es obligatorio.';
                    }
                    return false;
                }
                
                // Si está vacío pero no es requerido
                if (value === '' && !input.hasAttribute('required')) {
                    input.classList.remove('is-valid', 'is-invalid');
                    if (feedbackElement) {
                        feedbackElement.textContent = '';
                    }
                    return true;
                }
                
                // Validar formato de teléfono (9 dígitos para España o formato internacional)
                const phoneRegex = /^(\+\d{1,3})?[0-9]{9,15}$/;
                
                if (!phoneRegex.test(value)) {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    if (feedbackElement) {
                        feedbackElement.textContent = 'Formato de teléfono no válido.';
                    }
                    return false;
                }
                
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
                if (feedbackElement) {
                    feedbackElement.textContent = '';
                }
                return true;
            }
            
            // Función para validar NIF/CIF español
            function validateSpanishNIF(input) {
                const value = input.value.toUpperCase().trim();
                const feedbackId = input.id + '_feedback';
                const feedbackElement = document.getElementById(feedbackId);
                
                // Si está vacío y es requerido
                if (value === '' && input.hasAttribute('required')) {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    if (feedbackElement) {
                        feedbackElement.textContent = 'Este campo es obligatorio.';
                    }
                    return false;
                }
                
                // Si está vacío pero no es requerido
                if (value === '' && !input.hasAttribute('required')) {
                    input.classList.remove('is-valid', 'is-invalid');
                    if (feedbackElement) {
                        feedbackElement.textContent = '';
                    }
                    return true;
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
                        feedbackElement.textContent = 'DNI/NIF no válido';
                    }
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
            
            // Función para validar contraseña
            function validatePassword(input) {
                const value = input.value;
                const feedbackElement = document.getElementById('password_feedback');
                
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
            function checkPasswordsMatch() {
                const passwordField = document.getElementById('password');
                const passwordConfirmField = document.getElementById('password_confirmation');
                const matchElement = document.getElementById('password_match');
                const mismatchElement = document.getElementById('password_mismatch');
                
                if (!passwordField.value || !passwordConfirmField.value) {
                    matchElement.classList.remove('valid');
                    mismatchElement.classList.remove('invalid');
                    passwordConfirmField.classList.remove('is-valid', 'is-invalid');
                    return;
                }
                
                if (passwordField.value === passwordConfirmField.value) {
                    passwordConfirmField.classList.remove('is-invalid');
                    passwordConfirmField.classList.add('is-valid');
                    matchElement.classList.add('valid');
                    mismatchElement.classList.remove('invalid');
                } else {
                    passwordConfirmField.classList.remove('is-valid');
                    passwordConfirmField.classList.add('is-invalid');
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