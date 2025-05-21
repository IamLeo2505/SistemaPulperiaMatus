<?php

namespace App\Livewire\Compras;

use Livewire\Component;

class BarraBusquedaCompras extends Component
{
    public $termino = '';
    public $filtro = 'proveedor'; 

    public function buscar()
    {
        $this->dispatch('filtroActualizado', [
            'termino' => $this->termino,
            'filtro' => $this->filtro,
        ]);
    }

    public function render()
    {
        return view('livewire.compras.barra-busqueda-compras');
    }
}
