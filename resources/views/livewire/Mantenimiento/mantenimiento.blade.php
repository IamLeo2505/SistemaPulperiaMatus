<div class="p-4 relative">
    <h1 class="text-black font-bold mb-4">Mantenimiento de Base de Datos</h1>

    @if (session()->has('mensaje'))
        <div class="bg-blue-200 p-2 rounded mb-4">{{ session('mensaje') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-200 p-2 rounded mb-4">{{ session('error') }}</div>
    @endif

    <div class="flex flex-col space-y-4">
        <!-- Botón para crear copia de seguridad -->
        <button wire:click="crearCopiaSeguridad" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
            Crear Copia de Seguridad
        </button>

        <!-- Botón para abrir modal de restauración -->
        <button wire:click="abrirModalRestaurar" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
            Restaurar Copia de Seguridad
        </button>
    </div>

    <!-- Modal para restaurar copia -->
     @if ($mostrarModalRestaurar)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-full max-w-md p-6 rounded shadow-lg">
            <h2 class="text-black font-bold mb-4">Restaurar Copia de Seguridad</h2>
            <form wire:submit.prevent="restaurarCopiaSeguridad" enctype="multipart/form-data" class="space-y-3">
                <div>
                    <label for="archivoBackup" class="block text-sm font-medium text-gray-700">Seleccionar archivo (.sql o .zip)</label>
                    <input type="file" wire:model.live="archivoBackup" id="archivoBackup" class="mt-1 block w-full border border-gray-300 rounded-md p-2 text-black">
                    @if ($archivoBackup)
                        <button type="button" wire:click="limpiarArchivoBackup" class="mt-2 bg-red-500 text-white px-4 py-2 rounded">
                            Eliminar archivo seleccionado
                        </button>
                    @endif
                    @error('archivoBackup') 
                        <span class="text-red-500 text-xs">{{ $message }}</span> 
                    @enderror
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" wire:click="cerrarModalRestaurar" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Restaurar</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>