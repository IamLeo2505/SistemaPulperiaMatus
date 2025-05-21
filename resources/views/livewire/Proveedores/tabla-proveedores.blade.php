<div class="overflow-hidden rounded-3xl shadow-lg mt-8 mb-8">
    @if ($proveedores->isEmpty())
        <div class="flex flex-col items-center justify-center text-gray-500 p-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.75 9.75h.008v.008H9.75V9.75zm0 4.5h.008v.008H9.75v-.008zm4.5-4.5h.008v.008H14.25V9.75zm0 4.5h.008v.008H14.25v-.008zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-lg font-semibold">No se encontraron proveedores con ese criterio.</p>
        </div>
    @else
        <table class="table w-full">
            <thead class="bg-[#004173] text-white">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Compañía</th>
                    <th>Número Telefónico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proveedores as $index => $proveedor)
                    <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-200' }} text-gray-800">
                        <td>{{ $proveedor->nombreProveedor }}</td>
                        <td>{{ $proveedor->apellidoProveedor }}</td>
                        <td>{{ $proveedor->compañía }}</td>
                        <td>{{ $proveedor->numeroProveedor }}</td>
                        <td class="px-4 py-2">
                            <div class="flex items-center gap-10">
                                <button
                                    wire:click="abrirModalEditar({{ $proveedor->id }}, '{{ $proveedor->nombreProveedor }}', '{{ $proveedor->apellidoProveedor }}', '{{ $proveedor->compañía }}', '{{ $proveedor->numeroProveedor }}')"
                                    class="text-blue-600 hover:text-blue-800"
                                    title="Editar">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>

                                <button wire:click="solicitarConfirmacion({{ $proveedor->id }})" class="text-red-600 hover:text-red-800" title="Eliminar">
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
    @endif
    
     <input type="checkbox" id="modal-editar" class="modal-toggle" {{ $mostrarModalEditar ? 'checked' : '' }} />
    <div class="modal" role="dialog">
        <div class="modal-box text-black bg-[#ffffff]">
            <h3 class="font-bold text-lg ">Editar Proveedor</h3>
            <form wire:submit.prevent="guardarProveedor">
                <div class="mb-4">
                    <label for="nombreProveedor" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input wire:model="nombreProveedor" type="text" id="nombreProveedor" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    @error('nombreProveedor') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
                    <input wire:model="apellidoProveedor" type="text" id="apellido" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    @error('apellidoProveedor') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="compañía" class="block text-sm font-medium text-gray-700">Compañía</label>
                    <input wire:model="compañía" type="text" id="compañía" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    @error('compañía') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="numeroProveedor" class="block text-sm font-medium text-gray-700">Número Telefónico</label>
                    <input wire:model="numeroProveedor" type="text" id="numeroProveedor" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    @error('numeroProveedor') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end">
                    <button type="button" wire:click="cerrarModalEditar" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2">Cancelar</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <input type="checkbox" id="modal-confirmacion" class="modal-toggle" {{ $mostrarConfirmacion ? 'checked' : '' }} />
    <div class="modal" role="dialog">
        <div class="modal-box text-white bg-[#004173]">
            <h3 class="font-bold text-lg">¿Seguro que deseas eliminar este proveedor?</h3>
            <p class="py-4">Esta acción no se puede deshacer.</p>
            <div class="modal-action">
                <button wire:click="cancelarEliminacion" class="btn bg-gray-500 hover:bg-gray-600">Cancelar</button>
                <button wire:click="eliminarProveedor" class="btn btn-error text-white bg-red-600">Eliminar</button>
            </div>
        </div>
    </div>
</div>