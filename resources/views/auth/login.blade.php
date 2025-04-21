<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MiraCar') }} - Acceso</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Bootstrap CSS y Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #6c757d; /* bg-secondary */
            color: white;
            background-image: linear-gradient(135deg, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.1) 100%);
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .login-card {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }
        
        .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding-left: 2.5rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.25);
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        
        .input-group-text {
            background-color: transparent;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            position: absolute;
            z-index: 10;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
        }
        
        .btn-primary {
            background-color: #C4A484; /* Marrón chocolate con leche */
            border-color: #C4A484;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #A67B5B; /* Marrón más oscuro */
            border-color: #A67B5B;
            transform: translateY(-2px);
        }
        
        .alert-danger {
            background-color: rgba(220, 53, 69, 0.2);
            border-color: rgba(220, 53, 69, 0.3);
            color: #fff;
            border-radius: 8px;
        }
        
        .logo-container {
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }
        
        .logo-container:hover {
            transform: scale(1.05);
        }
        
        .input-group {
            position: relative;
        }
        
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
        }
        
        .password-toggle:focus {
            outline: none;
        }
        
        .invalid-feedback {
            font-size: 0.875rem;
            color: #ff8d85;
        }
        
        @media (max-width: 768px) {
            body {
                padding: 1rem 0;
            }
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
                <div class="text-center logo-container">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('galeria/logo.png') }}" alt="Logo MiraCar" class="img-fluid" style="max-height: 100px;">
                    </a>
                </div>
                
                <div class="login-card p-4 p-md-5">
                    <h2 class="text-center mb-4">Acceso a MiraCar</h2>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="mb-3 position-relative">
                            <label for="login" class="form-label">Email o DNI</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-person-fill"></i>
                                </span>
                                <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" 
                                    name="login" value="{{ old('login') }}" required autofocus
                                    placeholder="Introduce tu email o DNI">
                                @error('login')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-4 position-relative">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                    name="password" required autocomplete="current-password"
                                    placeholder="Introduce tu contraseña">
                                <button type="button" class="password-toggle" onclick="togglePassword()">
                                    <i class="bi bi-eye-fill" id="toggleIcon"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Recordarme
                                </label>
                            </div>
                            
                            @if (Route::has('password.request'))
                                <a class="text-white" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Acceder
                            </button>
                        </div>
                        
                        <div class="text-center mt-3">
                            <p>¿No tienes cuenta? <a href="{{ route('register') }}" class="text-white fw-bold">
                                <i class="bi bi-person-plus-fill me-1"></i>Registrarse</a>
                            </p>
                        </div>
                    </form>
                </div>
                
                <div class="text-center mt-4 text-white-50">
                    <small>&copy; {{ date('Y') }} MiraCar. Todos los derechos reservados.</small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función para mostrar/ocultar contraseña
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
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
            const loginCard = document.querySelector('.login-card');
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