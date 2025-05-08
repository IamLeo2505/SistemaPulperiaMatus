<?php

namespace App\Livewire\Login;

use Livewire\Component;

class RecoverPassword extends Component
{
    public function render()
    {
        return view('livewire.login.recover-password')
            ->layout('components.layouts.auth');
    }
}
