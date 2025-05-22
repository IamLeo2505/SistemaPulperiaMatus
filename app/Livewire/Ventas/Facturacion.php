<?php

namespace App\Livewire\Ventas;

use Livewire\Component;
use App\Models\Venta;

class Facturacion extends Component
{
    public $ventasFiltradas = [];
    public $mostrarConfirmacion = false;
    public $ventaAEliminar = null;

    protected $listeners = ['filtroActualizado' => 'actualizarFiltro'];
    public $termino = '';
    public $filtro = 'nventa';

    public $ventas, $nventa, $fecha, $subtotal, $iva, $descuento, $total, $venta_id;
    public $modalAbierto = false;
    public $modoEdicion = false;

    public function propiedadesVentas()
    {
        $campo = $this->filtro;
        $termino = '%' . $this->termino . '%';

        return Venta::where($campo, 'like', $termino)->get();
    }

    public function mount()
    {
        $this->ventasFiltradas = Venta::with('cliente')->get();
    }

    public function actualizarFiltro($data)
    {
        $this->filtro = $data['filtro'];
        $this->termino = $data['termino'];
        $this->ventasFiltradas = $this->propiedadesVentas();
    }

    public function render()
    {
        return view('livewire.ventas.facturacion', [
            'ventas' => $this->ventasFiltradas
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
        $this->reset(['nventa', 'fecha', 'subtotal', 'iva', 'descuento', 'total']);
        $this->modoEdicion = false;
    }

    public function guardarVenta()
    {
        $this->validate([
            'nventa' => 'required|string',
            'fecha' => 'required|date',
            'subtotal' => 'required|numeric',
            'iva' => 'required|numeric',
            'descuento' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        Venta::create([
            'nventa' => $this->nventa,
            'fecha' => $this->fecha,
            'subtotal' => $this->subtotal,
            'iva' => $this->iva,
            'descuento' => $this->descuento,
            'total' => $this->total,
        ]);

        session()->flash('mensaje', 'Venta creada correctamente.');
        $this->cerrarModal();
        $this->resetCampos();
        $this->dispatch('ventaActualizada');
    }

    public function actualizarVenta()
    {
        $this->validate([
            'nventa' => 'required|string',
            'fecha' => 'required|date',
            'subtotal' => 'required|numeric',
            'iva' => 'required|numeric',
            'descuento' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        $venta = Venta::find($this->venta_id);
        $venta->update([
            'nventa' => $this->nventa,
            'fecha' => $this->fecha,
            'subtotal' => $this->subtotal,
            'iva' => $this->iva,
            'descuento' => $this->descuento,
            'total' => $this->total,
        ]);

        session()->flash('mensaje', 'Venta actualizada correctamente.');
        $this->resetCampos();
        $this->cerrarModal();
        $this->dispatch('ventaActualizada');
    }

    public function eliminar($id)
    {
        $venta = Venta::findOrFail($id);

        // Si tiene detalles relacionados
        $venta->detalles()->delete();

        $venta->delete();

        session()->flash('mensaje', 'Venta eliminada correctamente.');
        $this->ventasFiltradas = Venta::with('cliente')->get();
    }
}