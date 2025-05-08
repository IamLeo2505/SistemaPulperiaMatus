<?php
use App\Livewire\Clientes\clientes;

Route::middleware(['auth'])->group(function () {
    Route::get('/clientes', Clientes::class)->name('clientes');
});
