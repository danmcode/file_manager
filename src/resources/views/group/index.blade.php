<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <header class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Grupos') }}
                        </h2>

                        <x-primary-button :href="route('groups.create')">{{ __('Crear Grupo') }}</x-primary-button>
                    </header>
                    <div class="border-b border-gray-300 w-full mt-2 mb-2"></div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                            <table id="groups-table" class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                    <tr>
                                        <th class="px-6 py-3">Nombre</th>
                                        <th class="px-6 py-3">Descripción</th>
                                        <th class="px-6 py-3 text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="group-row-template"
                                        class="hidden odd:bg-white even:bg-gray-50  border-gray-200">
                                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap group-name">
                                        </th>
                                        <td class="px-6 py-4 group-description"></td>
                                        <td class="px-6 py-4 text-center">
                                            <a href="#"
                                                class="group-edit font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>

                                            <a href="#" data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                                class="group-delete font-medium text-blue-600 dark:text-blue-500 hover:underline">Eliminar</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="pagination" class="flex items-center justify-between p-4 border-t bg-gray-50">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div id="delete-modal" tabindex="-1"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
        <div class="bg-white rounded-lg shadow-md w-full max-w-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Confirmar eliminación
            </h3>
            <p class="text-gray-600 mb-6">
                ¿Estás seguro de que deseas eliminar el grupo
                <span id="group-to-delete" class="font-semibold text-gray-900"></span>?
            </p>

            <div class="flex justify-end gap-3">
                <button id="cancel-delete" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-md">
                    Cancelar
                </button>
                <form method="POST" id="delete-group" action="#">
                    @csrf
                    @method('delete')
                    <button id="confirm-delete" type="submit"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md">
                        Sí, eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script type="module" src="{{ asset('js/groups/groups.js') }}"></script>
</x-app-layout>