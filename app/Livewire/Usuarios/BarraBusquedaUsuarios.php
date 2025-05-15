<?php

namespace App\Livewire\Usuarios;

use Livewire\Component;

class BarraBusquedaUsuarios extends Component
{

    public $termino = '';
    public $filtro = 'user';

    public function buscar()
    {
        $this->dispatch('filtroActualizado', [
            'termino' => $this->termino,
            'filtro' => $this->filtro,
        ]);
    }

    public function render()
    {
        return view('livewire.usuarios.barra-busqueda-usuarios');
    }
}
