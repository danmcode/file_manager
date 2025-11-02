<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Configuración') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto p-4">
                    <h1 class="text-xl font-semibold mb-4">Usuarios</h1>

                    <table class="w-full border" id="users-table">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-2 border">Nombre</th>
                                <th class="p-2 border">Email</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <div id="pagination" class="flex items-center justify-between mt-4"></div>
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="{{ asset('js/users/users.js') }}"></script>
</x-app-layout>