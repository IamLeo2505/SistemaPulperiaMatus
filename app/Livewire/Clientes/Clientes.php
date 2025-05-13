<?php

namespace App\Livewire\Clientes;

use Livewire\Component;
use App\Models\Cliente;

class Clientes extends Component
{
    public $clientesFiltrados = [];

    public $mostrarConfirmacion = false;
    public $clienteAEliminar = null;

    protected $listeners = ['filtroActualizado' => 'actualizarFiltro', 'clienteActualizado' => '$refresh'];
    public $termino = '';
    public $filtro = 'nombreCliente';

    public $clientes, $nombreCliente, $apellidoCliente, $numeroCliente, $edad, $genero, $estado, $cliente_id;
    public $modalAbierto = false;
    public $modoEdicion = false;

    public function propiedadesClientes()
    {
        $campo = $this->filtro;
        $termino = '%' . $this->termino . '%';

        return Cliente::where($campo, 'like', $termino)->get();
    }

    public function mount()
    {
        $this->clientesFiltrados = Cliente::all();
    }

    public function actualizarFiltro($data)
    {
        $this->filtro = $data['filtro'];
        $this->termino = $data['termino'];
        $this->clientesFiltrados = $this->propiedadesClientes();
    }

    public function render()
    {
        return view('livewire.clientes.clientes', [
            'clientes' => $this->clientesFiltrados,
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
        $this->reset(['nombreCliente', 'apellidoCliente', 'numeroCliente', 'edad', 'genero', 'estado', 'cliente_id']);
        $this->modoEdicion = false;
    }

    public function guardarCliente()
    {
        $this->validate([
            'nombreCliente' => 'required|string|max:45',
            'apellidoCliente' => 'required|string|max:45',
            'numeroCliente' => 'required|integer',
            'edad' => 'required|integer|min:0',
            'genero' => 'required|boolean',
            'estado' => 'required|boolean',
        ]);

        Cliente::create([
            'nombreCliente' => $this->nombreCliente,
            'apellidoCliente' => $this->apellidoCliente,
            'numeroCliente' => $this->numeroCliente,
            'edad' => $this->edad,
            'genero' => $this->genero,
            'estado' => $this->estado,
        ]);

        session()->flash('mensaje', 'Cliente creado correctamente.');
        $this->cerrarModal();
        $this->resetCampos();
        $this->dispatch('clienteActualizado');
    }

    public function editar($id)
    {
        $cliente = Cliente::findOrFail($id);
        $this->nombreCliente = $cliente->nombreCliente;
        $this->apellidoCliente = $cliente->apellidoCliente;
        $this->numeroCliente = $cliente->numeroCliente;
        $this->edad = $cliente->edad;
        $this->genero = $cliente->genero;
        $this->estado = $cliente->estado;
        $this->cliente_id = $cliente->id;
        $this->modoEdicion = true;
        $this->abrirModal();
    }

    public function actualizarCliente()
    {
        $this->validate([
            'nombreCliente' => 'required|string|max:45',
            'apellidoCliente' => 'required|string|max:45',
            'numeroCliente' => 'required|integer',
            'edad' => 'required|integer|min:0',
            'genero' => 'required|boolean',
            'estado' => 'required|boolean',
        ]);

        $cliente = Cliente::find($this->cliente_id);
        $cliente->update([
            'nombreCliente' => $this->nombreCliente,
            'apellidoCliente' => $this->apellidoCliente,
            'numeroCliente' => $this->numeroCliente,
            'edad' => $this->edad,
            'genero' => $this->genero,
            'estado' => $this->estado,
        ]);

        session()->flash('mensaje', 'Cliente actualizado correctamente.');
        $this->cerrarModal();
        $this->resetCampos();
        $this->dispatch('clienteActualizado');
    }

    public function eliminar($id)
    {
        $cliente = Cliente::findOrFail($id);
        $this->clienteAEliminar = $cliente;
        $this->mostrarConfirmacion = true;
    }

    public function confirmarEliminarCliente()
    {
        if ($this->clienteAEliminar) {
            $this->clienteAEliminar->delete();
            session()->flash('mensaje', 'Cliente eliminado correctamente.');
            $this->mostrarConfirmacion = false;
            $this->clienteAEliminar = null;
            $this->dispatch('clienteActualizado');
        }
    }

    public function cancelarEliminarCliente()
    {
        $this->mostrarConfirmacion = false;
        $this->clienteAEliminar = null;
    }
}