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
        @auth
            @php
                $usuarioAutenticado = Auth::user();
                $empleado = $usuarioAutenticado->empleado;
            @endphp
            @if ($empleado)
                <div class="mb-4">
                    @if ($usuarioAutenticado->image_path_Usuarios)
                        <img src="{{ asset('storage/' . $usuarioAutenticado->image_path_Usuarios) }}" alt="Foto de perfil de {{ $empleado->nombreEmpleado }}" class="rounded-full h-32 w-32 object-cover">
                    @else
                        <span class="inline-flex items-center justify-center h-32 w-32 rounded-full bg-gray-500 text-white font-semibold text-2xl">{{ strtoupper(substr($empleado->nombreEmpleado, 0, 1)) }}{{ strtoupper(substr($empleado->apellidoEmpleado, 0, 1)) }}</span>
                    @endif
                </div>
            @endif
        @endauth
        <h2 class="text-3xl font-bold text-gray-800 text-center">
            ¡Bienvenido, <span class="text-indigo-600">{{ Auth::user()->empleado->nombreEmpleado }}
            </span> al Sistema! 🚀💫
        </h2>
        <p class="mt-4 text-gray-600 text-center">Hola Mundo!</p>
    </div>
</x-layouts.app>