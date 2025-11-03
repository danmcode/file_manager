<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <header class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Crear Rol') }}
                        </h2>
                    </header>
                    <div class="border-b border-gray-300 w-full mt-2 mb-2"></div>

                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf

                        <div class="mb-3">
                            <x-input-label for="name" :value="__('Nombre:')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <x-input-label for="description" :value="__('Descripción del grupo:')" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"
                                :value="old('description')" />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>


                        <div class="border-b border-gray-300 w-full mt-2 mb-2"></div>

                        <div class="flex items-center justify-end  gap-4 mt-2">
                            <x-primary-button>{{ __('Guardar') }}</x-primary-button>
                            <a href={{ route('roles') }}>Regresar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>