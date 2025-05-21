<?php

namespace App\Livewire\Inventario;


use Livewire\Component;
use App\Models\Marca; 
use Livewire\WithPagination;

class Marcas extends Component
{
    use WithPagination;

    public $nombreMarca, $marca_id;
    public $modal = false;
    public $modalConfirmarEliminacion = false;
    protected $rules = [
        'nombreMarca' => 'required|string|max=45'
    ];

    public function render()
    {
       
        return view('livewire.inventario.Marca.marcas', [
            'marcas' => Marca::latest()->paginate(perPage: 10)
        ]);
    }

    public function abrirModalCrear()
    {
        $this->reset(['nombreMarca', 'marca_id']);
        $this->modal = true;
    }

    public function abrirModalEditar($id)
    {
        $marcas = Marca::findOrFail($id);
        $this->marca_id = $marcas->id;
        $this->nombreMarca = $marcas->nombreMarca;
        $this->modal = true;
    }
    
    public function guardarMarca()
    {
        $this->validate([
            'nombreMarca' => 'required|string|max:255',
        ]);

        Marca::updateOrCreate(
            ['id' => $this->marca_id],
            ['nombreMarca' => $this->nombreMarca]
        );


        $this->reset('nombreMarca');
        if ($this->marca_id) {
            session()->flash('mensaje', 'Marca actualizada exitosamente.');
        } else {
            session()->flash('mensaje', 'Marca agregada exitosamente.');
        }
    
        $this->cerrarModal();
    }

    public function confirmarEliminacion($id)
    {
        $this->marca_id = $id;
        $this->modalConfirmarEliminacion = true;
    }

    public function eliminar()
    {
        Marca::findOrFail($this->marca_id)->delete();
        session()->flash('mensaje', 'Marca eliminada exitosamente.');
        $this->cerrarModal();
    }

    public function cerrarModal()
    {
        $this->reset(['nombreMarca', 'marca_id', 'modal', 'modalConfirmarEliminacion']);
        $this->resetErrorBag();
    }
    
}
