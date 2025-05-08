<?php
use App\Livewire\AcercaDe\acercaDe;

Route::middleware(['auth'])->group(function () {
    Route::get('/acercaDe', AcercaDe::class)->name('acercaDe');
});
