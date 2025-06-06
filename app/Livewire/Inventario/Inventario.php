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
    public $fecha_inicio;
    public $modalConfirmarEliminacion = false;

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
                            ->paginate(5); 
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
        $productos = Producto::findOrFail($id);

        $this->productoId = $productos->id; 
        $this->nombreProducto = $productos->nombreProducto;
        $this->descripcion = $productos->descripcion;
        $this->marca_id = $productos->marca_id;
        $this->categoria_id = $productos->categoria_id;
        $this->precio_producto = $productos->precio_producto; 
        $this->cantidadstock = $productos->cantidadstock; 
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

    public function confirmarEliminacion($id)
    {
        $this->producto_id = $id;
        $this->modalConfirmarEliminacion = true; 
    }

    public function eliminarProducto()
    {
       Producto::findOrFail($this->producto_id)->delete();
        session()->flash('mensaje', 'Producto eliminado exitosamente.');
        $this->cerrarModal();
    }

    public function cerrarModal()
    {
        $this->reset(['image_path', 'nombreProducto', 'descripcion', 'codigo_barras', 'cantidadstock', 'fecha_vencimiento', 'precio_producto', 'unidad_medida_id', 'marca_id', 'categoria_id', 'producto_id', 'modal', 'modalConfirmarEliminacion']);
        $this->resetErrorBag();
    }
}