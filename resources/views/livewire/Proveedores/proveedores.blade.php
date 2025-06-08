<div class="p-4 relative"> 
    <h1 class="text-black font-bold mb-4">Gestión de Proveedores</h1>

    @if (session()->has('mensaje'))
        <div class="bg-blue-700 p-2 rounded mb-4">{{ session('mensaje') }}</div>
    @endif

    <div>
        <livewire:proveedores.barra-busqueda-proveedores />
        <livewire:proveedores.tabla-proveedores />        
    </div>

    
</div>