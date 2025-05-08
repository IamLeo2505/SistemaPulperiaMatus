<?php
use App\Livewire\Usuarios\usuarios;

Route::middleware(['auth'])->group(function () {
    Route::get('/usuarios', Usuarios::class)->name('usuarios');
});
