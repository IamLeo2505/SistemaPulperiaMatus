<div class="p-4 relative">

    <h1 class="text-black font-bold mb-4">Gestión de Ventas</h1>

    @if (session()->has('mensaje'))
        <div class="bg-blue-200 text-blue-800 p-2 rounded mb-4">{{ session('mensaje') }}</div>
    @endif

    <div>
        <livewire:ventas.barra-busqueda-ventas />

        <livewire:ventas.tabla-ventas />

        <a href="{{ route('ventas.registrar_ventas') }}" 
            class="bg-[#004173] right-10 bottom-18 bg-blue-600 text-white px-4 py-2 rounded-2xl z-10">
                Agregar Nueva Venta
        </a>

    </div>

</div>