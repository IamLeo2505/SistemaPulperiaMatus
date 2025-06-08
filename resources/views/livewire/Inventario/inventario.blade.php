<div class="p-4 relative"> {{-- El contenedor padre con position: relative --}}
    <h1 class="text-black font-bold mb-4">Gestión de Inventario</h1>

    @if (session()->has('mensaje'))
        <div class="bg-blue-700 p-2 rounded mb-4">{{ session('mensaje') }}</div>
    @endif

<div class="flex flex-wrap items-center gap-4 mb-4">
    <div class="relative flex items-center overflow-hidden w-[32rem] h-[42px] border-2 border-[#004173] rounded-full">
        <button wire:click="buscar" class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-600 bg-transparent focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor"
                class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>

        <input
            wire:model.debounce.300ms="termino"
            type="text"
            placeholder="Buscar producto..."
            class="w-full h-full px-12 text-black bg-transparent focus:outline-none rounded-full" />

        <button onclick="location.reload()"
            class="absolute inset-y-0 right-[6rem] flex items-center pr-3 text-gray-400 bg-transparent focus:outline-none z-20 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor"
                class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <button wire:click="buscar"
            class="absolute inset-y-0 right-0 flex items-center px-4 text-white bg-[#004173] rounded-r-full h-full hover:bg-[#00345c] transition focus:outline-none text-sm z-20">
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor"
                class="w-5 h-5 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <span>Buscar</span>
        </button>
    </div>

        <div class="flex items-center border border-[#004173] bg-gray-200 rounded-full px-3 h-[42px] w-[10rem]">
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor"
                class="w-8 h-8 text-[#004173] mr-2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
            </svg>

            <select
                wire:model="filtro"
                class="select bg-transparent border-none text-black focus:outline-none text-sm w-full">
                <option value="nombreProducto">Producto</option>
                <option value="codigo_barras">Código</option>
                <option value="categoria_id">Categoría</option>
                <option value="marca_id">Marca</option>
                <option value="fechavencimiento">Fecha</option>
            </select>
        </div>


    <a href="{{ route('inventario.categorias') }}"
        class="bg-blue-700 text-white px-4 py-2 rounded-full hover:bg-blue-900 transition">
        Ver Categoría
    </a>

    <a href="{{ route('inventario.marcas') }}"
        class="bg-blue-700 text-white px-4 py-2 rounded-full hover:bg-blue-900 transition">
        Ver Marca
    </a>
    <a href="{{ route('inventario.crear') }}"
        class="inline-flex items-center gap-2 bg-blue-700 text-white px-4 py-2 rounded-full hover:bg-blue-900 transition">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke-width="2" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        Agregar producto
    </a>
</div>

<div class="overflow-hidden rounded-3xl shadow-lg mt-8 mb-8">
    @if ($productos->isEmpty())
        <div class="flex flex-col items-center justify-center text-gray-500 p-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.75 9.75h.008v.008H9.75V9.75zm0 4.5h.008v.008H9.75v-.008zm4.5-4.5h.008v.008H14.25V9.75zm0 4.5h.008v.008H14.25v-.008zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-lg font-semibold">No se encontraron productos con ese criterio.</p>
        </div>
    @else
        <table class="table w-full"> {{-- Eliminamos el id="tabla-inventario" --}}
            <thead class="bg-[#004173] text-white">
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Descripción</th>
                    <th>Código</th>
                    <th>Stock</th>
                    <th>Fecha de Vencimiento</th>
                    <th>Precio</th>
                    <th>Medida</th>
                    <th>Categoría</th>
                    <th>Marca</th>
                    <th>Creado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $index => $p)
                    <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-200' }} text-gray-800">
                        <td><img src="{{ asset('storage/' . $p->image_path) }}" alt="Producto" class="w-10 h-10 object-cover rounded" /></td>
                        <td>{{ $p->nombreProducto }}</td>
                        <td>{{ $p->descripcion }}</td>
                        <td>{{ $p->codigo_barras }}</td>
                        <td>{{ $p->cantidadstock }}</td>
                        <td>{{ $p->fechavencimiento }}</td>
                        <td>{{ number_format($p->precio_producto, 2) }}</td>
                        <td>{{ $p->Unidad_Medida->nombre_unidad }}</td>
                        <td>{{ $p->categoria->nombre_categoria }}</td>
                        <td>{{ $p->marca->nombreMarca }}</td>
                        <td>{{ $p->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">
                            <div class="flex items-center gap-10">
                                <button
                                    wire:click="abrirModalEditar({{ $p->id }}, '{{ $p->nombreProducto }}', '{{ $p->descripcion }}', '{{ $p->codigo_barras }}', '{{ $p->cantidadstock }}', '{{ $p->fechavencimiento }}', '{{ $p->precio_producto }}')"
                                    class="text-blue-600 hover:text-blue-800"
                                    title="Editar">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>
                                <button wire:click="confirmarEliminacion({{ $p->id }})" class="text-red-600 hover:text-red-800" title="Eliminar">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3 px-2 items-center">
            {{ $productos->links() }}
        </div>
    @endif
</div>