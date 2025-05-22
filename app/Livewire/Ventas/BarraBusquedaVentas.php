<?php

namespace App\Livewire\Ventas;

use Livewire\Component;

class BarraBusquedaVentas extends Component
{
    public $termino = '';
    public $filtro = 'cliente'; 

    public function buscar()
    {
        $this->dispatch('filtroActualizado', [
            'termino' => $this->termino,
            'filtro' => $this->filtro,
        ]);
    }

    public function render()
    {
        return view('livewire.ventas.barra-busqueda-ventas');
    }
}