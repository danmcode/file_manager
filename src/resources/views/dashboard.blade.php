<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Mi almacenamiento</h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div
                            class="flex items-center p-5 bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-blue-100 text-blue-600 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="18.75" viewBox="0 0 448 512">
                                    <!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path fill="#2563eb"
                                        d="M64 80c-8.8 0-16 7.2-16 16l0 162c5.1-1.3 10.5-2 16-2l320 0c5.5 0 10.9 .7 16 2l0-162c0-8.8-7.2-16-16-16L64 80zM48 320l0 96c0 8.8 7.2 16 16 16l320 0c8.8 0 16-7.2 16-16l0-96c0-8.8-7.2-16-16-16L64 304c-8.8 0-16 7.2-16 16zM0 320L0 96C0 60.7 28.7 32 64 32l320 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64l0-96zm216 48a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm120-24a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Cuota total</p>
                                <p class="text-lg font-semibold text-gray-800">{{ auth()->user()->quota_limit_mb }} MB
                                </p>
                            </div>
                        </div>

                        <div
                            class="flex items-center p-5 bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-orange-100 text-orange-600 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="17.5" viewBox="0 0 384 512">
                                    <!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path fill="#ea580c"
                                        d="M176 48L64 48c-8.8 0-16 7.2-16 16l0 384c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16l0-240-88 0c-39.8 0-72-32.2-72-72l0-88zM316.1 160L224 67.9 224 136c0 13.3 10.7 24 24 24l68.1 0zM0 64C0 28.7 28.7 0 64 0L197.5 0c17 0 33.3 6.7 45.3 18.7L365.3 141.3c12 12 18.7 28.3 18.7 45.3L384 448c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Usado</p>
                                <p class="text-lg font-semibold text-gray-800">{{
                                    number_format(auth()->user()->used_space_mb, 2) }} MB
                                </p>
                            </div>
                        </div>

                        @php
                        $user = auth()->user();
                        $usedPercent = $user->quota_limit_mb > 0
                        ? round(($user->used_space_mb / $user->quota_limit_mb) * 100, 1)
                        : 0;
                        @endphp

                        <div
                            class="flex items-center p-5 bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                            <div
                                class="flex items-center justify-center w-12 h-12 bg-green-100 text-green-600 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512">
                                    <!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path fill="#16a34a"
                                        d="M64 400l384 0c8.8 0 16-7.2 16-16l0-240c0-8.8-7.2-16-16-16l-149.3 0c-17.3 0-34.2-5.6-48-16L212.3 83.2c-2.8-2.1-6.1-3.2-9.6-3.2L64 80c-8.8 0-16 7.2-16 16l0 288c0 8.8 7.2 16 16 16zm384 48L64 448c-35.3 0-64-28.7-64-64L0 96C0 60.7 28.7 32 64 32l138.7 0c13.8 0 27.3 4.5 38.4 12.8l38.4 28.8c5.5 4.2 12.3 6.4 19.2 6.4L448 80c35.3 0 64 28.7 64 64l0 240c0 35.3-28.7 64-64 64z" />
                                </svg>
                            </div>
                            <div class="ml-4 w-full">
                                <p class="text-sm text-gray-500">Ocupado</p>
                                <div class="flex items-center justify-between">
                                    <p class="text-lg font-semibold text-gray-800">{{ $usedPercent }}%</p>
                                    <div class="w-24 h-2 bg-gray-200 rounded-full overflow-hidden ml-3">
                                        <div class="h-2 bg-green-500" style="width: {{ min($usedPercent, 100) }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 text-gray-900">

                    <form id="upload-form" action="{{ route('files.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="max-w-6xl mx-auto p-6">
                            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Subir archivos</h2>

                            @if ($errors->any())
                            <div id="alert-errors" class="flex items-start p-4 mb-4 text-red-800 rounded-lg bg-red-50 "
                                role="alert">
                                <svg class="shrink-0 w-5 h-5 mt-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>

                                <div class="ms-3 text-sm font-medium flex-1">
                                    <ul class="list-disc list-inside space-y-1">
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>

                                <button type="button"
                                    class="ms-4 -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                                    data-dismiss-target="#alert-errors" aria-label="Cerrar">
                                    <span class="sr-only">Cerrar</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>
                            @endif

                            @if (session('success'))
                            <div id="alert-success"
                                class="flex items-start p-4 mb-4 text-green-800 rounded-lg bg-green-50" role="alert">
                                <svg class="shrink-0 w-5 h-5 mt-1" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M16.707 5.293a1 1 0 0 0-1.414 0L9 11.586 6.707 9.293a1 1 0 1 0-1.414 1.414l3 3a1 1 0 0 0 1.414 0l7-7a1 1 0 0 0 0-1.414Z" />
                                </svg>
                                <div class="ms-3 text-sm font-medium flex-1">
                                    {{ session('success') }}
                                </div>
                                <button type="button"
                                    class="ms-4 -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                                    data-dismiss-target="#alert-success" aria-label="Cerrar">
                                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div id="dropzone"
                                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 border-gray-300 transition">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center">
                                            <svg class="w-10 h-10 mb-3 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5A5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-600">
                                                <span class="font-semibold">Haz clic para subir</span>
                                                o arrastra tus archivos
                                            </p>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF, PDF, DOC, XSLX (máx. 10MB)
                                            </p>
                                        </div>
                                        <input id="file-input" type="file" multiple class="hidden" name="files[]" />
                                    </div>
                                </div>

                                <div id="file-list" class="hidden md:block">
                                    <div class="flex justify-between items-center mb-3">
                                        <h3 class="text-lg font-medium text-gray-700">Archivos seleccionados</h3>
                                        <button id="delete-selected"
                                            class="hidden bg-red-600 text-white text-sm px-3 py-1.5 rounded hover:bg-red-700 transition">
                                            Eliminar seleccionados
                                        </button>
                                    </div>
                                    <ul id="file-names"
                                        class="divide-y divide-gray-200 bg-gray-50 rounded-lg p-3 text-gray-700 text-sm">
                                        <li class="text-gray-400 italic text-center py-4" id="no-files">Aún no hay
                                            archivos
                                            seleccionados</li>
                                    </ul>
                                </div>
                            </div>

                            <div id="file-list-mobile" class="block md:hidden mt-6">
                                <div class="flex justify-between items-center mb-3">
                                    <h3 class="text-lg font-medium text-gray-700">Archivos seleccionados</h3>
                                    <button id="delete-selected-mobile"
                                        class="hidden bg-red-600 text-white text-sm px-3 py-1.5 rounded hover:bg-red-700 transition">
                                        Eliminar seleccionados
                                    </button>
                                </div>
                                <ul id="file-names-mobile"
                                    class="divide-y divide-gray-200 bg-gray-50 rounded-lg p-3 text-gray-700 text-sm">
                                    <li class="text-gray-400 italic text-center py-4" id="no-files-mobile">Aún no hay
                                        archivos seleccionados
                                    </li>
                                </ul>
                            </div>
                            <div class="border-b border-gray-300 w-full mt-2 mb-2">
                            </div>

                            <div class="flex items-center justify-end  gap-4 m-4">
                                <x-primary-button>{{ __('Guardar') }}</x-primary-button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <script type="module" src="{{ asset('js/files/files.js') }}"></script>
</x-app-layout>