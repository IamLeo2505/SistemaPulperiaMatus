<div class="p-6">

    <div class="flex justify-between mb-4">
        <input wire:model="search" type="text" placeholder="Buscar proveedor..." class="border rounded px-4 py-2 w-1/3">
        <button wire:click="create" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Nuevo Proveedor
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">
            {{ session('message') }}
        </div>
    @endif

    <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                <th class="px-6 py-3">Apellido</th>
                <th class="px-6 py-3">Compañía</th>
                <th class="px-6 py-3">Número</th>
                <th class="px-6 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($proveedores as $prov)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $prov->Nombre }}</td>
                    <td class="px-6 py-4">{{ $prov->Apellido }}</td>
                    <td class="px-6 py-4">{{ $prov->Compañía }}</td>
                    <td class="px-6 py-4">{{ $prov->Numero }}</td>
                    <td class="px-6 py-4 flex space-x-2">
                        <button wire:click="edit({{ $prov->idProveedor }})" class="text-blue-600 hover:text-blue-900">
                            ✏️
                        </button>
                        <button wire:click="delete({{ $prov->idProveedor }})" class="text-red-600 hover:text-red-900">
                            🗑️
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $proveedores->links() }}
    </div>

    @if($isOpen)
        <div class="fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-50">
            <div class="bg-white p-8 rounded shadow-md w-1/3">
                <h2 class="text-xl mb-4">{{ $isEdit ? 'Editar Proveedor' : 'Nuevo Proveedor' }}</h2>

                <div class="mb-4">
                    <input wire:model="nombre" type="text" placeholder="Nombre" class="w-full border rounded px-4 py-2">
                    @error('nombre') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <input wire:model="apellido" type="text" placeholder="Apellido" class="w-full border rounded px-4 py-2">
                    @error('apellido') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <input wire:model="compañía" type="text" placeholder="Compañía" class="w-full border rounded px-4 py-2">
                    @error('compañía') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <input wire:model="numero" type="text" placeholder="Número" class="w-full border rounded px-4 py-2">
                    @error('numero') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-4">
                    <button wire:click="$set('isOpen', false)" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                        Cancelar
                    </button>
                    <button wire:click="save" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    @endif

</div>

