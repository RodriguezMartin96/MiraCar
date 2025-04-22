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

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(120deg, #e3ecff 0%, #f4f6f8 60%, #d0e2ff 100%);
            font-family: 'Instrument Sans', sans-serif;
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
            border-radius: 1.5rem;
            box-shadow: 0 8px 40px 0 rgba(79,140,255,0.13), 0 1.5px 8px 0 rgba(79,140,255,0.07);
            padding: 2.5rem 2rem 2rem 2rem;
            max-width: 540px;
            margin: 120px auto 0 auto;
            position: relative;
            z-index: 1;
        }
        .auth-title {
            font-size: 2rem;
            font-weight: 700;
            color: #235390;
            text-align: center;
            margin-bottom: 2rem;
        }
        .form-label {
            color: #235390;
            font-weight: 600;
        }
        .form-control, .form-select {
            border-radius: 0.75rem;
            border: 1.5px solid #e3ecff;
            padding: 0.9rem 1rem;
            font-size: 1rem;
            margin-bottom: 1rem;
            background: #fafdff;
        }
        .form-control:focus, .form-select:focus {
            border-color: #4f8cff;
            box-shadow: 0 0 0 0.2rem #b6d0ff55;
            background: #fff;
        }
        .btn-primary {
            background: linear-gradient(90deg, #4f8cff, #235390 90%);
            border: none;
            border-radius: 0.75rem;
            font-weight: 700;
            font-size: 1.1rem;
            padding: 0.8rem 0;
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
        }
        .auth-links {
            text-align: center;
            margin-top: 1.5rem;
        }
        .auth-links a {
            color: #4f8cff;
            text-decoration: none;
            font-weight: 700;
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
            font-size: 0.97rem;
        }
        .alert {
            border-radius: 0.75rem;
        }
        #logo_container, #avatar_container {
            border: 2px dashed #b6d0ff;
            background: #fafdff;
            transition: border-color 0.18s, box-shadow 0.18s;
        }
        #logo_container img, #avatar_container img {
            border-radius: 50%;
        }
        #logo_container:focus-within, #avatar_container:focus-within {
            border-color: #4f8cff;
        }
        @media (max-width: 600px) {
            .auth-card {
                padding: 1rem 0.5rem;
                max-width: 99vw;
                margin: 30px auto 0 auto;
            }
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
        }
        .btn-outline-primary:hover {
            background: #4f8cff;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="auth-bg-blur"></div>
    <div class="auth-card">
        <div class="auth-title">Registrarse</div>
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="mb-3">
                <label for="user_type" class="form-label">Tipo de usuario</label>
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
            <div id="taller_section" class="row g-3 {{ old('user_type') == 'taller' ? '' : 'd-none' }}">
                <div class="col-12 col-md-4 text-center">
                    <div id="logo_container" class="mx-auto mb-3 rounded-circle d-flex justify-content-center align-items-center bg-info bg-opacity-10" style="width: 120px; height: 120px; overflow: hidden;">
                        <i class="bi bi-person text-info" style="font-size: 48px;"></i>
                    </div>
                    <label for="logo" class="btn btn-outline-secondary btn-sm w-100">
                        Insertar Logo
                        <input id="logo" type="file" name="logo" accept="image/*" class="d-none" />
                    </label>
                    @error('logo')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-8">
                    <div class="mb-2">
                        <label for="company_name" class="form-label">Nombre empresa</label>
                        <input id="company_name" type="text" name="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name') }}" />
                        @error('company_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="company_nif" class="form-label">NIF</label>
                        <input id="company_nif" type="text" name="company_nif" class="form-control @error('company_nif') is-invalid @enderror" value="{{ old('company_nif') }}" />
                        @error('company_nif')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="company_email" class="form-label">Email</label>
                        <input id="company_email" type="email" name="company_email" class="form-control @error('company_email') is-invalid @enderror" value="{{ old('company_email') }}" />
                        @error('company_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="company_phone" class="form-label">Teléfono</label>
                        <input id="company_phone" type="tel" name="company_phone" class="form-control @error('company_phone') is-invalid @enderror" value="{{ old('company_phone') }}" />
                        @error('company_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="company_password" class="form-label">Contraseña</label>
                        <input id="company_password" type="password" name="company_password" class="form-control @error('company_password') is-invalid @enderror" />
                        @error('company_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="company_password_confirmation" class="form-label">Repetir contraseña</label>
                        <input id="company_password_confirmation" type="password" name="company_password_confirmation" class="form-control @error('company_password_confirmation') is-invalid @enderror" />
                        @error('company_password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Formulario para Usuario -->
            <div id="user_section" class="row g-3 {{ old('user_type') == 'user' ? '' : 'd-none' }}">
                <div class="col-12 col-md-4 text-center">
                    <div id="avatar_container" class="mx-auto mb-3 rounded-circle d-flex justify-content-center align-items-center bg-info bg-opacity-10" style="width: 120px; height: 120px; overflow: hidden;">
                        <i class="bi bi-person text-info" style="font-size: 48px;"></i>
                    </div>
                    <label for="avatar" class="btn btn-outline-secondary btn-sm w-100">
                        Insertar Avatar
                        <input id="avatar" type="file" name="avatar" accept="image/*" class="d-none" />
                    </label>
                    @error('avatar')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-8">
                    <div class="mb-2">
                        <label for="name" class="form-label">Nombre</label>
                        <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="lastname" class="form-label">Apellidos</label>
                        <input id="lastname" type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}" />
                        @error('lastname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="dni" class="form-label">DNI</label>
                        <input id="dni" type="text" name="dni" class="form-control @error('dni') is-invalid @enderror" value="{{ old('dni') }}" />
                        @error('dni')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input id="phone" type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" />
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">Contraseña</label>
                        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="password_confirmation" class="form-label">Repetir contraseña</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" />
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="/login" class="btn btn-outline-primary btn-lg px-4 py-2 fw-bold shadow-sm" style="transition:background 0.15s, color 0.15s;">
                    <i class="bi bi-box-arrow-in-left me-1"></i>Acceder
                </a>
                <button type="submit" class="btn btn-primary btn-lg px-4 py-2 fw-bold shadow-lg" style="letter-spacing:1px; font-size:1.15rem; transition:transform 0.15s;">
                    <i class="bi bi-person-plus-fill me-1"></i>Guardar
                </button>
            </div>
        </form>
        <div class="auth-links">
            <a href="/login" class="btn btn-outline-primary btn-sm mt-3 px-3 py-1 fw-bold shadow-sm" style="transition:background 0.15s, color 0.15s;">
                <i class="bi bi-box-arrow-in-left me-1"></i>¿Ya tienes cuenta? Accede aquí
            </a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userTypeSelect = document.getElementById('user_type');
            const tallerSection = document.getElementById('taller_section');
            const userSection = document.getElementById('user_section');
            const logoInput = document.getElementById('logo');
            const logoContainer = document.getElementById('logo_container');
            const avatarInput = document.getElementById('avatar');
            const avatarContainer = document.getElementById('avatar_container');
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