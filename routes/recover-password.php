<?php

use App\Livewire\Login\RecoverPassword;
use Illuminate\Support\Facades\Route;

Route::get('/recover-password', RecoverPassword::class)
     ->name('recover-password');
