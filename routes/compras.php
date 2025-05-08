<?php
use App\Livewire\Compras\Compras;

Route::middleware(['auth'])->group(function () {
    Route::get('/compras', Compras::class)->name('compras');
});
