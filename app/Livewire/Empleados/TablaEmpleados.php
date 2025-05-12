<?php

namespace App\Livewire\Empleados;

use Livewire\Component;
use App\Models\Empleado;

class TablaEmpleados extends Component
{
    public $idEmpleadoAEliminar = null;
    public $mostrarConfirmacion = false;
    public $mostrarModalEditar = false;
    public $nombreEmpleado, $apellidoEmpleado, $correoEmpleado, $direccionEmpleado, $idEmpleadoEditar;
    public $searchTerm = '';
    public $searchField = 'nombreEmpleado';

    protected $listeners = [
        'empleadoActualizado' => '$refresh',
        'filtroActualizado' => 'actualizarFiltro'
    ];

    public function actualizarFiltro($data)
    {
        $this->searchTerm = $data['termino'];
        $this->searchField = $data['filtro'];
    }

    public function render()
    {
        $empleados = Empleado::query()
            ->where($this->searchField, 'like', '%' . $this->searchTerm . '%')
            ->get();

        return view('livewire.empleados.tabla-empleados', [
            'empleados' => $empleados,
        ]);
    }   

public function abrirModalEditar($id)
{
    $empleado = Empleado::findOrFail($id);

    $this->idEmpleadoEditar = $empleado->id;
    $this->nombreEmpleado = $empleado->nombreEmpleado;
    $this->apellidoEmpleado = $empleado->apellidoEmpleado;
    $this->correoEmpleado = $empleado->correoEmpleado;
    $this->direccionEmpleado = $empleado->direccionEmpleado;

    $this->mostrarModalEditar = true;
    $this->dispatch('modalOpen'); // Enviar evento para abrir el modal
}


public function cerrarModalEditar()
{
    $this->mostrarModalEditar = false;
    $this->reset(['idEmpleadoEditar', 'nombreEmpleado', 'apellidoEmpleado', 'correoEmpleado', 'direccionEmpleado']);
    $this->dispatch('modalClose'); // Cerrar modal después de resetear
}



public function guardarEmpleado()
{
    $this->validate([
        'nombreEmpleado' => 'required|string|max:255',
        'apellidoEmpleado' => 'required|string|max:255',
        'correoEmpleado' => 'required|string|max:255',
        'direccionEmpleado' => 'required|string|max:255',
    ]);

    $empleado = Empleado::find($this->idEmpleadoEditar);
    $empleado->update([
        'nombreEmpleado' => $this->nombreEmpleado,
        'apellidoEmpleado' => $this->apellidoEmpleado,
        'correoEmpleado' => $this->correoEmpleado,
        'direccionEmpleado' => $this->direccionEmpleado
    ]);

    session()->flash('message', 'Empleado actualizado exitosamente.');

    $this->cerrarModalEditar();
}

    public function solicitarConfirmacion($id)
    {
        $this->idEmpleadoAEliminar = $id;
        $this->mostrarConfirmacion = true;
    }

    public function cancelarEliminacion()
    {
        $this->idEmpleadoAEliminar = null;
        $this->mostrarConfirmacion = false;
    }


    public function eliminarEmpleado()
    {
        if ($this->idEmpleadoAEliminar) {
            Empleado::findOrFail($this->idEmpleadoAEliminar)->delete();
            $this->reset(['idEmpleadoAEliminar', 'mostrarConfirmacion']);
            session()->flash('message', 'Empleado eliminado correctamente.');
        }
    }
}