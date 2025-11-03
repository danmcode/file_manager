<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <header class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Usuarios') }}
                        </h2>

                        <x-primary-button :href="route('users.create')">{{ __('Crear Usuario') }}</x-primary-button>
                    </header>
                    <div class="border-b border-gray-300 w-full mt-2 mb-2"></div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                            <table id="users-table" class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                    <tr>
                                        <th class="px-6 py-3">Nombre</th>
                                        <th class="px-6 py-3">Email</th>
                                        <th class="px-6 py-3">Grupo</th>
                                        <th class="px-6 py-3">Rol</th>
                                        <th class="px-6 py-3 text-right">Cuota (MB)</th>
                                        <th class="px-6 py-3 text-right">Uso (MB)</th>
                                        <th class="px-6 py-3 text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="user-row-template"
                                        class="hidden odd:bg-white even:bg-gray-50  border-gray-200">
                                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap user-name">
                                        </th>
                                        <td class="px-6 py-4 user-email"></td>
                                        <td class="px-6 py-4 user-group"></td>
                                        <td class="px-6 py-4 user-role"></td>
                                        <td class="px-6 py-4 text-right user-quota"></td>
                                        <td class="px-6 py-4 text-right user-used"></td>
                                        <td class="px-6 py-4 text-center">
                                            <a href="#"
                                                class="user-edit font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>

                                            <a href="#"
                                                class="user-delete font-medium text-blue-600 dark:text-blue-500 hover:underline">Eliminar</a>
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
    <script type="module" src="{{ asset('js/users/users.js') }}"></script>
</x-app-layout>