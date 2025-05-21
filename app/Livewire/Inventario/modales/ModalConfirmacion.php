<?php

namespace App\Livewire\Inventario;

use Livewire\Component;
use App\Models\Producto;

class ModalConfirmacion extends Component
{
    public $idProductoAEliminar = null;
    public $mostrarConfirmacion = false;
    public $mostrarModalEditar = false;
    public $nombreProducto, $descripcion, $codigo_barras, $cantidadstock, $fechavencimiento, $precio_producto, $idProductoAEditar;
    public $searchTerm = '';
    public $searchField = 'nombreProducto';

    protected $listeners = [
        'productoActualizado' => '$refresh',
        'filtroActualizado' => 'actualizarFiltro'
    ];

    public function actualizarFiltro($data)
    {
        $this->searchTerm = $data['termino'];
        $this->searchField = $data['filtro'];
    }


public function abrirModalEditar($id)
{
    $producto = Producto::findOrFail($id);

    $this->idProductoAEditar = $producto->id;
    $this->image_path = $producto->image_path;
    $this->nombreProducto = $producto->nombreProducto;
    $this->descripcion = $producto->descripcion;
    $this->codigo_barras = $producto->codigo_barras;
    $this->cantidadstock = $producto->cantidadstock;
    $this->fechavencimiento = $producto->fechavencimiento;
    $this->precio_producto = $producto->precio_producto;

    $this->mostrarModalEditar = true;
    $this->dispatch('modalOpen'); // Enviar evento para abrir el modal
}


public function cerrarModalEditar()
{
    $this->mostrarModalEditar = false;
    $this->reset(['idProductoAEditar', 'nombreProducto', 'descripcion', 'codigo_barras', 'cantidadstock', 'fechavencimiento', 'precio_producto']);
    $this->dispatch('modalClose'); // Cerrar modal después de resetear
}



public function guardarProducto()
{
    $this->validate([
        'nombreProducto' => 'required|string|max:255',
        'descripcion' => 'required|string|max:255',
        'codigo_barras' => 'required|numeric',
        'cantidadstock' => 'required|numeric',
        'fechavencimiento' => 'required|date',
        'precio_producto' => 'required|decimal'
    ]);

    $producto = Producto::find($this->idProductoAEditar);
    $producto->update([
        'nombreProducto' => $this->nombreProducto,
        'descripcion' => $this->descripcion,
        'codigo_barras' => $this->codigo_barras,
        'cantidadstock' => $this->cantidadstock,
        'fechavencimiento' => $this->fechavencimiento,
        'precio_producto' => $this->precio_producto
    ]);

    session()->flash('message', 'Producto actualizado exitosamente.');

    $this->cerrarModalEditar();
}

    public function solicitarConfirmacion($id)
    {
        $this->idProductoAEliminar = $id;
        $this->mostrarConfirmacion = true;
    }

    public function cancelarEliminacion()
    {
        $this->idProductoAEliminar = null;
        $this->mostrarConfirmacion = false;
    }


    public function eliminarProducto()
    {
        if ($this->idProductoAEliminar) {
            Producto::findOrFail($this->idProductoAEliminar)->delete();
            $this->reset(['idProductoAEliminar', 'mostrarConfirmacion']);
            session()->flash('message', 'Producto eliminado correctamente.');
        }
    }
}
