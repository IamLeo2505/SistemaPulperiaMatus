<?php

namespace App\Livewire\Reportes;

use Livewire\Component;

class Reportes extends Component
{
    public $reportes = [
        ['tipo' => 'inventario', 'nombre' => 'Inventario', 'icono' => '📦'],
        ['tipo' => 'ventas', 'nombre' => 'Ventas Realizadas', 'icono' => '🧾'],
        ['tipo' => 'usuarios', 'nombre' => 'Usuarios', 'icono' => '👤'],
        ['tipo' => 'empleados', 'nombre' => 'Empleados', 'icono' => '🧑‍💼'],
        ['tipo' => 'clientes', 'nombre' => 'Clientes', 'icono' => '🧑‍🤝‍🧑'],
        ['tipo' => 'proveedores', 'nombre' => 'Proveedores', 'icono' => '🚚'],
        ['tipo' => 'compras', 'nombre' => 'Compras Realizadas', 'icono' => '🧾'],
        ['tipo' => 'categoria', 'nombre' => 'Categorías', 'icono' => '📁'],
        ['tipo' => 'marca', 'nombre' => 'Marcas', 'icono' => '🏷️'],
    ];

    public function render()
    {
        return view('livewire.reportes.reportes')
            ->with('reportes', $this->reportes);
    }
}
