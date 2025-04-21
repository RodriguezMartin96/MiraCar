<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-secondary text-white pt-5" style="font-family: 'Instrument Sans', sans-serif;">
        <div class="d-flex flex-column align-items-center min-vh-100">
            @if (Route::has('login'))
                <div class="d-flex justify-content-center align-items-center w-100 mb-5">
                    <img src="{{ asset('galeria/logo.png') }}" alt="Logo" class="img-fluid" style="width: 40%; max-height: 80%; object-fit: contain;">
                </div>
                
                    <div class="d-flex justify-content-center gap-4 mt-1 w-100">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-outline-light btn-lg px-4 py-3 fs-5" style="width: 180px;">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4 py-3 fs-5" style="width: 180px;">
                                Acceder
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4 py-3 fs-5" style="width: 180px;">
                                    Registrarse
                                </a>
                            @endif
                        @endauth
                    </div>
            @endif
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>