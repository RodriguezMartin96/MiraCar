<style>
    .taller-navbar {
        background: linear-gradient(90deg, #4f8cff 0%, #235390 100%);
        box-shadow: 0 2px 12px rgba(79,140,255,0.08);
        padding: 0.7rem 2rem;
        border-bottom-left-radius: 18px;
        border-bottom-right-radius: 18px;
        margin-bottom: 32px;
    }
    
    .taller-logo {
        height: 40px;
        width: 40px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(79,140,255,0.10);
        background: #fff;
        padding: 2px;
        object-fit: cover;
    }
    
    .logo-container {
        display: inline-block;
        background: white;
        border-radius: 8px;
        padding: 2px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    
    .navbar-nav .nav-link {
        color: #fff !important;
        font-weight: 500;
        font-size: 1.08rem;
        padding: 10px 22px;
        margin: 0 4px;
        border-radius: 8px;
        transition: background 0.18s, color 0.18s, box-shadow 0.18s;
        position: relative;
    }
    
    .navbar-nav .nav-link.active, .navbar-nav .nav-link:hover {
        background: #fff;
        color: #235390 !important;
        box-shadow: 0 2px 10px rgba(79,140,255,0.10);
        text-shadow: 0 1px 2px #e3ecff;
    }
    
    .navbar-toggler {
        border: none;
        color: #fff;
        font-size: 1.6rem;
        background: rgba(255,255,255,0.10);
        border-radius: 8px;
        transition: background 0.18s;
    }
    
    .navbar-toggler:focus {
        outline: none;
        background: #e3ecff;
        color: #235390;
    }
    
    .user-dropdown-toggle {
        color: #fff !important;
        font-weight: 500;
        border-radius: 8px;
        padding: 10px 18px;
        transition: background 0.18s, color 0.18s;
        display: flex;
        align-items: center;
    }
    
    .user-dropdown-toggle:hover, .user-dropdown-toggle:focus {
        background: #fff;
        color: #235390 !important;
    }
    
    .dropdown-menu {
        border-radius: 10px;
        box-shadow: 0 4px 18px rgba(79,140,255,0.13);
        min-width: 180px;
    }
    
    .dropdown-item {
        font-weight: 500;
        color: #235390;
        border-radius: 6px;
        transition: background 0.15s, color 0.15s;
    }
    
    .dropdown-item:hover, .dropdown-item:focus {
        background: #e3ecff;
        color: #4f8cff;
    }
    
    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 8px;
        border: 2px solid white;
    }
    
    @media (max-width: 991px) {
        .taller-navbar {
            padding: 0.7rem 0.7rem;
        }
        .navbar-nav .nav-link {
            padding: 10px 12px;
            font-size: 1rem;
        }
        .user-dropdown-toggle {
            padding: 10px 12px;
        }
    }
    
    main, .main-content, .container, .dashboard-content {
        margin-top: 80px !important;
    }
</style>

<nav class="navbar navbar-expand-lg fixed-top taller-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <div class="logo-container">
                @if(Auth::check())
                    @if(Auth::user()->role === 'taller' && Auth::user()->logo)
                        <img src="{{ asset('storage/' . Auth::user()->logo) }}" alt="{{ Auth::user()->name }} Logo" class="taller-logo" 
                             onerror="this.onerror=null; this.src='{{ asset('galeria/logo.png') }}'; console.log('Error cargando logo personalizado');">
                    @elseif(Auth::user()->role === 'user' && Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="taller-logo" 
                             onerror="this.onerror=null; this.src='{{ asset('galeria/logo.png') }}'; console.log('Error cargando avatar');">
                    @else
                        <img src="{{ asset('galeria/logo.png') }}" alt="MiraCar Logo" class="taller-logo">
                    @endif
                @else
                    <img src="{{ asset('galeria/logo.png') }}" alt="MiraCar Logo" class="taller-logo">
                @endif
            </div>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" 
                aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list"></i>
        </button>
        
        <div class="collapse navbar-collapse justify-content-center" id="navbarMain">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        Inicio
                    </a>
                </li>
                @if(Auth::check() && Auth::user()->role === 'taller')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}" href="{{ route('clientes.index') }}">
                        Cliente
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('vehiculos.*') ? 'active' : '' }}" href="{{ route('vehiculos.index') }}">
                        Vehículo
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('siniestros.*') ? 'active' : '' }}" href="{{ route('siniestros.index') }}">
                        Siniestro
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('recambios.*') ? 'active' : '' }}" href="{{ route('recambios.index') }}">
                        Recambio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('documentos.*') ? 'active' : '' }}" href="{{ route('documentos.index') }}">
                        Documentación
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('soporte.*') ? 'active' : '' }}" href="{{ route('soporte.create') }}">
                        Soporte
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle user-dropdown-toggle" href="#" id="userDropdown" role="button" 
                   data-bs-toggle="dropdown" aria-expanded="false">
                    @if(Auth::check())
                        @if(Auth::user()->role === 'user' && Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="user-avatar" 
                                 onerror="this.onerror=null; this.src='{{ asset('galeria/logo.png') }}'; console.log('Error cargando avatar');">
                        @elseif(Auth::user()->role === 'taller' && Auth::user()->logo)
                            <img src="{{ asset('storage/' . Auth::user()->logo) }}" alt="{{ Auth::user()->name }}" class="user-avatar" 
                                 onerror="this.onerror=null; this.src='{{ asset('galeria/logo.png') }}'; console.log('Error cargando logo');">
                        @else
                            <i class="bi bi-person-circle me-1"></i>
                        @endif
                        {{ Auth::user()->name }}
                    @else
                        <i class="bi bi-person-circle me-1"></i>
                        Usuario
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('user.profile') }}">
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
        </div>
    </div>
</nav>