<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <header class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Mis archivos') }}
                        </h2>

                        <x-primary-button :href="route('dashboard')">{{ __('Subir archivos') }}</x-primary-button>
                    </header>
                    <div class="border-b border-gray-300 w-full mt-2 mb-2"></div>

                    @if ($files->isEmpty())
                    <div class="text-center py-16 text-gray-500">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-lg font-medium">Aún no tienes archivos subidos</p>
                        <p class="text-sm text-gray-400">Cuando subas tus archivos, aparecerán aquí</p>
                    </div>
                    @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($files as $file)
                        <div
                            class="flex flex-col items-center justify-between bg-gray-50 border border-gray-200 rounded-2xl shadow-sm p-4 hover:shadow-md transition duration-200">
                            <div class="w-full text-center">
                                <p class="font-semibold text-gray-800 text-sm truncate">
                                    {{ $file->file_name }}
                                </p>
                            </div>

                            <div class="mt-3 flex justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="22" width="19" viewBox="0 0 384 512">
                                    <!--!Font Awesome Pro v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2025 Fonticons, Inc.-->
                                    <path
                                        d="M176 48L64 48c-8.8 0-16 7.2-16 16l0 384c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16l0-240-88 0c-39.8 0-72-32.2-72-72l0-88zM316.1 160L224 67.9 224 136c0 13.3 10.7 24 24 24l68.1 0zM0 64C0 28.7 28.7 0 64 0L197.5 0c17 0 33.3 6.7 45.3 18.7L365.3 141.3c12 12 18.7 28.3 18.7 45.3L384 448c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64z" />
                                </svg>
                            </div>

                            <div class="mt-4">
                                <a href="{{ asset($file->storage_path) }}" download
                                    class="inline-flex items-center gap-1 bg-blue-600 text-white text-xs px-3 py-1.5 rounded-lg hover:bg-blue-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4v12m0 0l-4-4m4 4l4-4m-8 8h8" />
                                    </svg>
                                    Descargar
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>