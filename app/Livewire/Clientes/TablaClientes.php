<?php

namespace App\Livewire\Clientes;

use Livewire\Component;
use App\Models\Cliente;

class TablaClientes extends Component
{
    public $idClienteAEliminar = null;
    public $mostrarConfirmacion = false;
    public $mostrarModalEditar = false;
    public $nombreCliente, $apellidoCliente, $numeroCliente, $edad, $genero, $estado, $idClienteEditar;
    public $searchTerm = '';
    public $searchField = 'nombreCliente';

    protected $listeners = [
        'clienteActualizado' => '$refresh',
        'filtroActualizado' => 'actualizarFiltro'
    ];

    public function actualizarFiltro($data)
    {
        $this->searchTerm = $data['termino'];
        $this->searchField = $data['filtro'];
    }

    public function render()
    {
        $clientes = Cliente::query()
            ->where($this->searchField, 'like', '%' . $this->searchTerm . '%')
            ->get();

        return view('livewire.clientes.tabla-clientes', [
            'clientes' => $clientes,
        ]);
    }

    public function abrirModalEditar($id)
    {
        $cliente = Cliente::findOrFail($id);

        $this->idClienteEditar = $cliente->id;
        $this->nombreCliente = $cliente->nombreCliente;
        $this->apellidoCliente = $cliente->apellidoCliente;
        $this->numeroCliente = $cliente->numeroCliente;
        $this->edad = $cliente->edad;
        $this->genero = $cliente->genero;
        $this->estado = $cliente->estado;

        $this->mostrarModalEditar = true;
        $this->dispatch('modalOpen'); // Enviar evento para abrir el modal
    }

    public function cerrarModalEditar()
    {
        $this->mostrarModalEditar = false;
        $this->reset(['idClienteEditar', 'nombreCliente', 'apellidoCliente', 'numeroCliente', 'edad', 'genero', 'estado']);
        $this->dispatch('modalClose'); // Cerrar modal después de resetear
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

        $cliente = Cliente::find($this->idClienteEditar);
        $cliente->update([
            'nombreCliente' => $this->nombreCliente,
            'apellidoCliente' => $this->apellidoCliente,
            'numeroCliente' => $this->numeroCliente,
            'edad' => $this->edad,
            'genero' => $this->genero,
            'estado' => $this->estado,
        ]);

        session()->flash('message', 'Cliente actualizado exitosamente.');

        $this->cerrarModalEditar();
    }

    public function solicitarConfirmacion($id)
    {
        $this->idClienteAEliminar = $id;
        $this->mostrarConfirmacion = true;
    }

    public function cancelarEliminacion()
    {
        $this->idClienteAEliminar = null;
        $this->mostrarConfirmacion = false;
    }

    public function eliminarCliente()
    {
        if ($this->idClienteAEliminar) {
            Cliente::findOrFail($this->idClienteAEliminar)->delete();
            $this->reset(['idClienteAEliminar', 'mostrarConfirmacion']);
            session()->flash('message', 'Cliente eliminado correctamente.');
        }
    }
}