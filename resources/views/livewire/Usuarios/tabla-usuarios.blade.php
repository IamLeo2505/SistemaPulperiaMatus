<div class="overflow-hidden rounded-xl shadow-lg mt-8 mb-8">
    @if ($usuarios->isEmpty())
        <div class="flex flex-col items-center justify-center text-gray-500 p-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.75 9.75h.008v.008H9.75V9.75zm0 4.5h.008v.008H9.75v-.008zm4.5-4.5h.008v.008H14.25V9.75zm0 4.5h.008v.008H14.25v-.008zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-lg font-semibold">No se encontraron usuarios con ese criterio.</p>
        </div>
    @else
        <table class="table w-full">
            <thead class="bg-[#004173] text-white">
                <tr>
                    <th>Nombre Usuario</th>
                    <th>Contraseña</th>
                    <th>Foto de Perfil</th>
                    <th>Correo Electrónico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $index => $usuario)
                    <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-200' }} text-gray-800">
                        <td>{{ $usuario->user }}</td>
                        <td>********</td>
                        <td class="px-10 py-2">
                            <div class="flex items-align-center gap-10">
                            @if ($usuario->image_path_Usuarios)
                                <button
                                    wire:click="abrirModalImagen({{ $usuario->id }})"
                                    class="text-blue-600 hover:text-blue-800" 
                                    title="Mostrar Imagen">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                </button>
                            @else
                                <span class="text-gray-400 italic">Sin imagen</span>
                            @endif
                            </div>
                        </td>
                        <td>{{ $usuario->empleado ? $usuario->empleado->correoEmpleado : 'No asignado' }}</td>
                        <td class="px-4 py-2">
                            <div class="flex items-center gap-10">
                                <button 
                                    wire:click="abrirModalEditar({{ $usuario->id }})"
                                    class="text-blue-600 hover:text-blue-800" 
                                    title="Editar">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>
                                <button wire:click="solicitarConfirmacion({{ $usuario->id }})" class="text-red-600 hover:text-red-800" title="Eliminar">
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

    <!-- Modal de edición -->
    <input type="checkbox" id="modal-editar" class="modal-toggle" {{ $mostrarModalEditar ? 'checked' : '' }} />
    <div class="modal" role="dialog">
        <div class="modal-box text-black bg-[#ffffff]">
            <h3 class="font-bold text-lg">Editar Usuario</h3>
            <form wire:submit.prevent="guardarUsuario">
                <div class="mb-4">
                    <label for="user" class="block text-sm font-medium text-gray-700">Nombre de Usuario</label>
                    <input wire:model="user" type="text" id="user" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    @error('user') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    @if ($showPassword)
                        <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <input wire:model="password" type="text" id="password" class="mt-1 block w-full border border-gray-300 rounded-md p-2"/>
                        <button type="button"
                                    wire:click="$toggle('showPassword')"
                                    class="text-black opacity-60 hover:opacity-100 transition duration-200">

                            @if (!$showPassword)
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-2.075 0-4.005-.676-5.542-1.823" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.27-2.944-9.544-7a9.956 9.956 0 011.419-2.645M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M3 3l18 18" />
                                </svg>
                            @endif
                        </button>
                    </div>
                    @else
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <input wire:model="password" type="password" id="password" class="mt-1 block w-full border border-gray-300 rounded-md p-2"/>
                        <button type="button"
                                    wire:click="$toggle('showPassword')"
                                    class="text-black opacity-60 hover:opacity-100 transition duration-200">

                            @if (!$showPassword)
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-2.075 0-4.005-.676-5.542-1.823" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.27-2.944-9.544-7a9.956 9.956 0 011.419-2.645M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M3 3l18 18" />
                                </svg>
                            @endif
                        </button>
                    </div>
                    @endif

                    @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    
                    
                </div>
                <div class="mb-4">
                    <label for="correoEmpleado" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                    <select wire:model="correoEmpleado" id="correoEmpleado" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                        <option value="">Seleccione un empleado</option>
                        @foreach ($empleados as $empleado)
                            <option value="{{ $empleado->correoEmpleado }}">{{ $empleado->correoEmpleado }}</option>
                        @endforeach
                    </select>
                    @error('correoEmpleado') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="image_path_Usuarios" class="block text-sm font-medium text-gray-700">Foto de Perfil</label>
                    <input wire:model.live="image_path_Usuarios" type="file" id="image_path_Usuarios" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    @if ($image_path_Usuarios)
                        <button type="button" wire:click="limpiarImagen" class="bg-red-500 text-white px-4 py-2 rounded">Eliminar imagen seleccionada</button>
                    @endif
                    @error('image_path_Usuarios') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end">
                    <button type="button" wire:click="cerrarModalEditar" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2">Cancelar</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de imagen -->
    <input type="checkbox" id="modal-imagen" class="modal-toggle" {{ $mostrarModalImagen ? 'checked' : '' }} />
    <div class="modal" role="dialog">
        <div class="modal-box text-black bg-[#ffffff] max-w-2xl">
            <h3 class="font-bold text-lg">Foto de Perfil</h3>
            @if ($image_path_Usuarios)
                <img src="{{ asset('storage/' . $image_path_Usuarios) . '?t=' . time() }}" alt="Foto de perfil" class="w-full h-auto rounded-md mt-4">
            @else
                <p class="text-gray-500 italic">No hay imagen disponible.</p>
            @endif
            <div class="flex justify-end mt-4">
                <button wire:click="cerrarModalImagen" class="bg-gray-500 text-white px-4 py-2 rounded-md">Cerrar</button>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación -->
    <input type="checkbox" id="modal-confirmacion" class="modal-toggle" {{ $mostrarConfirmacion ? 'checked' : '' }} />
    <div class="modal" role="dialog">
        <div class="modal-box text-white bg-[#004173]">
            <h3 class="font-bold text-lg">¿Seguro que deseas eliminar este usuario?</h3>
            <p class="py-4">Esta acción no se puede deshacer.</p>
            <div class="modal-action">
                <button wire:click="cancelarEliminacion" class="btn bg-gray-500 hover:bg-gray-600">Cancelar</button>
                <button wire:click="eliminarUsuario" class="btn btn-error text-white bg-red-600">Eliminar</button>
            </div>
        </div>
    </div>
</div>