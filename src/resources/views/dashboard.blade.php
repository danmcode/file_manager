<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Dashboard --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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