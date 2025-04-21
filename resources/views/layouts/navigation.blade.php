<nav class="navbar navbar-expand-lg fixed-top taller-navbar">
    <div class="container-fluid">
        <!-- Logo del taller -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <div class="logo-container">
                <img src="{{ asset('images/logo-taller.png') }}" alt="Logo MiraCar" class="taller-logo">
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
                        Siniestros Vehículos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('recambios.*') ? 'active' : '' }}" href="{{ route('recambios.index') }}">
                        Recambios Stock
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('soporte.*') ? 'active' : '' }}" href="{{ route('soporte.index') }}">
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