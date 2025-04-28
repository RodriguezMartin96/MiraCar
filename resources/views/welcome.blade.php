<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="MiraCar - Conectando talleres y clientes para un servicio automotriz eficiente">

    <title>{{ config('app.name', 'MiraCar') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('galeria/logo.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('galeria/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Bootstrap CSS y Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Vite Assets -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        :root {
            --primary-color: #235390;
            --secondary-color: #4f8cff;
            --light-color: #e3ecff;
        }
        
        body {
            font-family: 'Instrument Sans', sans-serif;
            background: linear-gradient(135deg, #235390 0%, #4f8cff 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .welcome-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .logo-container {
            margin-bottom: 2rem;
            transition: transform 0.3s ease;
        }
        
        .logo-container:hover {
            transform: scale(1.05);
        }
        
        .welcome-card {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .btn-welcome {
            border-radius: 0.75rem;
            padding: 0.8rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
            min-width: 180px;
        }
        
        .btn-welcome:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        
        .btn-primary-custom {
            background-color: white;
            color: var(--primary-color);
            border: none;
        }
        
        .btn-primary-custom:hover {
            background-color: var(--light-color);
            color: var(--primary-color);
        }
        
        .btn-outline-custom {
            background-color: transparent;
            color: white;
            border: 2px solid white;
        }
        
        .btn-outline-custom:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .welcome-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: white;
        }
        
        .welcome-subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 2.5rem;
        }
        
        .welcome-features {
            margin-top: 3rem;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            color: white;
        }
        
        .feature-icon {
            font-size: 1.5rem;
            margin-right: 1rem;
            background-color: rgba(255, 255, 255, 0.2);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .feature-text {
            font-size: 1.1rem;
        }
        
        .footer {
            margin-top: 3rem;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .welcome-card {
                padding: 2rem 1rem;
            }
            
            .welcome-title {
                font-size: 2rem;
            }
            
            .welcome-subtitle {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container welcome-container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 text-center text-lg-start mb-5 mb-lg-0">
                <div class="logo-container">
                    <img src="{{ asset('galeria/logo.png') }}" alt="Logo MiraCar" class="img-fluid" style="max-height: 120px;">
                </div>
                <h1 class="welcome-title">Servicios automotor conectados</h1>
                <p class="welcome-subtitle">La plataforma que conecta talleres y clientes para una experiencia automotriz más eficiente, transparente y satisfactoria.</p>
                
                <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-welcome btn-primary-custom">
                            <i class="bi bi-speedometer2 me-2"></i>Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-welcome btn-primary-custom">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Acceder
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-welcome btn-outline-custom">
                                <i class="bi bi-person-plus me-2"></i>Registrarse
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="welcome-card">
                    <h2 class="h3 text-white mb-4">Beneficios para todos</h2>
                    
                    <div class="welcome-features">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="feature-text">Comunicación directa entre talleres y clientes</div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-car-front"></i>
                            </div>
                            <div class="feature-text">Seguimiento completo del historial de vehículos</div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-tools"></i>
                            </div>
                            <div class="feature-text">Gestión transparente de reparaciones</div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <div class="feature-text">Programación de citas y notificaciones</div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <div class="feature-text">Documentación digital accesible</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer text-center mt-5">
            <p>&copy; {{ date('Y') }} MiraCar. Todos los derechos reservados.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animación de entrada
            const elements = document.querySelectorAll('.welcome-title, .welcome-subtitle, .btn-welcome, .welcome-card, .feature-item');
            
            elements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, 100 + (index * 100));
            });
        });
    </script>
</body>
</html>