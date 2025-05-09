<?php
namespace App\Livewire\Usuarios;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Empleado;

class Usuarios extends Component
{
    use WithFileUploads;

    public $profile_image;

    public function uploadImage()
    {
        $this->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $filename = 'avatar_' . Auth::user()->empleado->id . '_' . time() . '.' . $this->profile_image->getClientOriginalExtension();
        $path = $this->profile_image->storeAs('public/profile_images', $filename);

        if ($path) {
            Empleado::where('id', Auth::user()->empleado->id)->update(['image_path' => 'profile_images/' . $filename]);
            $this->dispatch('profile-image-updated'); 
            session()->flash('success', 'Foto de perfil actualizada.');
        } else {
            session()->flash('error', 'Hubo un error al subir la foto.');
        }

        $this->reset('profile_image');
    }

    public function render()
    {
        return view('livewire.usuarios.usuarios');
    }
}