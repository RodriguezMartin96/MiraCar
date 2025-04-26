<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Logo del Taller') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Actualiza el logo de tu taller que se mostrará en la aplicación.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.logo.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="current_logo" :value="__('Logo actual')" />
            
            <div class="mt-2 mb-4">
                @if(Auth::user()->logo)
                    <img src="{{ asset('storage/' . Auth::user()->logo) }}" alt="Logo actual" class="w-32 h-32 object-contain border rounded p-1" 
                         onerror="this.onerror=null; this.src='{{ asset('galeria/logo.png') }}'; this.nextElementSibling.textContent='No se pudo cargar el logo actual';">
                    <p class="text-sm text-gray-500 mt-1">Logo actual ({{ Auth::user()->logo }})</p>
                @else
                    <div class="w-32 h-32 bg-gray-100 flex items-center justify-center border rounded">
                        <span class="text-gray-400">Sin logo</span>
                    </div>
                @endif
            </div>

            <x-input-label for="logo" :value="__('Nuevo logo')" />
            <input id="logo" name="logo" type="file" class="mt-1 block w-full" accept="image/*" required />
            <p class="text-sm text-gray-500 mt-1">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB.</p>
            <x-input-error class="mt-2" :messages="$errors->get('logo')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'logo-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Logo actualizado.') }}</p>
            @endif
        </div>
    </form>
</section>
