<?php

namespace App\Livewire\Usuarios;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Empleado;
use App\Models\Usuario;

class Usuarios extends Component
{
    use WithFileUploads;

    public $user, $password, $empleado_id, $image_path_Usuarios, $usuario_id;
    public $usuariosFiltrados = [];
    public $mostrarConfirmacion = false;
    public $usuarioAEliminar = null;
    public $termino = '';
    public $filtro = 'user';
    public $modalAbierto = false;
    public $modoEdicion = false;

    protected $rules = [
        'user' => 'required|string|max:45|unique:usuarios,user',
        'password' => 'required|string|min:6',
        'empleado_id' => 'required|exists:empleados,id',
        'image_path_Usuarios' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ];

    public function mount()
    {
        $this->usuariosFiltrados = Usuario::all();
    }

    public function render()
    {
        return view('livewire.usuarios.usuarios', [
            'usuarios' => Usuario::where($this->filtro, 'like', '%' . $this->termino . '%')->get(),
            'empleados' => Empleado::all(),
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
        $this->resetErrorBag();
    }

    public function resetCampos()
    {
        $this->reset(['user', 'password', 'image_path_Usuarios', 'usuario_id']);
        $this->modoEdicion = false;
        $this->resetErrorBag();
    }

    public function guardarUsuario()
    {
        $this->validate();

        $rutaImagen = null;
        if ($this->image_path_Usuarios) {
            $nombreImagen = 'usuario_' . time() . '.' . $this->image_path_Usuarios->getClientOriginalExtension();
            $rutaImagen = $this->image_path_Usuarios->storeAs('profile_images', $nombreImagen, 'public');
            $rutaImagen = 'profile_images/' . $nombreImagen;
        }

        Usuario::create([
            'user' => $this->user,
            'password' => Hash::make($this->password),
            'empleado_id' => $this->empleado_id,
            'image_path_Usuarios' => $rutaImagen,
        ]);

        session()->flash('mensaje', 'Usuario creado correctamente.');
        $this->cerrarModal();
        $this->resetCampos();
        $this->dispatch('usuarioActualizado');
    }

    public function editar($id)
    {
        $usuario = Usuario::findOrFail($id);
        $this->user = $usuario->user;
        $this->password = '';
        $this->empleado_id = $usuario->empleado_id;
        $this->usuario_id = $usuario->id;
        $this->image_path_Usuarios = null;
        $this->modoEdicion = true;
        $this->modalAbierto = true;
    }

    public function actualizarUsuario()
    {
        $usuario = Usuario::find($this->usuario_id);
        $rules = [
            'user' => 'required|string|max:45|unique:usuarios,user,' . $usuario->id,
            'password' => 'nullable|string|min:6',
            'empleado_id' => 'required|exists:empleados,id',
            'image_path_Usuarios' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        try {
            $this->validate($rules);

            $data = [
                'user' => $this->user,
                'empleado_id' => $this->empleado_id,
            ];

            if ($this->password) {
                $data['password'] = Hash::make($this->password);
            }

            if ($this->image_path_Usuarios) {
                // Delete old image if exists
                if ($usuario->image_path_Usuarios) {
                    Storage::disk('public')->delete($usuario->image_path_Usuarios);
                }
                $nombreImagen = 'usuario_' . time() . '.' . $this->image_path_Usuarios->getClientOriginalExtension();
                $data['image_path_Usuarios'] = $this->image_path_Usuarios->storeAs('profile_images', $nombreImagen, 'public');
                $data['image_path_Usuarios'] = 'profile_images/' . $nombreImagen;
            }

            $usuario->update($data);

            session()->flash('mensaje', 'Usuario actualizado correctamente.');
            $this->cerrarModal();
            $this->resetCampos();
            $this->dispatch('usuarioActualizado');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->resetErrorBag();
            foreach ($e->errors() as $field => $messages) {
                foreach ($messages as $message) {
                    $this->addError($field, $message);
                }
            }
        }
    }

    public function eliminar($id)
    {
        $usuario = Usuario::findOrFail($id);
        if ($usuario->image_path_Usuarios) {
            Storage::disk('public')->delete($usuario->image_path_Usuarios);
        }
        $usuario->delete();
        session()->flash('mensaje', 'Usuario eliminado correctamente.');
        $this->dispatch('usuarioActualizado');
    }

    public function actualizarFiltro($data)
    {
        $this->filtro = $data['filtro'];
        $this->termino = $data['termino'];
    }
}