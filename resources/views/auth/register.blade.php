<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Registro</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light" style="font-family: 'Instrument Sans', sans-serif;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4">Registro</h2>
                        
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Tipo de usuario -->
                            <div class="mb-3">
                                <label for="user_type" class="form-label fw-medium">Tipo de usuario</label>
                                <select id="user_type" name="user_type" class="form-select py-3 @error('user_type') is-invalid @enderror" required>
                                    <option value="" selected disabled>Elige uno...</option>
                                    <option value="user" {{ old('user_type') == 'user' ? 'selected' : '' }}>Usuario</option>
                                    <option value="taller" {{ old('user_type') == 'taller' ? 'selected' : '' }}>Taller</option>
                                </select>
                                @error('user_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Formulario para Taller -->
                            <div id="taller_section" class="{{ old('user_type') == 'taller' ? '' : 'd-none' }}">
                                <div class="row">
                                    <div class="col-md-4 text-center mb-4">
                                        <div id="logo_container" class="mx-auto mb-3 rounded-circle d-flex justify-content-center align-items-center bg-info bg-opacity-10" style="width: 150px; height: 150px; overflow: hidden;">
                                            <i class="bi bi-person text-info" style="font-size: 60px;"></i>
                                        </div>
                                        <label for="logo" class="btn btn-outline-secondary btn-sm">
                                            Insertar Logo
                                            <input id="logo" type="file" name="logo" accept="image/*" class="d-none" />
                                        </label>
                                        @error('logo')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="company_name" class="form-label fw-medium">Nombre empresa</label>
                                            <input id="company_name" type="text" name="company_name" class="form-control py-3 @error('company_name') is-invalid @enderror" value="{{ old('company_name') }}" />
                                            @error('company_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="company_nif" class="form-label fw-medium">NIF</label>
                                            <input id="company_nif" type="text" name="company_nif" class="form-control py-3 @error('company_nif') is-invalid @enderror" value="{{ old('company_nif') }}" />
                                            @error('company_nif')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="company_email" class="form-label fw-medium">Email</label>
                                            <input id="company_email" type="email" name="company_email" class="form-control py-3 @error('company_email') is-invalid @enderror" value="{{ old('company_email') }}" />
                                            @error('company_email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="company_phone" class="form-label fw-medium">Teléfono</label>
                                            <input id="company_phone" type="tel" name="company_phone" class="form-control py-3 @error('company_phone') is-invalid @enderror" value="{{ old('company_phone') }}" />
                                            @error('company_phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="company_password" class="form-label fw-medium">Contraseña</label>
                                            <input id="company_password" type="password" name="company_password" class="form-control py-3 @error('company_password') is-invalid @enderror" />
                                            @error('company_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="company_password_confirmation" class="form-label fw-medium">Repetir contraseña</label>
                                            <input id="company_password_confirmation" type="password" name="company_password_confirmation" class="form-control py-3 @error('company_password_confirmation') is-invalid @enderror" />
                                            @error('company_password_confirmation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Formulario para Usuario -->
                            <div id="user_section" class="{{ old('user_type') == 'user' ? '' : 'd-none' }}">
                                <div class="row">
                                    <div class="col-md-4 text-center mb-4">
                                        <div id="avatar_container" class="mx-auto mb-3 rounded-circle d-flex justify-content-center align-items-center bg-info bg-opacity-10" style="width: 150px; height: 150px; overflow: hidden;">
                                            <i class="bi bi-person text-info" style="font-size: 60px;"></i>
                                        </div>
                                        <label for="avatar" class="btn btn-outline-secondary btn-sm">
                                            Insertar Avatar
                                            <input id="avatar" type="file" name="avatar" accept="image/*" class="d-none" />
                                        </label>
                                        @error('avatar')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="name" class="form-label fw-medium">Nombre</label>
                                            <input id="name" type="text" name="name" class="form-control py-3 @error('name') is-invalid @enderror" value="{{ old('name') }}" />
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label fw-medium">Apellidos</label>
                                            <input id="lastname" type="text" name="lastname" class="form-control py-3 @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}" />
                                            @error('lastname')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="dni" class="form-label fw-medium">DNI</label>
                                            <input id="dni" type="text" name="dni" class="form-control py-3 @error('dni') is-invalid @enderror" value="{{ old('dni') }}" />
                                            @error('dni')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="email" class="form-label fw-medium">Email</label>
                                            <input id="email" type="email" name="email" class="form-control py-3 @error('email') is-invalid @enderror" value="{{ old('email') }}" />
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="phone" class="form-label fw-medium">Teléfono</label>
                                            <input id="phone" type="tel" name="phone" class="form-control py-3 @error('phone') is-invalid @enderror" value="{{ old('phone') }}" />
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="password" class="form-label fw-medium">Contraseña</label>
                                            <input id="password" type="password" name="password" class="form-control py-3 @error('password') is-invalid @enderror" />
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label fw-medium">Repetir contraseña</label>
                                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control py-3 @error('password_confirmation') is-invalid @enderror" />
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="/login" class="btn btn-outline-secondary">Acceder</a>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userTypeSelect = document.getElementById('user_type');
            const tallerSection = document.getElementById('taller_section');
            const userSection = document.getElementById('user_section');
            
            // Logo para taller
            const logoInput = document.getElementById('logo');
            const logoContainer = document.getElementById('logo_container');
            
            // Avatar para usuario
            const avatarInput = document.getElementById('avatar');
            const avatarContainer = document.getElementById('avatar_container');
            
            // Mostrar sección según selección
            userTypeSelect.addEventListener('change', function() {
                if (this.value === 'taller') {
                    tallerSection.classList.remove('d-none');
                    userSection.classList.add('d-none');
                } else if (this.value === 'user') {
                    userSection.classList.remove('d-none');
                    tallerSection.classList.add('d-none');
                } else {
                    tallerSection.classList.add('d-none');
                    userSection.classList.add('d-none');
                }
            });
            
            // Previsualización del logo
            logoInput.addEventListener('change', function() {
                handleImagePreview(this, logoContainer);
            });
            
            // Previsualización del avatar
            avatarInput.addEventListener('change', function() {
                handleImagePreview(this, avatarContainer);
            });
            
            // Función para manejar la previsualización de imágenes
            function handleImagePreview(input, container) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        // Limpiar el contenedor
                        while (container.firstChild) {
                            container.removeChild(container.firstChild);
                        }
                        
                        // Crear la imagen de previsualización
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.width = '100%';
                        img.style.height = '100%';
                        img.style.objectFit = 'cover';
                        container.appendChild(img);
                    };
                    
                    reader.readAsDataURL(input.files[0]);
                }
            }
            
            // Inicializar la visualización correcta según el valor seleccionado
            if (userTypeSelect.value === 'taller') {
                tallerSection.classList.remove('d-none');
                userSection.classList.add('d-none');
            } else if (userTypeSelect.value === 'user') {
                userSection.classList.remove('d-none');
                tallerSection.classList.add('d-none');
            }
        });
    </script>
</body>
</html>