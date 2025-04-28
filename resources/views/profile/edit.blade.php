<x-app-layout>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="profile-image-container mb-3">
                            @if(Auth::user()->logo)
                                <img src="{{ asset('storage/' . Auth::user()->logo) }}" 
                                     alt="Logo del taller" class="profile-image rounded-3" 
                                     style="width: 150px; height: 150px; object-fit: cover;"
                                     onerror="this.onerror=null; this.src='{{ asset('galeria/logo.png') }}';">
                            @else
                                <img src="{{ asset('galeria/logo.png') }}" 
                                     alt="Logo por defecto" class="profile-image rounded-3" 
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            @endif
                        </div>
                        <h4 class="mb-1">{{ Auth::user()->name }}</h4>
                        <p class="text-muted">{{ Auth::user()->email }}</p>
                        <span class="badge bg-primary">{{ ucfirst(Auth::user()->role) }}</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Información del Perfil</h5>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            <i class="bi bi-pencil-square me-1"></i>Editar
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Nombre:</div>
                            <div class="col-md-8">{{ Auth::user()->name }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Email:</div>
                            <div class="col-md-8">{{ Auth::user()->email }}</div>
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
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Fecha de registro:</div>
                            <div class="col-md-8">{{ Auth::user()->created_at->format('d/m/Y') }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Logo</h5>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editLogoModal">
                            <i class="bi bi-image me-1"></i>Cambiar Logo
                        </button>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-3">El logo se muestra en la barra de navegación y en tu perfil.</p>
                        @if(session('status') === 'logo-updated')
                            <div class="alert alert-success">Logo actualizado correctamente.</div>
                        @endif
                    </div>
                </div>
                
                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Contraseña</h5>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            <i class="bi bi-key me-1"></i>Cambiar Contraseña
                        </button>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-3">Asegúrate de usar una contraseña segura para proteger tu cuenta.</p>
                        @if(session('status') === 'password-updated')
                            <div class="alert alert-success">Contraseña actualizada correctamente.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal para editar perfil -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.update') }}">
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
    
    <!-- Modal para cambiar logo -->
    <div class="modal fade" id="editLogoModal" tabindex="-1" aria-labelledby="editLogoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.logo.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLogoModalLabel">Cambiar Logo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="logo" class="form-label">Seleccionar nuevo logo</label>
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
                        <button type="submit" class="btn btn-primary">Subir Logo</button>
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
    
    <script>
        // Script para previsualizar la imagen antes de subirla
        document.getElementById('logo').onchange = function(evt) {
            const [file] = this.files;
            if (file) {
                const preview = document.getElementById('logoPreview');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        };
        
        // Mostrar los modales si hay errores de validación
        document.addEventListener('DOMContentLoaded', function() {
            @if($errors->updatePassword->any())
                new bootstrap.Modal(document.getElementById('changePasswordModal')).show();
            @endif
            
            @if($errors->has('logo'))
                new bootstrap.Modal(document.getElementById('editLogoModal')).show();
            @endif
            
            @if($errors->hasAny(['name', 'company_name', 'company_nif', 'phone']))
                new bootstrap.Modal(document.getElementById('editProfileModal')).show();
            @endif
        });
    </script>
    
    <style>
        .card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        
        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem;
        }
        
        .profile-image-container {
            position: relative;
            display: inline-block;
        }
        
        .profile-image {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border: 4px solid #fff;
        }
        
        .modal-header, .modal-footer {
            border-color: rgba(0, 0, 0, 0.05);
        }
        
        .badge {
            font-weight: 500;
            padding: 0.5em 0.75em;
        }
    </style>
</x-app-layout>