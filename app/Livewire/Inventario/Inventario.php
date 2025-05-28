<?php

namespace App\Livewire\Inventario;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Carbon\Carbon;
use Livewire\WithPagination; 

class Inventario extends Component
{
    use WithPagination;

    public $categorias, $marcas;

    public $nombreProducto, $categoria_id, $marca_id, $precio_producto, $cantidadstock;
    public $productoId, $isEditing = false;
    public $abrirModal = false;
    public $idProductoAEliminar = null;
    public $AgregarStockModal = false;
    public $productoSeleccionado;
    public $cantidadAgregar = 1;
    public $fecha_inicio;
    public $showEliminarModal = false; 

    public $fecha_fin;

    public $termino = ''; 
    public $filtro = 'nombreProducto'; 

    protected $paginationTheme = 'tailwind'; 

    public function render()
    {
        $query = Producto::query();

        // Aplicar filtro de búsqueda si el término no está vacío
        if (!empty($this->termino)) {
            $query->where($this->filtro, 'LIKE', '%' . $this->termino . '%');
        }

        if ($this->fecha_inicio && $this->fecha_fin) {
            $query->whereBetween('created_at', [
                Carbon::parse($this->fecha_inicio)->startOfDay(),
                Carbon::parse($this->fecha_fin)->endOfDay(),
            ]);
        }

        $productos = $query->with(['unidad_medida', 'categoria', 'marca'])
                            ->orderBy('id', 'ASC') 
                            ->paginate(6); 
        return view('livewire.inventario.inventario', [
            'productos' => $productos, 
        ]);
    }

    public function mount()
    {
        $this->categorias = Categoria::all();
        $this->marcas = Marca::all();
        
    }

    public function buscar()
    {
        $this->resetPage(); 
    }

    public function abrirModalEditar($id)
    {
        $producto = Producto::findOrFail($id);

        $this->productoId = $producto->id; 
        $this->nombreProducto = $producto->nombreProducto;
        $this->descripcion = $producto->descripcion;
        $this->marca_id = $producto->marca_id;
        $this->categoria_id = $producto->categoria_id;
        $this->precio_producto = $producto->precio_producto; 
        $this->cantidadstock = $producto->cantidadstock; 

        $this->isEditing = true; 
        $this->abrirModal = true;
    }

    public function resetCampos()
    {
        $this->nombreProducto = '';
        $this->categoria_id = '';
        $this->marca_id = '';
        $this->precio_producto = '';
        $this->cantidadstock = '';
        $this->productoId = null;
        $this->isEditing = false; 
    }

    public function abrirModalCrear()
    {
        $this->resetCampos();
        $this->abrirModal = true;
        $this->isEditing = false;
    }

    public function editProducto($id)
    {
        $this->abrirModalEditar($id);
    }

    public function OpenAgregarStockModal($productoId)
    {
        $this->productoSeleccionado = Producto::find($productoId);
        $this->cantidadAgregar = 1;
        $this->AgregarStockModal = true;
    }

    public function agregarStock()
    {
        $this->validate([
            'cantidadAgregar' => 'required|integer|min:1',
        ]);

        $this->productoSeleccionado->cantidadstock += $this->cantidadAgregar; 
        $this->productoSeleccionado->save();

        session()->flash('mensaje', 'Stock actualizado correctamente.'); 
        $this->AgregarStockModal = false; 
        $this->dispatch('close-modal'); 
    }

    public function saveProducto()
    {
        $this->validate([
            'nombreProducto' => 'required|string|max:100',
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'required|exists:marcas,id',
            'precio_producto' => 'required|numeric|min:0',
            'cantidadstock' => 'required|integer|min:0',
        ]);

        if ($this->isEditing) {
            Producto::find($this->productoId)->update([
                'nombreProducto' => $this->nombreProducto,
                'categoria_id' => $this->categoria_id,
                'marca_id' => $this->marca_id,
                'precio_producto' => $this->precio_producto,
                'cantidadstock' => $this->cantidadstock,
            ]);
            session()->flash('mensaje', 'Producto actualizado correctamente.');
        } else {
            Producto::create([
                'nombreProducto' => $this->nombreProducto,
                'categoria_id' => $this->categoria_id,
                'marca_id' => $this->marca_id,
                'precio_producto' => $this->precio_producto,
                'cantidadstock' => $this->cantidadstock,
            ]);
            session()->flash('mensaje', 'Producto registrado correctamente.');
        }

        $this->abrirModal = false;
        $this->resetCampos();
    }

    public function SolicitarConfirmacion($id)
    {
        $this->idProductoAEliminar = $id;
        $this->showEliminarModal = true; 
    }

    public function cancelarEliminacion()
    {
        $this->idProductoAEliminar = null;
        $this->showEliminarModal = false;
    }

    public function eliminarProducto()
    {
        if ($this->idProductoAEliminar) {
            Producto::find($this->idProductoAEliminar)->delete();
            session()->flash('mensaje', 'Producto eliminado correctamente.');
            $this->showEliminarModal = false;
            $this->idProductoAEliminar = null;
        }
    }
}