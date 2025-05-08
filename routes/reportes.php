<?php
use App\Livewire\Reportes\reportes;

Route::middleware(['auth'])->group(function () {
    Route::get('/reportes', Reportes::class)->name('reportes');
});
