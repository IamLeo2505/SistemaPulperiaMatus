<?php

namespace App\Livewire\Empleados;

use Livewire\Component;

class BarraBusquedaEmpleados extends Component
{

    public $termino = '';
    public $filtro = 'nombreEmpleado';

    public function buscar()
    {
        $this->dispatch('filtroActualizado', [
            'termino' => $this->termino,
            'filtro' => $this->filtro,
        ]);
    }

    public function render()
    {
        return view('livewire.empleados.barra-busqueda-empleados');
    }
}
