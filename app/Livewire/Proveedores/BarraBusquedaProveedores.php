<?php

namespace App\Livewire\Proveedores;

use Livewire\Component;

class BarraBusquedaProveedores extends Component
{

    public $termino = '';
    public $filtro = 'nombreProveedor';

    public function buscar()
    {
        $this->dispatch('filtroActualizado', [
            'termino' => $this->termino,
            'filtro' => $this->filtro,
        ]);
    }

    public function render()
    {
        return view('livewire.proveedores.barra-busqueda-proveedores');
    }
}
