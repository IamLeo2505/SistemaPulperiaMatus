<?php

namespace App\Livewire\Inventario;

use Livewire\Component;
use App\Models\categoria;

class Categorias extends Component
{
    public $nombre_categoria;

    public function guardarCategoria()
    {
        $this->validate([
            'nombre_categoria' => 'required|string|max:255',
        ]);

        Categoria::create([
            'nombre_categoria' => $this->nombre_categoria,
        ]);

        $this->reset(['nombre_categoria']);
        session()->flash('mensaje', 'Categoría agregada exitosamente.');
    }

    public function render()
    {
        return view('livewire.inventario.Categoria.categorias', [
            'categorias' => Categoria::all()
        ]);
    }
}
