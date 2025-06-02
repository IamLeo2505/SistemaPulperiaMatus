<?php

namespace App\Livewire\Ventas;

use Livewire\Component;
use App\Models\Venta;
use App\Models\Producto;

class Facturacion extends Component
{
    public $ventasFiltradas = [];
    public $termino = '';
    public $filtro = 'nventa';

    protected $listeners = ['filtroActualizado' => 'actualizarFiltro'];

    public function propiedadesVentas()
    {
        $campo = $this->filtro;
        $termino = '%' . $this->termino . '%';

        $query = Venta::with(['cliente', 'empleado', 'detalles.producto']);

        if ($this->termino) {
            if (in_array($campo, ['nventa', 'fecha'])) {
                $query->where($campo, 'like', $termino);
            } elseif ($campo === 'cliente') {
                $query->whereHas('cliente', function ($q) use ($termino) {
                    $q->where('nombreCliente', 'like', $termino)
                      ->orWhere('apellidoCliente', 'like', $termino);
                });
            }
        }

        return $query->orderByDesc('id')->get();
    }

    public function mount()
    {
        $this->ventasFiltradas = Venta::with(['cliente', 'empleado', 'detalles.producto'])->get();
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

    public function eliminar($id)
    {
        try {
            $venta = Venta::with('detalles')->findOrFail($id);

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

            session()->flash('mensaje', 'Venta eliminada correctamente.');
            $this->ventasFiltradas = $this->propiedadesVentas();
            $this->dispatch('ventaActualizada');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar la venta: ' . $e->getMessage());
        }
    }
}