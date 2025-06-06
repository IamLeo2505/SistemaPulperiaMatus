<div class="overflow-hidden rounded-3xl shadow-lg mt-8 mb-8">
    @if ($ventas->isEmpty())
        <div class="flex flex-col items-center justify-center text-gray-500 p-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.75 9.75h.008v.008H9.75V9.75zm0 4.5h.008v.008H9.75v-.008zm4.5-4.5h.008v.008H14.25V9.75zm0 4.5h.008v.008H14.25v-.008zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-lg font-semibold">No se encontraron ventas con ese criterio.</p>
        </div>
    @else
        <table class="table w-full">
            <thead class="bg-[#004173] text-white">
                <tr>
                    <th>N° Venta</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Subtotal</th>
                    <th>IVA</th>
                    <th>Descuento</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $index => $venta)
                <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-100' }} text-gray-800">
                    <td>{{ $venta->nventa }}</td>
                    <td>{{ $venta->fecha ?? 'N/A' }}</td>
                    <td>{{ $venta->cliente->nombreCliente ?? 'N/A' }} {{ $venta->cliente->apellidoCliente ?? 'N/A' }}</td>
                    <td>${{ number_format($venta->subtotal, 2) }}</td>
                    <td>${{ number_format(($venta->iva/100) * ($venta->subtotal - ($venta->descuento * $venta->subtotal)/100), 2) }}</td>
                    <td>${{ number_format(($venta->descuento * $venta->subtotal)/100, 2) }}</td>
                    <td>${{ number_format($venta->total, 2) }}</td>
                    <td class="px-4 py-2">
                        <div class="flex items-center gap-10">
                            <button
                                wire:click="verDetalle({{ $venta->id }})" class="text-blue-600 hover:text-blue-800" title="Ver Detalles">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-2.075 0-4.005-.676-5.542-1.823" />
                                </svg>
                            </button>

                            <button wire:click="solicitarConfirmacion({{ $venta->id }})"
                                class="text-red-600 hover:text-red-800" title="Eliminar">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block">
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

    {{-- Modal de Confirmación de Eliminación --}}
    <input type="checkbox" id="modal-confirmacion" class="modal-toggle" {{ $mostrarConfirmacion ? 'checked' : '' }} />
    <div class="modal" role="dialog">
        <div class="modal-box text-black bg-white">
            <h3 class="font-bold text-lg mb-4">Confirmar Eliminación</h3>
            <p>¿Está seguro de que desea eliminar esta venta? Esta acción no se puede deshacer.</p>
            <div class="flex justify-end gap-4 mt-4">
                <button wire:click="cancelarEliminacion" class="bg-gray-500 text-white px-4 py-2 rounded-md">Cancelar</button>
                <button wire:click="eliminarVenta" class="bg-red-600 text-white px-4 py-2 rounded-md">Eliminar</button>
            </div>
        </div>
    </div>

    {{-- Modal de Detalles --}}
    <input type="checkbox" id="modal-detalle" class="modal-toggle" {{ $mostrarModalDetalle ? 'checked' : '' }} />
    <div class="modal" role="dialog">
        <div class="modal-box text-black bg-white max-w-4xl">
            <h3 class="font-bold text-lg mb-4">Detalles de Venta</h3>
            @if ($ventaSeleccionada)
                <div class="mb-4">
                    <p><strong>Venta N°:</strong> {{ $ventaSeleccionada->nventa }}</p>
                    <p><strong>Empleado:</strong> {{ $ventaSeleccionada->empleado->nombreEmpleado ?? 'N/A' }} {{ $ventaSeleccionada->empleado->apellidoEmpleado ?? 'N/A' }}</p>
                    <p><strong>Cliente:</strong> {{ $ventaSeleccionada->cliente->nombreCliente ?? 'N/A' }} {{ $ventaSeleccionada->cliente->apellidoCliente ?? 'N/A' }}</p>
                    <p><strong>Fecha:</strong> {{ $ventaSeleccionada->fecha ?? 'N/A' }}</p>
                </div>

                <table class="table w-full mb-4">
                    <thead class="bg-gray-700 text-white">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                            <th>IVA ($)</th>
                            <th>Descuento ($)</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventaSeleccionada->detalles as $index => $detalle)
                            <tr class="{{ $index % 2 === 0 ? 'bg-gray-100' : 'bg-white' }} text-gray-800">
                                <td>{{ $detalle->producto->nombreProducto ?? 'Producto desconocido' }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>${{ number_format($detalle->precio, 2) }}</td>
                                <td>${{ number_format($detalle->subtotal, 2) }}</td>
                                <td>${{ number_format($detalle->total - ($detalle->subtotal - (($detalle->descuento * $detalle->subtotal)/100)), 2) }}</td>
                                <td>${{ number_format(($detalle->descuento * $detalle->subtotal)/100, 2) }}</td>
                                <td>${{ number_format($detalle->total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <div class="flex justify-end">
                <button wire:click="cerrarModalDetalle" class="bg-gray-600 text-white px-4 py-2 rounded-md">Cerrar</button>
            </div>
        </div>
    </div>
</div>