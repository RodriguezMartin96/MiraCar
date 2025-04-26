<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
        }
        
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(35, 83, 144, 0.15);
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
        }
        
        .password-toggle:focus {
            outline: none;
        }
        
        .logo-container img {
            max-height: 80px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-lg">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold text-primary">Acceso a MiraCar</h2>
                            <div class="logo-container my-3">
                                <a href="{{ url('/') }}">
                                    <img src="{{ asset('galeria/logo.png') }}" alt="Logo MiraCar" class="img-fluid">
                                </a>
                            </div>
                        </div>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger rounded-3 mb-4">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="login" class="form-label fw-semibold">Email o DNI</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-person-fill text-primary"></i>
                                    </span>
                                    <input id="login" type="text" class="form-control py-2 @error('login') is-invalid @enderror" 
                                        name="login" value="{{ old('login') }}" required autofocus
                                        placeholder="Introduce tu email o DNI">
                                    @error('login')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-lock-fill text-primary"></i>
                                    </span>
                                    <input id="password" type="password" class="form-control py-2 @error('password') is-invalid @enderror" 
                                        name="password" required autocomplete="current-password"
                                        placeholder="Introduce tu contraseña">
                                    <button type="button" class="password-toggle" onclick="togglePassword('password', 'toggleIcon')">
                                        <i class="bi bi-eye-fill" id="toggleIcon"></i>
                                    </button>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        Recordarme
                                    </label>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2 mb-4">
                                <button type="submit" class="btn btn-primary btn-lg py-2 fw-bold">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Acceder
                                </button>
                            </div>
                            
                            <div class="text-center">
                                <p class="mb-0">¿No tienes cuenta?</p>
                                <a href="{{ route('register') }}" class="btn btn-outline-primary mt-2">
                                    <i class="bi bi-person-plus-fill me-1"></i>Registrarse
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="text-center mt-4 text-muted">
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
        });
    </script>
</body>
</html>