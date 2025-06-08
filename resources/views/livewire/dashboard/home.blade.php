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

    <div 
        x-data="{ showWelcome: true }" 
        x-init="setTimeout(() => showWelcome = false, 4000)" 
        class="flex flex-col items-center justify-center h-full transition-all duration-700 ease-in-out"
    >
        {{-- Bienvenida general --}}
        <div 
            x-show="showWelcome" 
            x-transition:leave="transition-opacity duration-3000" 
            x-transition:leave-start="opacity-100" 
            x-transition:leave-end="opacity-0"
            class="text-center"
        >
            @auth
                @php
                    $usuarioAutenticado = Auth::user();
                    $empleado = $usuarioAutenticado->empleado;
                @endphp
                @if ($empleado)
                    {{-- Imagen con transición más lenta (3s) --}}
                    <div 
                        x-show="showWelcome"
                        x-transition:leave="transition-opacity duration-[3000ms]" 
                        x-transition:leave-start="opacity-100" 
                        x-transition:leave-end="opacity-0"
                        class="mb-4"
                    >
                        @if ($usuarioAutenticado->image_path_Usuarios)
                            <img src="{{ asset('storage/' . $usuarioAutenticado->image_path_Usuarios) }}" alt="Foto de perfil de {{ $empleado->nombreEmpleado }}" class="rounded-full h-32 w-32 object-cover mx-auto">
                        @else
                            <span class="inline-flex items-center justify-center h-32 w-32 rounded-full bg-gray-500 text-white font-semibold text-2xl">
                                {{ strtoupper(substr($empleado->nombreEmpleado, 0, 1)) }}{{ strtoupper(substr($empleado->apellidoEmpleado, 0, 1)) }}
                            </span>
                        @endif
                    </div>

                    {{-- Texto de bienvenida --}}
                    <h2 class="text-3xl font-bold text-gray-800">
                        ¡Bienvenido <span class="text-indigo-600">{{ $empleado->nombreEmpleado }}</span> al Sistema! 🚀💫
                    </h2>
                @endif
            @endauth
        </div>

        {{-- Dashboard Power BI --}}
        <div 
            x-show="!showWelcome" 
            x-transition:enter="transition-opacity duration-[3000ms]" 
            x-transition:enter-start="opacity-0" 
            x-transition:enter-end="opacity-100"
            class="w-full flex justify-center items-center mt-8"
        >
            <iframe 
                title="Dashboard Pulpería Matus" 
                width="1024" 
                height="1060" 
                src="https://app.powerbi.com/view?r=eyJrIjoiNTE5M2ZlMmYtZDA5NS00OThiLTg1NDItMGU3Zjc1YWQxOTgxIiwidCI6ImU0NzY0NmZlLWRhMjctNDUxOC04NDM2LTVmOGIxNThiYTEyNyIsImMiOjR9" 
                frameborder="0" 
                allowfullscreen="true"
                class="rounded shadow-lg"
            ></iframe>
        </div>
    </div>
</x-layouts.app>
