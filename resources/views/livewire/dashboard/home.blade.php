<x-layouts.app :title="$title">
    <x-slot name="header">
        <x-header />
    </x-slot>

    <x-slot name="sidebar">
        <x-sidebar />
    </x-slot>

    <x-slot name="footer">
        <x-footer />
    </x-slot>

    <div class="flex flex-col items-center justify-center h-full">
        <h2 class="text-3xl font-bold text-gray-800 text-center">
            ¡Bienvenido, <span class="text-indigo-600">{{ Auth::user()->empleado->nombreEmpleado }}
            </span> al Dashboard! 🚀💫</h2>
        <p class="mt-4 text-gray-600 text-center">Hola Mundo!</p>
    </div>
</x-layouts.app>