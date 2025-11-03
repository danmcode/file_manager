<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($role)
                    <header class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Editar rol:') }} {{ $role->name }}
                        </h2>
                    </header>
                    <div class="border-b border-gray-300 w-full mt-2 mb-2"></div>

                    <form method="POST" action="{{ route('roles.update', $role->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <x-input-label for="name" :value="__('Nombre:')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name', $role->name)" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <x-input-label for="description" :value="__('Descripción del rol:')" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"
                                :value="old('description', $role->description)" />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>


                        <div class="border-b border-gray-300 w-full mt-2 mb-2"></div>

                        <div class="flex items-center justify-end  gap-4 mt-2">
                            <x-primary-button>{{ __('Actualizar') }}</x-primary-button>
                            <a href={{ route('roles') }}>Regresar</a>
                        </div>
                    </form>
                    @else
                    <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50"
                        role="alert">
                        <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">Rol no encontrado!</span>
                            El rol que intentas actualizar no existe
                        </div>
                    </div>
                    <div class="flex items-center justify-end  gap-4 mt-2">
                        <a href={{ route('roles') }}>Regresar</a>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>