<?php
use App\Livewire\Inventario\Inventario;

Route::middleware(['auth'])->group(function () {
    Route::get('/inventario', Inventario::class)->name('inventario');
});
