<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Avatar de Usuario') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Actualiza tu avatar de perfil. Este se mostrará en la barra de navegación y en tu perfil.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.avatar') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <div class="flex items-center mb-4">
                @if(Auth::user()->avatar)
                    <div class="mr-4">
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar actual" 
                             class="rounded-lg shadow-md" style="width: 100px; height: 100px; object-fit: cover;"
                             onerror="this.onerror=null; this.src='{{ asset('galeria/logo.png') }}'; console.log('Error cargando avatar actual');">
                        <p class="text-sm text-gray-500 mt-1">Avatar actual</p>
                    </div>
                @else
                    <div class="mr-4">
                        <div class="rounded-lg shadow-md bg-gray-100 flex items-center justify-center" style="width: 100px; height: 100px;">
                            <span class="text-gray-400">Sin avatar</span>
                        </div>
                    </div>
                @endif
                <div class="flex-1">
                    <x-input-label for="avatar" :value="__('Nuevo Avatar')" />
                    <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full" accept="image/*" required />
                    <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        {{ __('Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'avatar-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>