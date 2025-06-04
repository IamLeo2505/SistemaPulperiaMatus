<div>
    <div class="flex flex-wrap items-center gap-2 mb-4">
        <!-- Input de búsqueda -->
        <div class="relative flex items-center overflow-hidden w-[32rem] h-[42px] border-2 border-[#004173] rounded-full">
            <!-- Icono lupa al inicio -->
            <button
                wire:click="buscar"
                class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-600 bg-transparent focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor"
                    class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />

                </svg>
            </button>

            <!-- Input -->
            <input
                wire:model.debounce.300ms="termino"
                type="text"
                placeholder="Buscar proveedor..."
                class="w-full h-full px-12 text-black bg-transparent focus:outline-none rounded-full" />

            <!-- Botón limpiar -->
            <button
                onclick="location.reload()"
                class="absolute inset-y-0 right-[6rem] flex items-center pr-3 text-gray-400 bg-transparent focus:outline-none z-20 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Botón buscar -->
            <button
                wire:click="buscar"
                class="absolute inset-y-0 right-0 flex items-center px-4 text-white bg-[#004173] rounded-r-full h-full hover:bg-[#00345c] transition focus:outline-none text-sm z-20">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <span>Buscar</span>
            </button>
        </div>

        <!-- Select con ícono de filtro embebido -->
        <div class="flex items-center border border-[#004173] bg-gray-200 rounded-full px-3 h-[42px] w-[10rem]">
            <!-- Ícono filtro -->
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor"
                class="w-8 h-8 text-[#004173] mr-2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
            </svg>

            <!-- Select -->
            <select
                wire:model="filtro"
                class="select bg-transparent border-none text-black focus:outline-none text-sm w-full">
                <option value="nombreProveedor">Nombre</option>
                <option value="compañía">Compañía</option>
                <option value="numeroProveedor">Número</option>
            </select>
        </div>
        <button wire:click="abrirModal" class="bg-blue-700 text-white px-4 py-2 rounded-full hover:bg-blue-900 transition">
            Agregar proveedor
        </button>

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
</div>
