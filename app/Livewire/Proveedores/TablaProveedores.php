<?php

namespace App\Livewire\Proveedores;

use Livewire\Component;
use App\Models\Proveedor;

class TablaProveedores extends Component
{
    public $idProveedorAEliminar = null;
    public $mostrarConfirmacion = false;
    public $mostrarModalEditar = false;
    public $nombreProveedor, $apellidoProveedor, $compañía, $numeroProveedor, $idProveedorEditar;
    public $searchTerm = '';
    public $searchField = 'nombreProveedor';

    protected $listeners = [
        'proveedorActualizado' => '$refresh',
        'filtroActualizado' => 'actualizarFiltro'
    ];

    public function actualizarFiltro($data)
    {
        $this->searchTerm = $data['termino'];
        $this->searchField = $data['filtro'];
    }

    public function render()
    {
        $proveedores = Proveedor::query()
            ->where($this->searchField, 'like', '%' . $this->searchTerm . '%')
            ->get();

        return view('livewire.proveedores.tabla-proveedores', [
            'proveedores' => $proveedores,
        ]);
    }   

public function abrirModalEditar($id)
{
    $proveedor = Proveedor::findOrFail($id);

    $this->idProveedorEditar = $proveedor->id;
    $this->nombreProveedor = $proveedor->nombreProveedor;
    $this->apellidoProveedor = $proveedor->apellidoProveedor;
    $this->compañía = $proveedor->compañía;
    $this->numeroProveedor = $proveedor->numeroProveedor;

    $this->mostrarModalEditar = true;
    $this->dispatch('modalOpen'); // Enviar evento para abrir el modal
}


public function cerrarModalEditar()
{
    $this->mostrarModalEditar = false;
    $this->reset(['idProveedorEditar', 'nombreProveedor', 'apellidoProveedor', 'compañía', 'numeroProveedor']);
    $this->dispatch('modalClose'); // Cerrar modal después de resetear
}



public function guardarProveedor()
{
    $this->validate([
        'nombreProveedor' => 'required|string|max:255',
        'apellidoProveedor' => 'required|string|max:255',
        'compañía' => 'required|string|max:255',
        'numeroProveedor' => 'required|string|max:255',
    ]);

    $proveedor = Proveedor::find($this->idProveedorEditar);
    $proveedor->update([
        'nombreProveedor' => $this->nombreProveedor,
        'apellidoProveedor' => $this->apellidoProveedor,
        'compañía' => $this->compañía,
        'numeroProveedor' => $this->numeroProveedor
    ]);

    session()->flash('message', 'Proveedor actualizado exitosamente.');

    $this->cerrarModalEditar();
}

    public function solicitarConfirmacion($id)
    {
        $this->idProveedorAEliminar = $id;
        $this->mostrarConfirmacion = true;
    }

    public function cancelarEliminacion()
    {
        $this->idProveedorAEliminar = null;
        $this->mostrarConfirmacion = false;
    }


    public function eliminarProveedor()
    {
        if ($this->idProveedorAEliminar) {
            Proveedor::findOrFail($this->idProveedorAEliminar)->delete();
            $this->reset(['idProveedorAEliminar', 'mostrarConfirmacion']);
            session()->flash('message', 'Proveedor eliminado correctamente.');
        }
    }
}
