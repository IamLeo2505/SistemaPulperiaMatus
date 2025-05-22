<header class="bg-[#001951] shadow px-6 py-4 flex justify-between items-center border-b-2 border-b-[#0cb7f2]">
    <div class="flex items-center">
        <h1 class="text-2xl font-semibold text-white">Pulpería Matus</h1>
    </div>
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
