<?php

namespace App\Livewire\Proveedores;

use Livewire\Component;
use App\Models\Proveedor;

class Proveedores extends Component
{
    
    public $proveedoresFiltrados = [];

    public $mostrarConfirmacion = false;
    public $proveedorAEliminar = null;

    protected $listeners = ['filtroActualizado' => 'actualizarFiltro'];
    public $termino = '';
    public $filtro = 'nombreProveedor';

    public $proveedores, $nombreProveedor, $apellidoProveedor, $compañía, $numeroProveedor, $proveedor_id;
    public $modalAbierto = false;
    public $modoEdicion = false;

    public function PropiedadesProveedores()
    {
    $campo = $this->filtro;
    $termino = '%' . $this->termino . '%';

    return Proveedor::where($campo, 'like', $termino)->get();
    }

    public function mount()
    {
        $this->proveedoresFiltrados = Proveedor::all();
    }

    
// Método para forzar el refresco del render
     


    public function actualizarFiltro($data)
    {
    $this->filtro = $data['filtro'];
    $this->termino = $data['termino'];
    }

     public function render()
    {
        return view('livewire.proveedores.proveedores', [
            'proveedores' => $this->proveedoresFiltrados
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
         $this->reset(['nombreProveedor', 'apellidoProveedor', 'compañía', 'numeroProveedor']);
        $this->modoEdicion = false;
    }

    public function guardarProveedor()
    {
        $this->validate([
            'nombreProveedor' => 'required|string',
            'apellidoProveedor' => 'required|string',
            'compañía' => 'required|string',
            'numeroProveedor' => 'required',
        ]);

        Proveedor::create([
            'nombreProveedor' => $this->nombreProveedor,
            'apellidoProveedor' => $this->apellidoProveedor,
            'compañía' => $this->compañía,
            'numeroProveedor' => $this->numeroProveedor,
        ]);

        session()->flash('mensaje', 'Proveedor creado correctamente.');
        $this->cerrarModal();
        $this->resetCampos();
        $this->dispatch('proveedorActualizado');
    }

    public function editar($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $this->nombreProveedor = $proveedor->nombreProveedor;
        $this->apellidoProveedor = $proveedor->apellidoProveedor;
        $this->compañía = $proveedor->compañía;
        $this->numeroProveedor = $proveedor->numeroProveedor;
        $this->proveedor_id = $proveedor->id;
        $this->modoEdicion = true;
    }

    public function actualizarProveedor()
    {
        $this->validate([
            'nombreProveedor' => 'required',
            'apellidoProveedor' => 'required',
            'compañía' => 'required',
            'numeroProveedor' => 'required',
        ]);

        $proveedor = Proveedor::find($this->proveedor_id);
        $proveedor->update([
            'nombreProveedor' => $this->nombreProveedor,
            'apellidoProveedor' => $this->apellidoProveedor,
            'compañía' => $this->compañía,
            'numeroProveedor' => $this->numeroProveedor,
        ]);

        session()->flash('mensaje', 'Proveedor actualizado correctamente.');
        $this->resetCampos();
        $this->dispatch('proveedorActualizado');
    }

    public function eliminar($id)
    {
        Proveedor::destroy($id);
        session()->flash('mensaje', 'Proveedor eliminado correctamente.');
    }
}
