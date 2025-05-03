<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('galeria/logo.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('galeria/logo.png') }}">

    <title>{{ config('app.name', 'MiraCar') }} - Acceso</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Bootstrap CSS y Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #235390;
            --secondary-color: #4f8cff;
            --light-color: #e3ecff;
            --bg-gradient: linear-gradient(135deg, #f8faff 0%, #f0f5ff 100%);
        }
        
        body {
            min-height: 100vh;
            background: var(--bg-gradient);
            font-family: 'Instrument Sans', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem 0;
        }
        
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(35, 83, 144, 0.15);
            width: 100%;
        }
        
        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(79, 140, 255, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .text-primary {
            color: var(--primary-color) !important;
        }
        
        .password-toggle {
            background: none;
            border: none;
            color: var(--primary-color);
            cursor: pointer;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .password-toggle:focus {
            outline: none;
        }
        
        .logo-container img {
            max-height: 70px;
            transition: max-height 0.3s ease;
        }
        
        /* Estilos responsivos */
        .card-body {
            padding: 1.5rem;
        }
        
        .input-group-text {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }
        
        .form-control, .btn {
            font-size: 1rem;
            padding: 0.6rem 0.75rem;
        }
        
        .btn-lg {
            padding: 0.6rem 1rem;
        }
        
        /* Media queries para dispositivos móviles */
        @media (max-width: 576px) {
            body {
                padding: 0.5rem;
                align-items: flex-start;
            }
            
            .container {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }
            
            .card-body {
                padding: 1.25rem 1rem;
            }
            
            .logo-container img {
                max-height: 60px;
            }
            
            h2 {
                font-size: 1.5rem;
            }
            
            .form-control, .btn {
                font-size: 0.95rem;
                padding: 0.5rem 0.75rem;
            }
            
            .btn-lg {
                padding: 0.5rem 1rem;
            }
            
            .input-group-text {
                padding-left: 0.6rem;
                padding-right: 0.6rem;
            }
            
            .mb-4 {
                margin-bottom: 1rem !important;
            }
        }
        
        /* Media queries para tablets */
        @media (min-width: 577px) and (max-width: 991px) {
            .card-body {
                padding: 1.75rem 1.5rem;
            }
            
            .logo-container img {
                max-height: 65px;
            }
        }
        
        /* Mejoras para pantallas táctiles */
        @media (hover: none) and (pointer: coarse) {
            .form-check-input {
                width: 1.2em;
                height: 1.2em;
                margin-top: 0.15em;
            }
            
            .form-check-label {
                padding-left: 0.25rem;
            }
            
            .password-toggle {
                padding: 0.6rem;
            }
            
            .password-toggle i {
                font-size: 1.2rem;
            }
            
            .btn {
                padding-top: 0.7rem;
                padding-bottom: 0.7rem;
            }
        }
        
        /* Animaciones */
        .card {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }
        
        .btn {
            transition: all 0.2s ease;
        }
        
        .btn:active {
            transform: scale(0.97);
        }
        
        /* Mejoras de accesibilidad */
        .form-label {
            margin-bottom: 0.4rem;
            font-weight: 600;
        }
        
        .alert {
            border-radius: 0.5rem;
        }
        
        .alert ul {
            margin-bottom: 0;
        }
        
        /* Orientación landscape en móviles */
        @media (max-height: 500px) and (orientation: landscape) {
            body {
                align-items: flex-start;
                padding: 0.5rem;
            }
            
            .logo-container {
                margin-top: 0 !important;
                margin-bottom: 0.5rem !important;
            }
            
            .logo-container img {
                max-height: 50px;
            }
            
            h2 {
                font-size: 1.4rem;
                margin-bottom: 0.5rem !important;
            }
            
            .mb-3, .mb-4 {
                margin-bottom: 0.5rem !important;
            }
            
            .card-body {
                padding: 1rem;
            }
        }
        
        /* Estilo para el mensaje de error personalizado */
        .alert-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border-color: rgba(220, 53, 69, 0.2);
            font-weight: 500;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="text-center mb-3 mb-md-4">
                            <h2 class="fw-bold text-primary">Acceso a MiraCar</h2>
                            <div class="logo-container my-2 my-md-3">
                                <a href="{{ url('/') }}">
                                    <img src="{{ asset('galeria/logo.png') }}" alt="Logo MiraCar" class="img-fluid">
                                </a>
                            </div>
                        </div>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger rounded-3 mb-3 mb-md-4 text-center">
                                @if($errors->has('login'))
                                    {{ $errors->first('login') }}
                                @else
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="login" class="form-label">Email o DNI</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-person-fill text-primary"></i>
                                    </span>
                                    <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" 
                                        name="login" value="{{ old('login') }}" required autofocus
                                        placeholder="Introduce tu email o DNI">
                                </div>
                            </div>
                            
                            <div class="mb-3 mb-md-4">
                                <label for="password" class="form-label">Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-lock-fill text-primary"></i>
                                    </span>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                        name="password" required autocomplete="current-password"
                                        placeholder="Introduce tu contraseña">
                                    <button type="button" class="password-toggle" onclick="togglePassword('password', 'toggleIcon')">
                                        <i class="bi bi-eye-fill" id="toggleIcon"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-3 mb-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        Recordarme
                                    </label>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2 mb-3 mb-md-4">
                                <button type="submit" class="btn btn-primary btn-lg fw-bold">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Acceder
                                </button>
                            </div>
                            
                            <div class="text-center">
                                <p class="mb-2">¿No tienes cuenta?</p>
                                <a href="{{ route('registrarse') }}" class="btn btn-outline-primary">
                                    <i class="bi bi-person-plus-fill me-1"></i>Registrarse
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="text-center mt-3 mt-md-4 text-muted">
                    <small>&copy; {{ date('Y') }} MiraCar. Todos los derechos reservados.</small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función para mostrar/ocultar contraseña
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(iconId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye-fill');
                toggleIcon.classList.add('bi-eye-slash-fill');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash-fill');
                toggleIcon.classList.add('bi-eye-fill');
            }
        }
        
        // Animación de entrada
        document.addEventListener('DOMContentLoaded', function() {
            const loginCard = document.querySelector('.card');
            loginCard.style.opacity = '0';
            loginCard.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                loginCard.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                loginCard.style.opacity = '1';
                loginCard.style.transform = 'translateY(0)';
            }, 200);
            
            // Ajustar altura en dispositivos móviles en orientación landscape
            function adjustForLandscape() {
                if (window.innerHeight < 500 && window.innerWidth > window.innerHeight) {
                    document.body.classList.add('landscape-mode');
                } else {
                    document.body.classList.remove('landscape-mode');
                }
            }
            
            // Ejecutar al cargar y al cambiar orientación
            adjustForLandscape();
            window.addEventListener('resize', adjustForLandscape);
            window.addEventListener('orientationchange', adjustForLandscape);
        });
    </script>
</body>
</html>