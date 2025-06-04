<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
    <h2 class="text-2xl font-bold text-[#001951] mb-6">Agregar Nuevo Producto</h2>

    <form wire:submit.prevent="guardar" enctype="multipart/form-data" class="space-y-6">


        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Imagen del producto</label>
            <input type="file" wire:model="image_path" class="mt-1 block w-full border border-gray-300 rounded-md p-2 text-sm text-black" />
            @error('imagen') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

            @if ($image_path)
                <img src="{{ $image_path->temporaryUrl() }}" class="h-32 mt-3 rounded-md" alt="Vista previa">
            @endif
        </div>

 
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del producto</label>
            <input type="text" wire:model="nombreProducto" class="mt-1 block w-full border border-gray-300 rounded-md p-2 text-sm text-black" />
            @error('nombreProducto') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>


        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
            <textarea wire:model="descripcion" class="mt-1 block w-full border border-gray-300 rounded-md p-2 text-sm h-24 text-black"></textarea>
            @error('descripcion') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Código de barras</label>
            <input type="text" wire:model="codigo_barras" class="mt-1 block w-full border border-gray-300 rounded-md p-2 text-sm text-black" />
            @error('codigo_barras') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cantidad en stock</label>
                <input type="number" wire:model="cantidadstock" class="mt-1 block w-full border border-gray-300 rounded-md p-2 text-sm text-black" />
                @error('cantidadstock') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de vencimiento</label>
                <input type="date" wire:model="fechavencimiento" class="mt-1 block w-full border border-gray-300 rounded-md p-2 text-sm text-black" />
                @error('fechavencimiento') <span class="text-black text-xs">{{ $message }}</span> @enderror
            </div>
        </div>


        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Precio</label>
            <input type="number" step="0.01" wire:model="precio_producto" class="mt-1 block w-full border border-gray-300 rounded-md p-2 text-sm text-black" />
            @error('precio_producto') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Unidad de Medida</label>
                <select wire:model="unidad_medida_id" class="mt-1 block w-full border border-gray-300 rounded-md p-2 text-sm text-black">
                    <option value="">Seleccione</option>
                    @foreach ($unidades as $u)
                        <option value="{{ $u->id }}">{{ $u->nombre_unidad }}</option>
                    @endforeach
                </select>
                @error('unidad_medida_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                <select wire:model="categoria_id" class="mt-1 block w-full border border-gray-300 rounded-md p-2 text-sm text-black">
                    <option value="">Seleccione</option>
                    @foreach ($categorias as $c)
                        <option value="{{ $c->id }}">{{ $c->nombre_categoria }}</option>
                    @endforeach
                </select>
                @error('categoria_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Marca</label>
                <select wire:model="marca_id" class="mt-1 block w-full border border-gray-300 rounded-md p-2 text-sm text-black">
                    <option value="">Seleccione</option>
                    @foreach ($marcas as $m)
                        <option value="{{ $m->id }}">{{ $m->nombreMarca }}</option>
                    @endforeach
                </select>
                @error('marca_id') <span class="text-black-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="flex justify-end pt-4">
              <button type="button" wire:click="cancelar" 
              class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2 text-sm">
              Cancelar</button>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md text-sm">
                Guardar Producto</button>
        </div>
    </form>
</div>
