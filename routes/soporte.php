<?php
use App\Livewire\Soporte\soporte;

Route::middleware(['auth'])->group(function () {
    Route::get('/soporte', Soporte::class)->name('soporte');
});
