<section>
    <header>
        <h2 class="card-title text-danger">
            Eliminar Cuenta
        </h2>
        <p class="text-muted small">
            Una vez que elimines tu cuenta, todos tus recursos y datos serán eliminados permanentemente. 
            Antes de eliminar tu cuenta, por favor descarga cualquier dato o información que desees conservar.
        </p>
    </header>

    <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
        <i class="bi bi-trash me-1"></i>Eliminar Cuenta
    </button>

    <!-- Modal de confirmación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="confirmDeleteModalLabel">¿Estás seguro de que quieres eliminar tu cuenta?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Una vez que elimines tu cuenta, todos tus recursos y datos serán eliminados permanentemente. Por favor ingresa tu contraseña para confirmar que deseas eliminar permanentemente tu cuenta.</p>
                    <form method="post" action="{{ route('profile.destroy') }}" id="deleteUserForm">
                        @csrf
                        @method('delete')
                        <div class="mb-3">
                            <label for="delete_password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="delete_password" name="password" placeholder="Ingresa tu contraseña" required>
                            @error('password', 'userDeletion')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="document.getElementById('deleteUserForm').submit();">
                        Eliminar Cuenta
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>