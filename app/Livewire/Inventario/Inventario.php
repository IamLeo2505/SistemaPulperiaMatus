<?php

namespace App\Livewire\Inventario;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Carbon\Carbon;

class Inventario extends Component
{
    public $productos, $categorias, $marcas;
    public $nombreProducto, $categoria_id, $marca_id, $precio_producto, $cantidadstock;
    public $productoId, $isEditing = false;
    public $abrirModal = false;
    public $idProductoAEliminar = null;
    public $AgregarStockModal = false;
    public $productoSeleccionado;
    public $cantidadAgregar=1;
    public $fecha_inicio;
    public $showEliminarModal = false;

    public $fecha_fin;
    

    public function render()
    {
        $this->productos = Producto::with('categoria', 'marca')->get();
        $query = Producto::query();

        if ($this->fecha_inicio && $this->fecha_fin) {
            $query->whereBetween('created_at', [
                Carbon::parse($this->fecha_inicio)->startOfDay(),
                Carbon::parse($this->fecha_fin)->endOfDay(),
            ]);
        }

        $productos = $query->with(['unidad_medida', 'categoria', 'marca'])->get();
        

        return view('livewire.inventario.inventario', compact('productos'));
    }

    public function abrirModalEditar($id)
{
    $producto = Producto::findOrFail($id);

    $this->producto_id = $producto->id;
    $this->nombreProducto = $producto->nombreProducto;
    $this->descripcion = $producto->descripcion;
    $this->marca_id = $producto->marca_id;
    $this->categoria_id = $producto->categoria_id;

    $this->esModalEditar = true;
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
    }
     public function mount()
    {
        $this->categorias = Categoria::all();
        $this->marcas = Marca::all();
        $this->productos = Producto::all();
    }
   
 public function abrirModalCrear()
    {
        $this->resetCampos();
        $this->abrirModal = true;
        $this->isEditing = false;
    }

    public function editProducto($id)
    {
        $producto = Producto::findOrFail($id);

        $this->nombreProducto = $producto->nombreProducto;
        $this->categoria_id = $producto->categoria_id;
        $this->marca_id = $producto->marca_id;
        $this->precio_producto = $producto->precio_producto;
        $this->cantidadstock = $producto->cantidadstock;
        $this->productoId = $producto->id;
        $this->isEditing = true;
        $this->abrirModal = true;
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

        $this->productoSeleccionado->stock += $this->cantidadAgregar;
        $this->productoSeleccionado->save();

        session()->flash('message', 'Stock actualizado correctamente.');
        $this->OpenAgregarStockModal = false;
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
            session()->flash('message', 'Producto actualizado correctamente.');
        } else {
            Producto::create([
                'nombreProducto' => $this->nombreProducto,
                'categoria_id' => $this->categoria_id,
                'marca_id' => $this->marca_id,
                'precio_producto' => $this->precio_producto,
                'cantidadstock' => $this->cantidadstock,
            ]);
            session()->flash('message', 'Producto registrado correctamente.');
        }

        $this->abrirModal = false;
        $this->resetCampos();
    }
     public function SolicitarConfirmacion($id)
    {
        $this->idProductoAEliminar = $id;
        $this->mostrarConfirmacion = true;
    }

    public function cancelarEliminacion()
    {
        $this->idProductoAEliminar = null;
        $this->mostrarConfirmacion = false;
    }


   
}


