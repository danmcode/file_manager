<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($user)
                    <header class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Editar usuario:') }} {{ $user->name }}
                        </h2>
                    </header>
                    <div class="border-b border-gray-300 w-full mt-2 mb-2"></div>

                    <form method="POST" action="#">
                        @csrf

                        <div class="mb-3">
                            <x-input-label for="name" :value="__('Nombre:')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name', $user->name)" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <x-input-label for="email" :value="__('Correo Electrónico:')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                :value="old('email', $user->email)" required autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        {{-- Groups --}}
                        <div class="mb-3">
                            <x-input-label for="group_id" :value="__('Grupos:')" />
                            <x-select name="group_id" :options="$groups ?? []" :selected="$user->role_id ?? null" />
                            <x-input-error class="mt-2" :messages="$errors->get('group_id')" />
                        </div>

                        {{-- Roles --}}
                        <div class="mb-3">
                            <x-input-label for="rol_id" :value="__('Roles:')" />
                            <x-select name="role_id" :options="$roles ?? []" :selected="$user->role_id ?? null" />
                            <x-input-error class="mt-2" :messages="$errors->get('rol_id')" />
                        </div>

                        {{-- quota limit --}}
                        <div class="mb-3">
                            <x-input-label for="quota_limit_mb" :value="__('Cuota de almacenamiento (MB):')" />
                            <x-text-input id="quota_limit_mb" name="quota_limit_mb" type="number"
                                class="mt-1 block w-full" :value="old('quota_limit_mb', $user->quota_limit_mb)" required
                                autocomplete="quota_limit_mb" />
                            <x-input-error class="mt-2" :messages="$errors->get('quota_limit_mb')" />
                        </div>

                        <div class="border-b border-gray-300 w-full mt-2 mb-2"></div>

                        <div class="flex items-center justify-end  gap-4 mt-2">
                            <x-primary-button>{{ __('Actualizar') }}</x-primary-button>
                            <a href={{ route('users') }}>Regresar</a>
                        </div>
                    </form>
                    @else
                    dont exits
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>