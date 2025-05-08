<?php
use App\Livewire\Login\Login;

Route::get('/login', Login::class)->name('login');
Route::get('/check', function () {
    return Auth::check() ? 'Logueado' : 'No logueado';
});
