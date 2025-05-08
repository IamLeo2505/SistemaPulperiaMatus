<?php
use App\Livewire\Ventas\Facturacion;

Route::middleware(['auth'])->group(function () {
    Route::get('/facturacion', Facturacion::class)->name('facturacion');
});
