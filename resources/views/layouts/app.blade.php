<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MiraCar') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Global CSS -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    
    <!-- Page Specific CSS -->
    @yield('styles')
    
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #f8f9fa;
        }
        
        .user-navbar {
            background: linear-gradient(90deg, #4f8cff 0%, #235390 100%);
            box-shadow: 0 2px 12px rgba(79,140,255,0.08);
            padding: 0.7rem 2rem;
            border-bottom-left-radius: 18px;
            border-bottom-right-radius: 18px;
            margin-bottom: 32px;
        }
        
        main {
            margin-top: 80px; /* Espacio para la barra de navegación fija */
        }
    </style>
</head>
<body>
    <div id="app">
        @if(Auth::check() && Auth::user()->isUser())
            <!-- Navbar para usuarios normales -->
            <nav class="navbar navbar-expand-lg fixed-top user-navbar">
                <div class="container-fluid">
                    <a class="navbar-brand text-white" href="{{ route('user.dashboard') }}">
                        <img src="{{ asset('galeria/logo.png') }}" alt="MiraCar Logo" height="40">
                    </a>
                    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUser" 
                            aria-controls="navbarUser" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="bi bi-list text-white"></i>
                    </button>
                    
                    <div class="collapse navbar-collapse justify-content-end" id="navbarUser">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" 
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle me-1"></i>
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                            <i class="bi bi-person-fill me-2"></i>Perfil
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                            @csrf
                                            <a class="dropdown-item" href="#" 
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        @elseif(Auth::check() && Auth::user()->isTaller())
            <!-- Incluir la navegación para talleres -->
            @include('layouts.navigation')
        @endif

        <!-- Contenido principal -->
        <main>
            @yield('content')
        </main>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Page Specific JS -->
    @yield('scripts')
</body>
</html>