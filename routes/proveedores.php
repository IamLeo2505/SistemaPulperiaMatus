<?php
use App\Livewire\Proveedores\proveedores;

Route::middleware(['auth'])->group(function () {
    Route::get('/proveedores', Proveedores::class)->name('proveedores');
});
