<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MiraCar') }} - Perfil de Usuario</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 80px;
        }
        
        .taller-navbar {
            background: linear-gradient(90deg, #4f8cff 0%, #235390 100%);
            box-shadow: 0 2px 12px rgba(79,140,255,0.08);
            padding: 0.7rem 2rem;
            border-bottom-left-radius: 18px;
            border-bottom-right-radius: 18px;
            margin-bottom: 32px;
        }
        
        .profile-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .profile-header {
            background: linear-gradient(90deg, #4f8cff 0%, #235390 100%);
            padding: 1.5rem;
            color: white;
        }
        
        .profile-section {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
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
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <!-- Incluir la barra de navegación -->
    @include('layouts.navigation')
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card profile-card mb-4">
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
                <form method="post" action="{{ route('user.profile.update') }}">
                    @csrf
                    @method('patch')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileModalLabel">Editar Perfil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname', Auth::user()->lastname) }}">
                            @error('lastname')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni" value="{{ old('dni', Auth::user()->dni) }}">
                            @error('dni')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        @if(Auth::user()->role === 'taller')
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Nombre de la Empresa</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', Auth::user()->company_name) }}">
                            @error('company_name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="company_nif" class="form-label">NIF/CIF</label>
                            <input type="text" class="form-control" id="company_nif" name="company_nif" value="{{ old('company_nif', Auth::user()->company_nif) }}">
                            @error('company_nif')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        @endif
                        
                        <div class="mb-3">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}">
                            @error('phone')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
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
                        <div class="mb-3">
                            <label for="logo" class="form-label">Seleccionar nueva imagen</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*" required>
                            <div class="form-text">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB.</div>
                            @error('logo')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mt-3">
                            <div class="text-center">
                                <img id="logoPreview" src="#" alt="Vista previa" style="max-width: 200px; max-height: 200px; display: none;">
                            </div>
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
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Cambiar Contraseña</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Contraseña Actual</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                            @error('current_password', 'updatePassword')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Nueva Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password', 'updatePassword')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
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
        });
    </script>
</body>
</html>
