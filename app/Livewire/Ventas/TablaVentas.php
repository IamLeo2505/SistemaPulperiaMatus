<?php

namespace App\Livewire\Ventas;

use Livewire\Component;
use App\Models\Venta;

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
                        $q->where('nombre', 'like', '%' . $this->searchTerm . '%');
                    });
                } elseif ($this->searchField === 'empleado') {
                    $query->whereHas('empleado', function ($q) {
                        $q->where('nombre', 'like', '%' . $this->searchTerm . '%');
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
            $venta = Venta::findOrFail($this->idVentaAEliminar);

            $venta->detalles()->delete();

            $venta->delete();

            $this->reset(['idVentaAEliminar', 'mostrarConfirmacion']);
            session()->flash('message', 'Venta eliminada correctamente.');
        }
    }
}