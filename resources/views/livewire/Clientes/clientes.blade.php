<div class="p-4 relative">
    {{-- El contenedor padre con position: relative --}}
    <h1 class="text-black font-bold mb-4">Gestión de Clientes</h1>

    @if (session()->has('mensaje'))
        <div class="bg-blue-200 text-blue-800 p-2 rounded mb-4">{{ session('mensaje') }}</div>
    @endif

    <div>
        <livewire:clientes.barra-busqueda-clientes />

        <livewire:clientes.tabla-clientes :clientes="$clientes" />

        <button wire:click="abrirModal" class="bg-[#004173] right-10 bottom-18 bg-blue-600 text-white px-4 py-2 rounded-2xl z-10">
            Agregar cliente
        </button>
    </div>

    @if ($modalAbierto)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white w-full max-w-md p-6 rounded shadow-lg text-black">
                <h2 class="font-bold text-lg mb-4">
                    {{ $modoEdicion ? 'Editar Cliente' : 'Nuevo Cliente' }}
                </h2>

                <form wire:submit.prevent="{{ $modoEdicion ? 'actualizarCliente' : 'guardarCliente' }}" class="space-y-3">
                    <div class="mb-4">
                        <label for="nombreCliente" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" wire:model="nombreCliente" id="nombreCliente" placeholder="Nombre" class="w-full border rounded p-2">
                        @error('nombreCliente') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="apellidoCliente" class="block text-sm font-medium text-gray-700">Apellido</label>
                        <input type="text" wire:model="apellidoCliente" id="apellidoCliente" placeholder="Apellido" class="w-full border rounded p-2">
                        @error('apellidoCliente') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="numeroCliente" class="block text-sm font-medium text-gray-700">Número Telefónico</label>
                        <input type="number" wire:model="numeroCliente" id="numeroCliente" placeholder="Número telefónico" class="w-full border rounded p-2">
                        @error('numeroCliente') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="edad" class="block text-sm font-medium text-gray-700">Edad</label>
                        <input type="number" wire:model="edad" id="edad" placeholder="Edad" class="w-full border rounded p-2">
                        @error('edad') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="genero" class="block text-sm font-medium text-gray-700">Género</label>
                        <select wire:model="genero" id="genero" class="w-full border rounded p-2">
                            <option value="1">Masculino</option>
                            <option value="0">Femenino</option>
                        </select>
                        @error('genero') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                        <select wire:model="estado" id="estado" class="w-full border rounded p-2">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                        @error('estado') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

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

    @if ($mostrarConfirmacion)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white w-full max-w-md p-6 rounded shadow-lg text-black">
                <h2 class="font-bold text-lg mb-4">¿Eliminar Cliente?</h2>
                <p>¿Estás seguro de que deseas eliminar a <strong>{{ $clienteAEliminar ? $clienteAEliminar->nombreCliente . ' ' . $clienteAEliminar->apellidoCliente : '' }}</strong>?</p>
                <div class="flex justify-end space-x-2 mt-4">
                    <button wire:click="cancelarEliminarCliente" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</button>
                    <button wire:click="confirmarEliminarCliente" class="bg-red-600 text-white px-4 py-2 rounded">Eliminar</button>
                </div>
            </div>
        </div>
    @endif
</div>