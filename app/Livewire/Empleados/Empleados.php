<?php

namespace App\Livewire\Empleados;

use Livewire\Component;
use App\Models\Empleado;

class Empleados extends Component
{
    public $empleadosFiltrados = [];

    public $mostrarConfirmacion = false;
    public $mostrarAdvertenciaUsuario = false;
    public $empleadoAEliminar = null;

    protected $listeners = ['filtroActualizado' => 'actualizarFiltro'];
    public $termino = '';
    public $filtro = 'nombreEmpleado';

    public $empleados, $nombreEmpleado, $apellidoEmpleado, $correoEmpleado, $direccionEmpleado, $empleado_id;
    public $modalAbierto = false;
    public $modoEdicion = false;

    public function PropiedadesEmpleados()
    {
        $campo = $this->filtro;
        $termino = '%' . $this->termino . '%';
        return Empleado::where($campo, 'like', $termino)->get();
    }

    public function mount()
    {
        $this->empleadosFiltrados = Empleado::all();
    }

    
// Método para forzar el refresco del render
    public function actualizarFiltro($data)
    {
        $this->filtro = $data['filtro'];
        $this->termino = $data['termino'];
        $this->empleadosFiltrados = $this->PropiedadesEmpleados();
    }

    public function render()
    {
        return view('livewire.empleados.empleados', [
            'empleados' => $this->PropiedadesEmpleados()
        ]);
    }



    public function abrirModal()
    {
        $this->resetCampos();
        $this->modoEdicion = false;
        $this->modalAbierto = true;
    }

    public function cerrarModal()
    {
        $this->modalAbierto = false;
    }
    
    public function resetCampos()
    {
        $this->reset(['nombreEmpleado', 'apellidoEmpleado', 'correoEmpleado', 'direccionEmpleado']);
        $this->modoEdicion = false;
    }

    public function guardarEmpleado()
    {
        $this->validate([
            'nombreEmpleado' => 'required|string',
            'apellidoEmpleado' => 'required|string',
            'correoEmpleado' => 'required|string',
            'direccionEmpleado' => 'required|string',
        ]);

        Empleado::create([
            'nombreEmpleado' => $this->nombreEmpleado,
            'apellidoEmpleado' => $this->apellidoEmpleado,
            'correoEmpleado' => $this->correoEmpleado,
            'direccionEmpleado' => $this->direccionEmpleado,
        ]);

        session()->flash('mensaje', 'Empleado creado correctamente.');
        $this->cerrarModal();
        $this->resetCampos();
        $this->dispatch('empleadoActualizado');
    }

    public function editar($id)
    {
        $empleado = Empleado::findOrFail($id);
        $this->nombreEmpleado = $empleado->nombreEmpleado;
        $this->apellidoEmpleado = $empleado->apellidoEmpleado;
        $this->correoEmpleado = $empleado->correoEmpleado;
        $this->direccionEmpleado = $empleado->direccionEmpleado;
        $this->empleado_id = $empleado->id;
        $this->modoEdicion = true;
        $this->modalAbierto = true;
    }

    public function actualizarEmpleado()
    {
        $this->validate([
            'nombreEmpleado' => 'required',
            'apellidoEmpleado' => 'required',
            'correoEmpleado' => 'required',
            'direccionEmpleado' => 'required',
        ]);

        $empleado = Empleado::find($this->empleado_id);
        $empleado->update([
            'nombreEmpleado' => $this->nombreEmpleado,
            'apellidoEmpleado' => $this->apellidoEmpleado,
            'correoEmpleado' => $this->correoEmpleado,
            'direccionEmpleado' => $this->direccionEmpleado,
        ]);

        session()->flash('mensaje', 'Empleado actualizado correctamente.');
        $this->cerrarModal();
        $this->resetCampos();
        $this->dispatch('empleadoActualizado');
    }

    public function solicitarConfirmacion($id)
    {
        $empleado = Empleado::findOrFail($id);
        $this->empleadoAEliminar = $id;
        if ($empleado->usuario) {
            $this->mostrarAdvertenciaUsuario = true;
        } else {
            $this->mostrarConfirmacion = true;
        }
    }

    public function cancelarEliminacion()
    {
        $this->empleadoAEliminar = null;
        $this->mostrarConfirmacion = false;
        $this->mostrarAdvertenciaUsuario = false;
    }

    public function eliminar()
    {
        if ($this->empleadoAEliminar) {
            $empleado = Empleado::findOrFail($this->empleadoAEliminar);
            $empleado->delete();
            $this->reset(['empleadoAEliminar', 'mostrarConfirmacion', 'mostrarAdvertenciaUsuario']);
            session()->flash('mensaje', 'Empleado eliminado correctamente.');
            $this->dispatch('empleadoActualizado');
        }
    }
}