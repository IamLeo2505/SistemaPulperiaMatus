<header class="bg-white shadow px-6 py-4 flex justify-between items-center border-b-2 border-b-[#0cb7f2]">
    <h1 class="text-2xl font-semibold text-gray-800">Pulpería Matus</h1>
@auth
    @php
        $empleado = Auth::user()->empleado;
    @endphp

    @if ($empleado)
        <div class="text-gray-600">{{ $empleado->nombreEmpleado }} {{ $empleado->apellidoEmpleado }}</div>
    @else
        <div class="text-gray-600">Empleado no asignado</div>
    @endif
@endauth

</header>