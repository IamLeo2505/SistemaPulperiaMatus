<?php

namespace App\Livewire\Empleados;

use Livewire\Component;
use App\Models\Empleado;

class TablaEmpleados extends Component
{
    public $idEmpleadoAEliminar = null;
    public $mostrarConfirmacion = false;
    public $mostrarModalEditar = false;
    public $mostrarAdvertenciaUsuario = false;
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
        $this->dispatch('modalOpen');
    }

    public function cerrarModalEditar()
    {
        $this->mostrarModalEditar = false;
        $this->reset(['idEmpleadoEditar', 'nombreEmpleado', 'apellidoEmpleado', 'correoEmpleado', 'direccionEmpleado']);
        $this->dispatch('modalClose');
    }

    public function guardarEmpleado()
    {
        $this->validate([
            'nombreEmpleado' => 'required|string|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/|min:3|max:10',
            'apellidoEmpleado' => 'required|string|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/|min:4|max:15',
            'correoEmpleado' => 'required|email|ends_with:@gmail.com|min:13|max:45',
            'direccionEmpleado' => 'required|string|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9#\-\s]+$/|min:10|max:50',

        ]);

        $empleado = Empleado::find($this->idEmpleadoEditar);
        $empleado->update([
            'nombreEmpleado' => $this->nombreEmpleado,
            'apellidoEmpleado' => $this->apellidoEmpleado,
            'correoEmpleado' => $this->correoEmpleado,
            'direccionEmpleado' => $this->direccionEmpleado
        ]);
        $this->cerrarModalEditar();
    }

    public function solicitarConfirmacion($id)
    {
        $empleado = Empleado::findOrFail($id);
        $this->idEmpleadoAEliminar = $id;
        if ($empleado->usuario) {
            $this->mostrarAdvertenciaUsuario = true;
        } else {
            $this->mostrarConfirmacion = true;
        }
    }

    public function cancelarEliminacion()
    {
        $this->idEmpleadoAEliminar = null;
        $this->mostrarConfirmacion = false;
        $this->mostrarAdvertenciaUsuario = false;
    }

    public function eliminar()
    {
        if ($this->idEmpleadoAEliminar) {
            $empleado = Empleado::findOrFail($this->idEmpleadoAEliminar);
            $empleado->delete();
            $this->reset(['idEmpleadoAEliminar', 'mostrarConfirmacion', 'mostrarAdvertenciaUsuario']);
        }
    }
}