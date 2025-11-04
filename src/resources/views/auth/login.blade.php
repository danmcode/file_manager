<x-guest-layout>
    <!-- Logo + título en una fila -->
    <div class="flex items-center justify-center mb-8 space-x-4">
        <!-- Logo con fondo -->
        <div class="bg-[#1a202c] p-3 rounded flex items-center justify-center">
            <img src="{{ asset('images/danmcode-icon.png') }}" alt="danmcode" class="h-15 w-16">
        </div>

        <!-- Texto al lado -->
        <div class="text-2xl font-semibold text-[#1a202c]">
            <span class="text-gray-500">|</span> File Manager
        </div>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Formulario de login -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico:')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña:')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Botón -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Iniciar sesión') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>