<section>
    <header>
        <h2 class="card-title">
            Información de Perfil
        </h2>
        <p class="text-muted small">
            Actualiza la información de tu cuenta y tu dirección de email.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" 
                   value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" 
                   value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-muted">
                        Tu dirección de email no está verificada.

                        <button form="send-verification" class="btn btn-link btn-sm p-0 text-decoration-underline">
                            Haz click aquí para reenviar el email de verificación.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-success">
                            Se ha enviado un nuevo enlace de verificación a tu dirección de email.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-4">
            <button type="submit" class="btn btn-primary">Guardar</button>

            @if (session('status') === 'profile-updated')
                <div class="alert alert-success py-2 px-3 mb-0">¡Guardado correctamente!</div>
            @endif
        </div>
    </form>
</section>