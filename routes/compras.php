<?php
use App\Livewire\Compras\Compras;
use App\Livewire\Compras\RegistrarCompras;

Route::middleware(['auth'])->group(function () {
    Route::get('/compras', Compras::class)->name('compras');
    Route::get('/compras/registrar', RegistrarCompras::class)->name('compras.registrar_compras');
});
