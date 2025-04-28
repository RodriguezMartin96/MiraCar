<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Información del Taller
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Actualiza la información de tu taller.
        </p>
    </header>

    <form method="post" action="{{ route('profile.taller.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="taller_name" class="form-label">Nombre del Taller</label>
            <input type="text" class="form-control" id="taller_name" name="taller_name" 
                   value="{{ old('taller_name', $user->taller_name ?? '') }}">
            @error('taller_name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="taller_direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="taller_direccion" name="taller_direccion" 
                   value="{{ old('taller_direccion', $user->taller_direccion ?? '') }}">
            @error('taller_direccion')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="taller_telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="taller_telefono" name="taller_telefono" 
                   value="{{ old('taller_telefono', $user->taller_telefono ?? '') }}">
            @error('taller_telefono')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="taller_descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="taller_descripcion" name="taller_descripcion" 
                      rows="4">{{ old('taller_descripcion', $user->taller_descripcion ?? '') }}</textarea>
            @error('taller_descripcion')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="taller_horario" class="form-label">Horario de Atención</label>
            <textarea class="form-control" id="taller_horario" name="taller_horario" 
                      rows="3">{{ old('taller_horario', $user->taller_horario ?? '') }}</textarea>
            @error('taller_horario')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-4">
            <button type="submit" class="btn btn-primary">Guardar</button>

            @if (session('status') === 'taller-updated')
                <div class="alert alert-success py-2 px-3">Información del taller actualizada.</div>
            @endif
        </div>
    </form>
</section>