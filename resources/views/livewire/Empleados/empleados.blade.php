<div class="p-4 relative">
    <h1 class="text-black font-bold mb-4">Gestión de Empleados</h1>

    @if (session()->has('mensaje'))
        <div class="bg-blue-200 p-2 rounded mb-4">{{ session('mensaje') }}</div>
    @endif

    <div>
        <livewire:empleados.barra-busqueda-empleados />
        <livewire:empleados.tabla-empleados />
        <button wire:click="abrirModal" class="fixed right-10 bottom-18 bg-blue-600 text-white px-4 py-2 rounded-2xl z-10">
            Agregar empleado
        </button>
    </div>

    <!-- Modal de creación/edición -->
    @if ($modalAbierto)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-full max-w-md p-6 rounded shadow-lg">
            <h2 class="text-black font-bold mb-4">
                {{ $modoEdicion ? 'Editar Empleado' : 'Nuevo Empleado' }}
            </h2>
            <form wire:submit.prevent="{{ $modoEdicion ? 'actualizarEmpleado' : 'guardarEmpleado' }}" class="space-y-3">
                <input type="text" wire:model="nombreEmpleado" placeholder="Nombre" class="w-full border rounded p-2 text-black">
                <input type="text" wire:model="apellidoEmpleado" placeholder="Apellido" class="w-full border rounded p-2 text-black">
                <input type="text" wire:model="correoEmpleado" placeholder="Correo" class="w-full border rounded p-2 text-black">
                <input type="text" wire:model="direccionEmpleado" placeholder="Dirección" class="w-full border rounded p-2 text-black">
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

    <!-- Modal de confirmación estándar -->
    @if ($mostrarConfirmacion)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-full max-w-md p-6 rounded shadow-lg">
            <h3 class="font-bold text-lg text-black">¿Seguro que deseas eliminar este empleado?</h3>
            <p class="py-4 text-black">Esta acción no se puede deshacer.</p>
            <div class="flex justify-end space-x-2">
                <button wire:click="cancelarEliminacion" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</button>
                <button wire:click="eliminar" class="bg-red-600 text-white px-4 py-2 rounded">Eliminar</button>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de advertencia por usuario asociado -->
    @if ($mostrarAdvertenciaUsuario)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-full max-w-md p-6 rounded shadow-lg">
            <h3 class="font-bold text-lg text-black">¡Advertencia!</h3>
            <p class="py-4 text-black">Este empleado tiene un usuario registrado. Eliminar al empleado también eliminará el usuario. ¿Estás seguro?</p>
            <div class="flex justify-end space-x-2">
                <button wire:click="cancelarEliminacion" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</button>
                <button wire:click="eliminar" class="bg-red-600 text-white px-4 py-2 rounded">Eliminar</button>
            </div>
        </div>
    </div>
    @endif
</div>