<?php

namespace App\Livewire\Clientes;

use Livewire\Component;

class BarraBusquedaClientes extends Component
{
    public $termino = '';
    public $filtro = 'nombreCliente';

    public function buscar()
    {
        $this->dispatch('filtroActualizado', [
            'termino' => $this->termino,
            'filtro' => $this->filtro,
        ]);
    }

    public function render()
    {
        return view('livewire.clientes.barra-busqueda-clientes');
    }
}