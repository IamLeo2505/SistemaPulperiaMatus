<div class="w-full bg-gray-100 p-6">
    <div class="w-full flex flex-col md:flex-row gap-6">
        <div class="w-full md:w-3/5 flex flex-col gap-4 bg-white rounded-2xl shadow-lg p-6">
            <div class="text-[#000000] text-xl font-bold">Datos de la Venta</div>
            <form class="flex flex-col gap-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-black">Fecha:</label>
                        <input type="date" wire:model="fecha" class="w-full rounded-xl bg-gray-100 p-2 focus:outline-none border border-gray-300 text-black placeholder-black">
                    </div>
                    <div>
                        <label class="text-sm text-black">N° Venta:</label>
                        <input type="text" wire:model="nventa" readonly class="w-full rounded-xl bg-gray-100 p-2 focus:outline-none border border-gray-300 text-black placeholder-black">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 items-end">
                    <div>
                        <label class="text-sm text-black">Cliente:</label>
                        <select wire:model="cliente_id" class="w-full rounded-xl bg-gray-100 p-2 focus:outline-none border border-gray-300 text-black">
                            <option value="">Seleccione un cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombreCliente }} {{ $cliente->apellidoCliente }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <a href="{{ route('clientes') }}" class="bg-[#004173] text-white rounded-xl px-4 py-2 text-sm hover:bg-[#005999]">
                            Agregar Nuevo Cliente
                        </a>
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-4">
                    <button type="button" wire:click="guardarYReiniciar" class="bg-gray-500 text-white rounded-xl px-4 py-2 text-sm hover:bg-gray-700">
                        Nueva Venta
                    </button>
                </div>
            </form>

            <table class="text-sm mt-4 w-full border-collapse rounded-xl overflow-hidden">
                <thead class="bg-[#004173] text-white">
                    <tr>
                        <th class="p-2">Producto</th>
                        <th class="p-2">Cantidad</th>
                        <th class="p-2">Precio</th>
                        <th class="p-2">Subtotal</th>
                        <th class="p-2">IVA</th>
                        <th class="p-2">Descuento</th>
                        <th class="p-2">Total</th>
                        <th class="p-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detalle as $index => $item)
                        <tr class="odd:bg-gray-100 even:bg-white text-[#004173]">
                            <td class="p-2 text-center">{{ $item['nombre'] }}</td>
                            <td class="p-2 text-center">{{ $item['cantidad'] }}</td>
                            <td class="p-2 text-center">{{ number_format($item['precio'], 2) }}</td>
                            <td class="p-2 text-center">{{ number_format($item['subtotal'], 2) }}</td>
                            <td class="p-2 text-center">{{ number_format($item['iva'], 2) }}</td>
                            <td class="p-2 text-center">{{ number_format($item['descuento'], 2) }}</td>
                            <td class="p-2 text-center">{{ number_format($item['total'], 2) }}</td>
                            <td class="p-2">
                                <div class="flex justify-center gap-2">
                                    <button wire:click="eliminarProducto({{ $index }})" class="text-red-600 hover:text-red-800" title="Eliminar">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="w-full md:w-2/5 flex flex-col gap-6">
            <div 
                x-data="{
                    productos: window.productos,
                    producto_id: '',
                    stock: 0,
                    precio: 0,
                    cantidad: 0,
                    actualizarDatos() {
                        const prod = this.productos.find(p => p.id == this.producto_id);
                        this.stock = prod?.cantidadstock || 0;
                        this.precio = prod?.precio_producto || 0;
                    }
                }"
                x-init="actualizarDatos()"
                class="bg-white rounded-2xl shadow-lg p-6"
            >
                <h2 class="text-black font-bold text-lg mb-2">Agregar Producto</h2>
                
                <div class="flex flex-col gap-3">
                    <label class="text-sm text-black">Producto:</label>
                    <select 
                        x-model="producto_id" 
                        @change="actualizarDatos" 
                        class="rounded-xl bg-gray-100 p-2 border border-gray-300 text-black"
                    >
                        <option value="">Seleccione producto</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->nombreProducto }}</option>
                        @endforeach
                    </select>

                    <div class="flex gap-2">
                        <div class="flex-1">
                            <label class="text-sm text-black">Stock Actual:</label>
                            <input type="text" :value="stock" readonly class="w-full rounded-xl bg-gray-100 p-2 border border-gray-300 text-black">
                        </div>
                        <div class="flex-1">
                            <label class="text-sm text-black">Cantidad:</label>
                            <input type="number" x-model="cantidad" class="w-full rounded-xl bg-gray-100 p-2 border border-gray-300 text-black">
                        </div>
                    </div>

                    <label class="text-sm text-black">Precio:</label>
                    <input type="number" x-model="precio" readonly class="rounded-xl bg-gray-100 p-2 border border-gray-300 text-black">
                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <button 
                        type="button" 
                        @click="
                            producto_id = ''; 
                            stock = 0; 
                            precio = 0; 
                            cantidad = 0;
                        " 
                        class="bg-gray-500 text-white px-4 py-2 rounded-xl hover:bg-gray-700 text-sm"
                    >
                        Limpiar
                    </button>

                    <button 
                        type="button" 
                        @click="@this.agregarProductoDesdeFrontend(producto_id, cantidad, precio)"
                        class="bg-[#004173] text-white px-4 py-2 rounded-xl hover:bg-[#005999] text-sm"
                    >
                        Agregar
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-black font-bold text-lg mb-2">Detalles de pago</h2>
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <label class="text-black">Subtotal:</label>
                        <div class="bg-gray-100 w-full h-10 rounded-xl p-2 border border-gray-300 text-black">
                            {{ number_format($subtotal, 2) }}
                        </div>
                    </div>
                    <div>
                        <label class="text-black">IVA (%):</label>
                        <input type="number" wire:model="iva" class="bg-gray-100 w-full h-10 rounded-xl p-2 border border-gray-300 text-black">
                    </div>
                    <div>
                        <label class="text-black">Descuento (%):</label>
                        <input type="number" wire:model="descuento" class="bg-gray-100 w-full h-10 rounded-xl p-2 border border-gray-300 text-black">
                    </div>
                    <div>
                        <label class="text-black">Total:</label>
                        <div class="bg-gray-100 w-full h-10 rounded-xl p-2 border border-gray-300 text-black">
                            {{ number_format($total, 2) }}
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-4">
                    <button wire:click="guardarVenta(true)" class="bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-800 text-sm">Finalizar Venta</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.productos = @json($productos);
    </script>
</div>