<?php

namespace App\Livewire\Compras;

use Livewire\Component;
use App\Models\Compra;

class Compras extends Component
{
    public $comprasFiltradas = [];
    public $mostrarConfirmacion = false;
    public $compraAEliminar = null;

    protected $listeners = ['filtroActualizado' => 'actualizarFiltro'];
    public $termino = '';
    public $filtro = 'ncompra';

    public $compras, $ncompra, $fecha, $subtotal, $iva, $descuento, $total, $compra_id;
    public $modalAbierto = false;
    public $modoEdicion = false;

    public function propiedadesCompras()
    {
        $campo = $this->filtro;
        $termino = '%' . $this->termino . '%';

        return Compra::where($campo, 'like', $termino)->get();
    }

    public function mount()
    {
        $this->comprasFiltradas = Compra::with('proveedor')->get();
    }

    public function actualizarFiltro($data)
    {
        $this->filtro = $data['filtro'];
        $this->termino = $data['termino'];
        $this->comprasFiltradas = $this->propiedadesCompras();
    }

    public function render()
    {
        return view('livewire.compras.compras', [
            'compras' => $this->comprasFiltradas
        ]);
    }

    public function abrirModal()
    {
        $this->resetCampos();
        $this->modoEdicion = false;
        $this->modalAbierto = true;
    }

    public function cerrarModal()
    {
        $this->modalAbierto = false;
    }

    public function resetCampos()
    {
        $this->reset(['ncompra', 'fecha', 'subtotal', 'iva', 'descuento', 'total']);
        $this->modoEdicion = false;
    }

    public function guardarCompra()
    {
        $this->validate([
            'ncompra' => 'required|string',
            'fecha' => 'required|date',
            'subtotal' => 'required|numeric',
            'iva' => 'required|numeric',
            'descuento' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        Compra::create([
            'ncompra' => $this->ncompra,
            'fecha' => $this->fecha,
            'subtotal' => $this->subtotal,
            'iva' => $this->iva,
            'descuento' => $this->descuento,
            'total' => $this->total,
        ]);

        session()->flash('mensaje', 'Compra creada correctamente.');
        $this->cerrarModal();
        $this->resetCampos();
        $this->dispatch('compraActualizada');
    }

    public function actualizarCompra()
    {
        $this->validate([
            'ncompra' => 'required|string',
            'fecha' => 'required|date',
            'subtotal' => 'required|numeric',
            'iva' => 'required|numeric',
            'descuento' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        $compra = Compra::find($this->compra_id);
        $compra->update([
            'ncompra' => $this->ncompra,
            'fecha' => $this->fecha,
            'subtotal' => $this->subtotal,
            'iva' => $this->iva,
            'descuento' => $this->descuento,
            'total' => $this->total,
        ]);

        session()->flash('mensaje', 'Compra actualizada correctamente.');
        $this->resetCampos();
        $this->cerrarModal();
        $this->dispatch('compraActualizada');
    }

    public function eliminar($id)
    {
        $compra = Compra::findOrFail($id);

        // Si tiene detalles relacionados
        $compra->detalles()->delete();

        $compra->delete();

        session()->flash('mensaje', 'Compra eliminada correctamente.');
        $this->comprasFiltradas = Compra::with('proveedor')->get();
    }
}
