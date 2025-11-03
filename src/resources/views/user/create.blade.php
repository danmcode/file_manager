<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <header class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Crear usuario:') }}
                        </h2>
                    </header>
                    <div class="border-b border-gray-300 w-full mt-2 mb-2"></div>

                    <form method="POST" action={{ route('users.store') }}>
                        @csrf

                        <div class="mb-3">
                            <x-input-label for="name" :value="__('Nombre:')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <x-input-label for="email" :value="__('Correo Electrónico:')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                :value="old('email')" autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        {{-- Groups --}}
                        <div class="mb-3">
                            <x-input-label for="group_id" :value="__('Grupos:')" />
                            <x-select name="group_id" :options="$groups ?? []" :selected="null" />
                            <x-input-error class="mt-1" :messages="$errors->get('group_id')" />
                        </div>

                        {{-- Roles --}}
                        <div class="mb-3">
                            <x-input-label for="role_id" :value="__('Roles:')" />
                            <x-select name="role_id" :options="$roles ?? []" :selected="null" />
                            <x-input-error class="mt-1" :messages="$errors->get('role_id')" />
                        </div>

                        {{-- quota limit --}}
                        <div class="mb-3">
                            <x-input-label for="quota_limit_mb" :value="__('Cuota de almacenamiento (MB):')" />
                            <x-text-input id="quota_limit_mb" name="quota_limit_mb" type="number"
                                class="mt-1 block w-full" :value="old('quota_limit_mb')"
                                autocomplete="quota_limit_mb" />
                            <x-input-error class="mt-2" :messages="$errors->get('quota_limit_mb')" />
                        </div>

                        <span class="text-gray-500 text-xs uppercase font-semibold">
                            Cuenta de usuario
                        </span>
                        <div class="border-b border-gray-300 w-full mt-2 mb-2"></div>

                        <div class="mb-3">
                            <x-input-label for="password" :value="__('Contraseña:')" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>

                        <div class="mb-3">
                            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña:')" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>
                </div>

                <div class="border-b border-gray-300 w-full mt-2 mb-2"></div>

                <div class="flex items-center justify-end  gap-4 m-4">
                    <x-primary-button>{{ __('Guardar') }}</x-primary-button>
                    <a href={{ route('users') }}>Regresar</a>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>