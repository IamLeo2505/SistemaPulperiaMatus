<header class="bg-[#001951] shadow px-6 py-4 flex justify-between items-center border-b-2 border-b-[#0cb7f2]">
    <div class="flex items-center">
        <h1 class="text-2xl font-semibold text-white">Pulpería Matus</h1>
    </div>

    <div class="flex items-center gap-4 text-white">
        <button id="btnFullScreen" title="Pantalla completa"
            class="rounded-full bg-[#0cb7f2] hover:bg-[#099fcf] p-2 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
            </svg>
        </button>


        @auth
            @php
                $usuarioAutenticado = Auth::user();
                $empleado = $usuarioAutenticado->empleado;
            @endphp

            @if ($empleado)
                <div class="flex flex-col items-end ms-4">
                    <div class="flex items-center space-x-3">
                        @if ($usuarioAutenticado->image_path_Usuarios)
                            <img src="{{ asset('storage/' . $usuarioAutenticado->image_path_Usuarios) }}"
                                alt="Foto de perfil de {{ $empleado->nombreEmpleado }}"
                                class="rounded-full h-8 w-8 object-cover">
                        @else
                            <span
                                class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-gray-500 text-white font-semibold">
                                {{ strtoupper(substr($empleado->nombreEmpleado, 0, 1)) }}{{ strtoupper(substr($empleado->apellidoEmpleado, 0, 1)) }}
                            </span>
                        @endif
                        <span class="text-sm text-white">{{ $empleado->nombreEmpleado }} {{ $empleado->apellidoEmpleado }}</span>
                    </div>
                    @livewire('login.logout')
                </div>
            @else
                <span class="text-white ms-4">Empleado no asignado</span>
            @endif
        @endauth

    </div>
</header>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btnFullscreen = document.getElementById('btnFullScreen');

        btnFullscreen.addEventListener('click', () => {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen().catch((err) => {
                    console.error(`Error al activar pantalla completa: ${err.message}`);
                });
            } else {
                document.exitFullscreen();
            }
        });
    });
</script>
