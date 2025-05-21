<div class="p-4 relative">

    <h1 class="text-black font-bold mb-4">Gestión de Compras</h1>

    @if (session()->has('mensaje'))
        <div class="bg-blue-200 text-blue-800 p-2 rounded mb-4">{{ session('mensaje') }}</div>
    @endif

    <div>
        <livewire:compras.barra-busqueda-compras />

        <livewire:compras.tabla-compras />

        <a href="{{ route('compras.registrar_compras') }}" 
            class="fixed right-10 bottom-18 bg-blue-600 text-white px-4 py-2 rounded-2xl z-10 inline-block text-center">
                Agregar Nueva Compra
        </a>

    </div>

</div>