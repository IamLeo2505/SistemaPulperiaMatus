<?php

use App\Livewire\Ventas\Facturacion;
use App\Livewire\Ventas\RegistrarVentas;

Route::middleware(['auth'])->group(function () {
    Route::get('/facturacion', Facturacion::class)->name('facturacion');
    Route::get('/ventas/registrar', RegistrarVentas::class)->name('ventas.registrar_ventas');
});
