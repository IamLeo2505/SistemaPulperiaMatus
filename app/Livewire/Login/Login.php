<?php

namespace App\Livewire\Login;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $user = '';
    public $password = '';
    public bool $showPassword = false; 

    protected $rules = [
        'user' => 'required',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['user' => $this->user, 'password' => $this->password])) {
            session()->regenerate();
            return redirect()->route('home');
        }

        $this->addError('user', 'Credenciales inválidas.');
    }

    public function render()
    {
        return view('livewire.login.login')
            ->layout('components.layouts.auth');
    }
    
}