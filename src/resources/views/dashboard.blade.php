<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            asda | asdsa | sdds
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="max-w-6xl mx-auto p-6">
                        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Subir archivos</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <div id="dropzone"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 border-gray-300 transition">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center">
                                        <svg class="w-10 h-10 mb-3 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5A5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-600"><span class="font-semibold">Haz clic para
                                                subir</span> o
                                            arrastra tus
                                            archivos</p>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF, PDF, DOCX (máx. 10MB)</p>
                                    </div>
                                    <input id="file-input" type="file" multiple class="hidden" />
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
                                    <li class="text-gray-400 italic text-center py-4" id="no-files">Aún no hay archivos
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
                </div>
            </div>
        </div>
    </div>

    <script type="module" src="{{ asset('js/files/files.js') }}"></script>
</x-app-layout>