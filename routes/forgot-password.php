<?php

use App\Livewire\Login\ForgotPassword;
use Illuminate\Support\Facades\Route;

Route::get('/forgot-password', ForgotPassword::class)
     ->name('forgot-password');
