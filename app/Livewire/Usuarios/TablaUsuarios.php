<?php

namespace App\Livewire\Usuarios;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Empleado;
use App\Models\Usuario;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class TablaUsuarios extends Component
{
    use WithFileUploads;

    public $idUsuarioAEliminar = null;
    public $mostrarConfirmacion = false;
    public $mostrarModalEditar = false;
    public $mostrarModalImagen = false;
    public $user, $password, $correoEmpleado, $image_path_Usuarios, $idUsuarioEditar;
    public $searchTerm = '';
    public $searchField = 'user';

    protected $listeners = [
        'usuarioActualizado' => '$refresh',
        'filtroActualizado' => 'actualizarFiltro'
    ];

    public function actualizarFiltro($data)
    {
        $this->searchTerm = $data['termino'];
        $this->searchField = $data['filtro'];
    }

    public function render()
    {
        $usuarios = Usuario::query()
            ->where($this->searchField, 'like', '%' . $this->searchTerm . '%')
            ->get();

        return view('livewire.usuarios.tabla-usuarios', [
            'usuarios' => $usuarios,
            'empleados' => Empleado::all(),
        ]);
    }   

    public function abrirModalEditar($id)
    {
        $usuario = Usuario::findOrFail($id);
        $this->idUsuarioEditar = $usuario->id;
        $this->user = $usuario->user;
        $this->password = '';
        $this->correoEmpleado = $usuario->empleado->correoEmpleado;
        $this->image_path_Usuarios = null;
        $this->mostrarModalEditar = true;
        $this->resetErrorBag();
        $this->dispatch('modalOpen');
    }

    public function cerrarModalEditar()
    {
        $this->mostrarModalEditar = false;
        $this->reset(['idUsuarioEditar', 'user', 'password', 'correoEmpleado', 'image_path_Usuarios']);
        $this->resetErrorBag();
        $this->dispatch('modalClose');
    }

    public function abrirModalImagen($id)
    {
        $usuario = Usuario::findOrFail($id);
        $this->image_path_Usuarios = $usuario->image_path_Usuarios;
        $this->mostrarModalImagen = true;
        $this->dispatch('modalOpen');
    }

    public function cerrarModalImagen()
    {
        $this->mostrarModalImagen = false;
        $this->reset(['image_path_Usuarios']);
        $this->dispatch('modalClose');
    }

    public function limpiarImagen()
    {
        $this->image_path_Usuarios = null;
        $this->resetErrorBag('image_path_Usuarios');
    }

    public function guardarUsuario()
    {
        $this->validate([
            'user' => 'required|string|max:45|unique:usuarios,user,' . $this->idUsuarioEditar,
            'password' => 'nullable|string|min:6',
            'correoEmpleado' => 'required|exists:empleados,correoEmpleado',
            'image_path_Usuarios' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $usuario = Usuario::find($this->idUsuarioEditar);
        $empleado = Empleado::where('correoEmpleado', $this->correoEmpleado)->firstOrFail();

        // Depuración: Loguear el nombre del archivo subido
        if ($this->image_path_Usuarios) {
            Log::debug('Imagen subida en guardarUsuario (TablaUsuarios): ' . $this->image_path_Usuarios->getClientOriginalName());
        }

        $data = [
            'user' => $this->user,
            'empleado_id' => $empleado->id,
        ];

        if ($this->password) {
            $data['password'] = bcrypt($this->password);
        }

        if ($this->image_path_Usuarios) {
            if ($usuario->image_path_Usuarios) {
                Storage::disk('public')->delete($usuario->image_path_Usuarios);
            }
            $nombreImagen = 'usuario_' . time() . '.' . $this->image_path_Usuarios->getClientOriginalExtension();
            $data['image_path_Usuarios'] = $this->image_path_Usuarios->storeAs('profile_images', $nombreImagen, 'public');
            $data['image_path_Usuarios'] = 'profile_images/' . $nombreImagen;
        }

        $usuario->update($data);

        session()->flash('message', 'Usuario actualizado exitosamente.');
        $this->cerrarModalEditar();
    }

    public function solicitarConfirmacion($id)
    {
        $this->idUsuarioAEliminar = $id;
        $this->mostrarConfirmacion = true;
    }

    public function cancelarEliminacion()
    {
        $this->idUsuarioAEliminar = null;
        $this->mostrarConfirmacion = false;
    }

    public function eliminarUsuario()
    {
        if ($this->idUsuarioAEliminar) {
            $usuario = Usuario::findOrFail($this->idUsuarioAEliminar);
            if ($usuario->image_path_Usuarios) {
                Storage::disk('public')->delete($usuario->image_path_Usuarios);
            }
            $usuario->delete();
            $this->reset(['idUsuarioAEliminar', 'mostrarConfirmacion']);
            session()->flash('message', 'Usuario eliminado correctamente.');
        }
    }
}