<?php

namespace App\Livewire\Compras;

use Livewire\Component;
use App\Models\Compra;

class TablaCompras extends Component
{
    public $idCompraAEliminar = null;
    public $mostrarConfirmacion = false;
    public $mostrarModalDetalle = false;
    public $compraSeleccionada = null;
    public $searchTerm = '';
    public $searchField = 'ncompra';

    protected $listeners = [
        'filtroActualizado' => 'actualizarFiltro',
        'compraActualizada' => '$refresh',
    ];

    public function actualizarFiltro($data)
    {
        $this->searchTerm = $data['termino'];
        $this->searchField = $data['filtro'];
    }

    public function render()
    {
        $compras = Compra::with(['proveedor', 'empleado', 'detalles.producto', 'tiempo'])
            ->when($this->searchTerm, function ($query) {
                // Evita SQL error si el campo no existe
                if (in_array($this->searchField, ['ncompra', 'total', 'iva', 'subtotal'])) {
                    $query->where($this->searchField, 'like', '%' . $this->searchTerm . '%');
                } elseif ($this->searchField === 'proveedor') {
                    $query->whereHas('proveedor', function ($q) {
                        $q->where('nombreProveedor', 'like', '%' . $this->searchTerm . '%');
                    });
                } elseif ($this->searchField === 'empleado') {
                    $query->whereHas('empleado', function ($q) {
                        $q->where('nombre', 'like', '%' . $this->searchTerm . '%');
                    });
                }
            })
            ->orderByDesc('id') 
            ->get();

        return view('livewire.compras.tabla-compras', [
            'compras' => $compras,
        ]);
    }

    public function verDetalle($id)
    {
        $this->compraSeleccionada = Compra::with([
            'proveedor',
            'empleado',
            'tiempo',
            'detalles.producto'
        ])->findOrFail($id);

        $this->mostrarModalDetalle = true;
    }

    public function cerrarModalDetalle()
    {
        $this->mostrarModalDetalle = false;
        $this->compraSeleccionada = null;
    }

    public function solicitarConfirmacion($id)
    {
        $this->idCompraAEliminar = $id;
        $this->mostrarConfirmacion = true;
    }

    public function cancelarEliminacion()
    {
        $this->reset(['idCompraAEliminar', 'mostrarConfirmacion']);
    }

    public function eliminarCompra()
    {
        if ($this->idCompraAEliminar) {
            $compra = Compra::findOrFail($this->idCompraAEliminar);
            
            $compra->detalles()->delete();

            $compra->delete();

            $this->reset(['idCompraAEliminar', 'mostrarConfirmacion']);
            session()->flash('message', 'Compra eliminada correctamente.');
        }
    }
}
