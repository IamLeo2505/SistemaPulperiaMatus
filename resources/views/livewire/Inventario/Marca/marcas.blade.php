<div class="p-4 relative">
    <h1 class="text-black font-bold mb-4">Gestión de Marcas</h1>

    @if (session()->has('mensaje'))
        <div class="bg-blue-700 p-2 rounded mb-4">{{ session('mensaje') }}</div>
    @endif

<div class="flex flex-wrap items-center gap-4 mb-4">
    <!-- Input de búsqueda -->
    <div class="relative flex items-center overflow-hidden w-[32rem] h-[42px] border-2 border-[#004173] rounded-full">
        <!-- Icono lupa al inicio -->
        <button wire:click="buscar" class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-600 bg-transparent focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor"
                class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>

        <!-- Input -->
        <input
            wire:model.debounce.300ms="termino"
            type="text"
            placeholder="Buscar marca..."
            class="w-full h-full px-12 text-black bg-transparent focus:outline-none rounded-full" />

        <!-- Botón limpiar -->
        <button onclick="location.reload()"
            class="absolute inset-y-0 right-[6rem] flex items-center pr-3 text-gray-400 bg-transparent focus:outline-none z-20 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor"
                class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Botón buscar -->
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


    <!-- Botones al lado del buscador -->
    <a href="{{ route('inventario.categorias') }}"
        class="bg-blue-700 text-white px-4 py-2 rounded-full hover:bg-blue-900 transition">
        Ver Categoría
    </a>

    <a href="{{ route('inventario') }}"
        class="bg-blue-700 text-white px-4 py-2 rounded-full hover:bg-blue-900 transition">
        Ver Inventario
    </a>
    <button
    wire:click="abrirModalCrear"
    class="inline-flex items-center gap-2 bg-blue-700 text-white px-4 py-2 rounded-full hover:bg-blue-900 transition">

    <!-- Ícono de añadir -->
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke-width="2" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M12 4.5v15m7.5-7.5h-15" />
    </svg>

    Agregar Marca
    </button>

</div>


<div class="overflow-hidden rounded-3xl shadow-lg mt-8 mb-8">
    @if ($marcas->isEmpty())
        <div class="flex flex-col items-center justify-center text-gray-500 p-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.75 9.75h.008v.008H9.75V9.75zm0 4.5h.008v.008H9.75v-.008zm4.5-4.5h.008v.008H14.25V9.75zm0 4.5h.008v.008H14.25v-.008zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-lg font-semibold">No se encontraron marcas con ese criterio.</p>
        </div>
    @else
        <table class="table ">
            <thead class="bg-[#004173] text-white">
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($marcas as $index => $m)
                    <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-200' }} text-gray-800">
                        <td>{{ $m->nombreMarca }}</td>
      
                        <td class="px-4 py-2">
                            <div class="flex items-center gap-10">
                                <button
                                    wire:click="abrirModalEditar({{ $m->id }}, '{{ $m->nombreMarca }}')"
                                    class="text-blue-600 hover:text-blue-800"
                                    title="Editar">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>

                                <button wire:click="confirmarEliminacion({{ $m->id }})" class="text-red-600 hover:text-red-800" title="Eliminar">
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
            {{ $marcas->links() }}
        </div>
    @endif



 <!-- Modal Formulario -->
    @if($modal)
    <div class="fixed inset-0 bg-black bg-opacity-30 flex justify-center items-center">
        <div class="bg-white p-6 rounded shadow-md w-96">
            <h2 class="text-xl mb-4 text-black">{{ $marca_id ? 'Editar Marca' : 'Nueva Marca' }}</h2>
            <input wire:model="nombreMarca" type="text" placeholder="Nombre de la marca" class="w-full border p-2 rounded mb-4 text-black">
            @error('nombreMarca') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <div class="flex justify-end gap-2">
                <button wire:click="cerrarModal" class="bg-gray-300 px-4 py-2 rounded">Cancelar</button>
                <button wire:click="guardar" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal Confirmación Eliminar -->
@if($modalConfirmarEliminacion)
    <div class="fixed inset-0 bg-black bg-opacity-30 flex justify-center items-center">
        <div class="bg-[#004173] p-6 rounded shadow-md w-96">
            <h2 class="text-lg mb-4 text-white">¿Estás seguro de eliminar esta marca?</h2>
            <div class="flex justify-end gap-2">
                <button wire:click="cerrarModal" class="btn bg-gray-500 hover:bg-gray-600 px-4 py-2 rounded">Cancelar</button>
                <button wire:click="eliminar" class="btn btn-error text-white bg-red-600 px-4 py-2 rounded">Eliminar</button>
            </div>
        </div>
    </div>
    @endif

@if($modal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-lg font-bold mb-4 text-black">Agregar Marca</h2>

            <input type="text" wire:model="nombreMarca" placeholder="Nombre de la Marca"
                   class="w-full border border-gray-300 rounded p-2 mb-4 focus:outline-none focus:ring focus:ring-blue-400 text-black">

            @error('nombreMarca') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror

            <div class="flex justify-end space-x-2">
                <button wire:click="cerrarModal" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">Cancelar</button>
                <button wire:click="guardarMarca" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Guardar</button>
            </div>
        </div>
    </div>
@endif


@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        $('#tabla-marca').DataTable({
            responsive: true,
            pageLength: 10,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
            }
        });

        Livewire.hook('message.processed', (message, component) => {
            $('#tabla-marca').DataTable().destroy();
            setTimeout(() => {
                $('#tabla-marca').DataTable({
                    responsive: true,
                    pageLength: 10,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
                    }
                });
            }, 10);
        });
    });
</script>
@endpush
