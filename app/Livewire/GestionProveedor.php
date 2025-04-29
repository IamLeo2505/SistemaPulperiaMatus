<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Proveedor;
use Livewire\WithPagination;

class GestionProveedor extends Component
{
    use WithPagination;

    public $nombre, $apellido, $compañía, $numero, $proveedorId;
    public $search = '';
    public $isOpen = false;
    public $isEdit = false;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'compañía' => 'required|string|max:255',
        'numero' => 'required|numeric',
    ];

    public function render()
    {
        $proveedores = Proveedor::where('nombre', 'like', '%' . $this->search . '%')
                                ->orWhere('apellido', 'like', '%' . $this->search . '%')
                                ->orWhere('compañía', 'like', '%' . $this->search . '%')
                                ->orderBy('idProveedor', 'desc')
                                ->paginate(10);

        return view('livewire.gestion-proveedor', compact('proveedores'));
    }

    public function create()
    {
        $this->resetFields();
        $this->isOpen = true;
        $this->isEdit = false;
    }

    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $this->proveedorId = $proveedor->idProveedor;
        $this->nombre = $proveedor->Nombre;
        $this->apellido = $proveedor->Apellido;
        $this->compañía = $proveedor->Compañía;
        $this->numero = $proveedor->Numero;
        $this->isOpen = true;
        $this->isEdit = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->isEdit) {
            $proveedor = Proveedor::findOrFail($this->proveedorId);
        } else {
            $proveedor = new Proveedor();
        }

        $proveedor->Nombre = $this->nombre;
        $proveedor->Apellido = $this->apellido;
        $proveedor->Compañía = $this->compañía;
        $proveedor->Numero = $this->numero;
        $proveedor->save();

        session()->flash('message', $this->isEdit ? 'Proveedor actualizado exitosamente.' : 'Proveedor creado exitosamente.');

        $this->resetFields();
        $this->isOpen = false;
    }

    public function delete($id)
    {
        Proveedor::findOrFail($id)->delete();
        session()->flash('message', 'Proveedor eliminado exitosamente.');
    }

    private function resetFields()
    {
        $this->nombre = '';
        $this->apellido = '';
        $this->compañía = '';
        $this->numero = '';
        $this->proveedorId = null;
    }
}


