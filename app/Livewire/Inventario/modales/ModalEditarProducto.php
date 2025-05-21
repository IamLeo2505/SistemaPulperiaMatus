@if ($abrirModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-full max-w-md p-6 rounded shadow-lg">
            <h2 class="text-black font-bold mb-4">
                {{ $isEditing ? 'Editar Producto' : 'Nuevo Producto' }}
            </h2>

            <form wire:submit.prevent="saveProducto" class="space-y-3">
                <input type="text" wire:model="nombreProducto" placeholder="Nombre" class="w-full border rounded p-2 text-black">
                <select wire:model="categoria_id" class="w-full border rounded p-2 text-black">
                    <option value="">Selecciona una categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>

                <select wire:model="marca_id" class="w-full border rounded p-2 text-black">
                    <option value="">Selecciona una marca</option>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                    @endforeach
                </select>

                <input type="number" wire:model="precio_producto" placeholder="Precio" class="w-full border rounded p-2 text-black">
                <input type="number" wire:model="cantidadstock" placeholder="Cantidad en Stock" class="w-full border rounded p-2 text-black">

                <div class="flex justify-end space-x-2">
                    <button type="button" wire:click="$set('abrirModal', false)" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                        {{ $isEditing ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif
