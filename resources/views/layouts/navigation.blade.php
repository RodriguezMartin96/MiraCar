<style>
    .taller-navbar {
        background: linear-gradient(90deg, #4f8cff 0%, #235390 100%);
        box-shadow: 0 2px 12px rgba(79,140,255,0.08);
        padding: 0.7rem 2rem;
        border-bottom-left-radius: 18px;
        border-bottom-right-radius: 18px;
        margin-bottom: 32px; /* Añadido para separar la barra del contenido */
    }
    .taller-logo {
        height: 40px;
        width: auto;
        max-width: 100px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(79,140,255,0.10);
        background: #fff;
        padding: 2px;
        object-fit: contain;
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
    /* Espacio superior para el contenido principal */
    main, .main-content, .container, .dashboard-content {
        margin-top: 80px !important;
    }
</style>

<nav class="navbar navbar-expand-lg fixed-top taller-navbar">
    <div class="container-fluid">
        <!-- Logo del taller -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <div class="logo-container">
                @if(Auth::check() && Auth::user()->isTaller() && Auth::user()->logo)
                    <img src="{{ asset('storage/' . Auth::user()->logo) }}" alt="{{ Auth::user()->name }} Logo" class="taller-logo" 
                         onerror="this.onerror=null; this.src='{{ asset('galeria/logo.png') }}'; console.log('Error cargando logo personalizado');">
                @else
                    <img src="{{ asset('galeria/logo.png') }}" alt="MiraCar Logo" class="taller-logo">
                @endif
            </div>
        </a>
        
        <!-- Botón de hamburguesa para móviles -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" 
                aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list"></i>
        </button>
        
        <!-- Menú principal -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarMain">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        Inicio
                    </a>
                </li>
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
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('soporte.*') ? 'active' : '' }}" href="{{ route('soporte.create') }}">
                        Soporte
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Menú de usuario y cierre de sesión -->
        <div class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle user-dropdown-toggle" href="#" id="userDropdown" role="button" 
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-gear-fill me-1"></i>
                    {{ Auth::user()->name ?? 'Taller' }}
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
        </div>
    </div>
</nav>

<!-- Código de depuración temporal para verificar el logo -->
@if(Auth::check())
<div style="position: fixed; bottom: 10px; right: 10px; background: white; padding: 10px; border-radius: 5px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); z-index: 9999; max-width: 300px; font-size: 12px; display: none;" id="logoDebug">
    <h5>Información del Logo</h5>
    <p>Usuario: {{ Auth::user()->name }}</p>
    <p>Rol: {{ Auth::user()->role }}</p>
    <p>Es taller: {{ Auth::user()->isTaller() ? 'Sí' : 'No' }}</p>
    <p>Ruta del logo: {{ Auth::user()->logo ?? 'No hay logo' }}</p>
    <p>URL completa: {{ Auth::user()->logo ? asset('storage/' . Auth::user()->logo) : 'No hay logo' }}</p>
    <button onclick="document.getElementById('logoDebug').style.display='none'" style="background: #4f8cff; color: white; border: none; padding: 5px 10px; border-radius: 3px;">Cerrar</button>
</div>

<script>
    // Mostrar información de depuración al presionar Ctrl+Shift+L
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.shiftKey && e.key === 'L') {
            const debugElement = document.getElementById('logoDebug');
            debugElement.style.display = debugElement.style.display === 'none' ? 'block' : 'none';
        }
    });
    
    // Verificar si la imagen del logo existe
    document.addEventListener('DOMContentLoaded', function() {
        const logoImg = document.querySelector('.taller-logo');
        if (logoImg) {
            console.log('Logo src:', logoImg.src);
            
            // Crear una nueva imagen para probar si la URL es válida
            const testImg = new Image();
            testImg.onload = function() {
                console.log('Logo cargado correctamente');
            };
            testImg.onerror = function() {
                console.error('Error al cargar el logo desde:', logoImg.src);
            };
            testImg.src = logoImg.src;
        }
    });
</script>
@endif
