<div class="p-4">
    <h1 class="text-black font-bold mb-4">Gestión de Proveedores</h1>

    @if (session()->has('mensaje'))
        <div class="blue-200 p-2 rounded mb-4">{{ session('mensaje') }}</div>
    @endif    

    <div> <!-- Div raíz para agrupar todo -->
        <livewire:proveedores.barra-busqueda-proveedores />

        <livewire:proveedores.tabla-proveedores />

        <button wire:click="abrirModal" class="bg-blue-600 text-white px-4 py-2 rounded mb-4">
            Agregar proveedor
        </button>
    </div>

    <!-- Modal -->
    @if ($modalAbierto)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-full max-w-md p-6 rounded shadow-lg">
            <h2 class="text-black font-bold mb-4">
                {{ $modoEdicion ? 'Editar Proveedor' : 'Nuevo Proveedor' }}
            </h2>

            <form wire:submit.prevent="{{ $modoEdicion ? 'actualizarProveedor' : 'guardarProveedor' }}" class="space-y-3">
                <input type="text" wire:model="nombreProveedor" placeholder="Nombre" class="w-full border rounded p-2 text-black" >
                <input type="text" wire:model="apellidoProveedor" placeholder="Apellido" class="w-full border rounded p-2 text-black" >
                <input type="text" wire:model="compañía" placeholder="Compañía" class="w-full border rounded p-2 text-black">
                <input type="number" wire:model="numeroProveedor" placeholder="Número telefónico" class="w-full border rounded p-2 text-black">

                <div class="flex justify-end space-x-2">
                    <button type="button" wire:click="cerrarModal" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                        {{ $modoEdicion ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
