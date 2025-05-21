<?php

namespace App\Livewire\Inventario;

use App\Models\Unidad_Medida;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;

class CrearProducto extends Component
{
    use WithFileUploads;

    public $nombreProducto, $descripcion, $codigo_barras, $cantidadstock, $fechavencimiento;
    public $precio_producto, $categoria_id, $unidad_medida_id, $marca_id;
    public $image_path;

    public function rules()
    {
        return [
            'nombreProducto' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:100',
            'codigo_barras' => 'required|string|max:45|unique:productos,codigo_barras',
            'cantidadstock' => 'required|integer|min:0',
            'fechavencimiento' => 'nullable|date',
            'precio_producto' => 'required|numeric|min:0',
            'unidad_medida_id' => 'required|exists:unidades_medidas,id',
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'required|exists:marcas,id',
            'image_path' => 'nullable|image|max:2048',
        ];
    }

    public function guardar()
    {
        $this->validate();

        $path = $this->image_path ? $this->image_path->store('productos', 'public') : null;

        Producto::create([
            'nombreProducto' => $this->nombreProducto,
            'descripcion' => $this->descripcion,
            'codigo_barras' => $this->codigo_barras,
            'cantidadstock' => $this->cantidadstock,
            'fechavencimiento' => $this->fechavencimiento,
            'precio_producto' => $this->precio_producto,
            'unidad_medida_id' => $this->unidad_medida_id,
            'categoria_id' => $this->categoria_id,
            'marca_id' => $this->marca_id,
            'image_path' => $path,
        ]);

        session()->flash('mensaje', 'Producto agregado exitosamente.');
        return redirect()->route('inventario');
    }

    public function render()
    {
        return view('livewire.inventario.crear-producto', [
            'unidades' => Unidad_Medida::all(),
            'categorias' => Categoria::all(),
            'marcas' => Marca::all(),
        ]);
    }
}
