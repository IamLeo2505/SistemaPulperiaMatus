<div class="p-4 relative">
    <h1 class="text-black font-bold mb-4">Gestión de Usuarios</h1>

    @if (session()->has('mensaje'))
        <div class="blue-200 p-2 rounded mb-4">{{ session('mensaje') }}</div>
    @endif

    <div>
        <livewire:usuarios.barra-busqueda-usuarios />

        <livewire:usuarios.tabla-usuarios />

        <button wire:click="abrirModal" class="fixed right-10 bottom-18 bg-blue-600 text-white px-4 py-2 rounded-2xl z-10">
            Agregar usuario
        </button>
    </div>

    @if ($modalAbierto)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-full max-w-md p-6 rounded shadow-lg">
            <h2 class="text-black font-bold mb-4">
                {{ $modoEdicion ? 'Editar Usuario' : 'Nuevo Usuario' }}
            </h2>

            <form wire:submit.prevent="{{ $modoEdicion ? 'actualizarUsuario' : 'guardarUsuario' }}" class="space-y-3">
                <input type="text" wire:model="user" id="user" placeholder="Nombre Usuario" class="w-full border rounded p-2 text-black">
                <input type="text" wire:model="password" id="password" placeholder="Contraseña" class="w-full border rounded p-2 text-black">
                <select wire:model="correoEmpleado" id="correoEmpleado" class="w-full border rounded p-2 text-black">
                    <option value="">Seleccione un empleado</option>
                    @foreach ($usuarios as $empleado)
                        <option value="{{ $empleado->id }}">{{ $empleado->correoEmpleado }}</option>
                    @endforeach
                </select>
                <input type="file" wire:model="image_path_Usuarios" id="image_path_Usuarios" accept="image/jpeg,image/png,image/jpg" class="w-full border rounded p-2">

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