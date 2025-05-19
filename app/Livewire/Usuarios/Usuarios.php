<?php

namespace App\Livewire\Usuarios;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Empleado;
use App\Models\Usuario;
use Illuminate\Support\Facades\Log;

class Usuarios extends Component
{
    use WithFileUploads;

    public $user, $password, $correoEmpleado, $empleado_id, $image_path_Usuarios, $usuario_id;
    public $usuariosFiltrados = [];
    public $mostrarConfirmacion = false;
    public $usuarioAEliminar = null;
    public $termino = '';
    public $filtro = 'user';
    public $modalAbierto = false;
    public $modoEdicion = false;
    public bool $showPassword = false;

    protected $rules = [
        'user' => 'required|string|max:45|unique:usuarios,user',
        'password' => 'required|string|min:6',
        'correoEmpleado' => 'required|exists:empleados,correoEmpleado',
        'image_path_Usuarios' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ];

    public function mount()
    {
        $this->usuariosFiltrados = Usuario::all();
    }

    public function render()
    {
        $query = Usuario::query();

        if ($this->termino) {
            if ($this->filtro === 'correoEmpleado') {
                $query->join('empleados', 'usuarios.empleado_id', '=', 'empleados.id')
                      ->where('empleados.correoEmpleado', 'like', '%' . $this->termino . '%')
                      ->select('usuarios.*');
            } else {
                $query->where($this->filtro, 'like', '%' . $this->termino . '%');
            }
        }

        return view('livewire.usuarios.usuarios', [
            'usuarios' => $query->get(),
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
        $this->reset(['user', 'password', 'correoEmpleado', 'image_path_Usuarios', 'usuario_id']);
        $this->modoEdicion = false;
        $this->resetErrorBag();
    }

    public function limpiarImagen()
    {
        $this->image_path_Usuarios = null;
        $this->resetErrorBag('image_path_Usuarios');
    }

    public function guardarUsuario()
    {
        $this->validate([
            'user' => 'required|string|max:45|unique:usuarios,user,' . '$usuario->id',
            'password' => 'required|string|min:6|max:50',
            'empleado_id' => 'required|exists:empleados,correoEmpleado',
            'image_path_Usuarios' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $empleado = Empleado::where('correoEmpleado', $this->correoEmpleado)->firstOrFail();

        if ($this->image_path_Usuarios) {
            Log::debug('Imagen subida en guardarUsuario: ' . $this->image_path_Usuarios->getClientOriginalName());
        }

        $rutaImagen = null;
        if ($this->image_path_Usuarios) {
            $nombreImagen = 'usuario_' . time() . '.' . $this->image_path_Usuarios->getClientOriginalExtension();
            $rutaImagen = $this->image_path_Usuarios->storeAs('profile_images', $nombreImagen, 'public');
            $rutaImagen = 'profile_images/' . $nombreImagen;
        }

        Usuario::create([
            'user' => $this->user,
            'password' => Hash::make($this->password),
            'empleado_id' => $empleado->id,
            'image_path_Usuarios' => $rutaImagen,
        ]);

        $this->cerrarModal();
        $this->resetCampos();
        $this->dispatch('usuarioActualizado');
    }

    public function editar($id)
    {
        $usuario = Usuario::findOrFail($id);
        $this->user = $usuario->user;
        $this->password = '';
        $this->correoEmpleado = $usuario->empleado->correoEmpleado;
        $this->usuario_id = $usuario->id;
        $this->image_path_Usuarios = null;
        $this->modoEdicion = true;
        $this->modalAbierto = true;
    }

    public function actualizarUsuario()
    {
        $usuario = Usuario::find($this->usuario_id);
        $rules = [
            'user' => 'nullable|string|regex:/^[a-zA-Z]$/|min:6|max:45|unique:usuarios,user,' . $usuario->id,
            'password' => 'nullable|string|min:6|max:50',
            'correoEmpleado' => 'nullable|exists:empleados,correoEmpleado',
            'image_path_Usuarios' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        try {
            $this->validate($rules);

            $empleado = Empleado::where('correoEmpleado', $this->correoEmpleado)->firstOrFail();

            if ($this->image_path_Usuarios) {
                Log::debug('Imagen subida en actualizarUsuario: ' . $this->image_path_Usuarios->getClientOriginalName());
            }

            $data = [
                'user' => $this->user,
                'empleado_id' => $empleado->id,
            ];

            if ($this->password) {
                $data['password'] = Hash::make($this->password);
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
        
        $this->dispatch('usuarioActualizado');
    }

    public function actualizarFiltro($data)
    {
        $this->filtro = $data['filtro'];
        $this->termino = $data['termino'];
    }
}