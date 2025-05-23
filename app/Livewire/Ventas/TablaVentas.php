<?php

namespace App\Livewire\Ventas;

use Livewire\Component;
use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Support\Facades\Log;

class TablaVentas extends Component
{
    public $idVentaAEliminar = null;
    public $mostrarConfirmacion = false;
    public $mostrarModalDetalle = false;
    public $ventaSeleccionada = null;
    public $searchTerm = '';
    public $searchField = 'nventa';

    protected $listeners = [
        'filtroActualizado' => 'actualizarFiltro',
        'ventaActualizada' => '$refresh',
    ];

    public function actualizarFiltro($data)
    {
        $this->searchTerm = $data['termino'];
        $this->searchField = $data['filtro'];
    }

    public function render()
    {
        $ventas = Venta::with(['cliente', 'empleado', 'detalles.producto'])
            ->when($this->searchTerm, function ($query) {
                if (in_array($this->searchField, ['nventa', 'total', 'iva', 'subtotal'])) {
                    $query->where($this->searchField, 'like', '%' . $this->searchTerm . '%');
                } elseif ($this->searchField === 'cliente') {
                    $query->whereHas('cliente', function ($q) {
                        $q->where('nombreCliente', 'like', '%' . $this->searchTerm . '%');
                    });
                } elseif ($this->searchField === 'empleado') {
                    $query->whereHas('empleado', function ($q) {
                        $q->where('nombreEmpleado', 'like', '%' . $this->searchTerm . '%');
                    });
                }
            })
            ->orderByDesc('id')
            ->get();

        return view('livewire.ventas.tabla-ventas', [
            'ventas' => $ventas,
        ]);
    }

    public function verDetalle($id)
    {
        $this->ventaSeleccionada = Venta::with([
            'cliente',
            'empleado',
            'detalles.producto'
        ])->findOrFail($id);

        $this->mostrarModalDetalle = true;
    }

    public function cerrarModalDetalle()
    {
        $this->mostrarModalDetalle = false;
        $this->ventaSeleccionada = null;
    }

    public function solicitarConfirmacion($id)
    {
        Log::info('Solicitando confirmación para eliminar venta: ', ['id' => $id]);
        $this->idVentaAEliminar = $id;
        $this->mostrarConfirmacion = true;
    }

    public function cancelarEliminacion()
    {
        $this->reset(['idVentaAEliminar', 'mostrarConfirmacion']);
    }
    public function eliminarVenta()
    {
        if ($this->idVentaAEliminar) {
            try {
                $venta = Venta::with('detalles')->findOrFail($this->idVentaAEliminar);

                // Restaurar el stock de los productos
                foreach ($venta->detalles as $detalle) {
                    $producto = Producto::find($detalle->producto_id);
                    if ($producto) {
                        $producto->increment('cantidadstock', $detalle->cantidad);
                    }
                }

                // Eliminar los detalles de la venta
                $venta->detalles()->delete();

                // Eliminar la venta
                $venta->delete();

                $this->reset(['idVentaAEliminar', 'mostrarConfirmacion']);
                session()->flash('message', 'Venta eliminada correctamente.');
            } catch (\Exception $e) {
                session()->flash('error', 'Error al eliminar la venta: ' . $e->getMessage());
                Log::error('Error al eliminar venta: ', ['error' => $e->getMessage()]);
            }
        }
    }
}