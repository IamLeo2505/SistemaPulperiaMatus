<?php

namespace App\Livewire\Inventario;


use Livewire\Component;
use App\Models\Categoria; 
use Livewire\WithPagination;

class Categorias extends Component
{
    use WithPagination;

    public $nombre_categoria, $categoria_id;
    public $modal = false;
    public $modalConfirmarEliminacion = false;
    protected $rules = [
        'nombre_categoria' => 'required|string|max=45'
    ];

    public function render()
    {
        $query = Categoria::query();

        $categorias = $query->orderBy('id', 'ASC')
                            ->paginate(5);
        return view('livewire.inventario.Categoria.categorias', [
            'categorias' => Categoria::latest()->paginate(perPage: 10)
        ]);
    }

    public function abrirModalCrear()
    {
        $this->reset(['nombre_categoria', 'categoria_id']);
        $this->modal = true;
    }

    public function abrirModalEditar($id)
    {
        $categorias = Categoria::findOrFail($id);
        $this->categoria_id = $categorias->id;
        $this->nombre_categoria = $categorias->nombre_categoria;
        $this->modal = true;
    }
    
    public function guardarCategoria()
    {
        $this->validate([
            'nombre_categoria' => 'required|string|max:255',
        ]);

        Categoria::updateOrCreate(
            ['id' => $this->categoria_id],
            ['nombre_categoria' => $this->nombre_categoria]
        );


        $this->reset('nombre_categoria');
        if ($this->categoria_id) {
            session()->flash('mensaje', 'Categoria actualizada exitosamente.');
        } else {
            session()->flash('mensaje', 'Categoria agregada exitosamente.');
        }
    
        $this->cerrarModal();
    }

    public function confirmarEliminacion($id)
    {
        $this->categoria_id = $id;
        $this->modalConfirmarEliminacion = true;
    }

    public function eliminar()
    {
        Categoria::findOrFail($this->categoria_id)->delete();
        session()->flash('mensaje', 'Categoria eliminada exitosamente.');
        $this->cerrarModal();
    }

    public function cerrarModal()
    {
        $this->reset(['nombre_categoria', 'categoria_id', 'modal', 'modalConfirmarEliminacion']);
        $this->resetErrorBag();
    }
    
}
