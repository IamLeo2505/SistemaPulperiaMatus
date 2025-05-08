<?php
use App\Livewire\Mantenimiento\mantenimiento;

Route::middleware(['auth'])->group(function () {
    Route::get('/mantenimiento', Mantenimiento::class)->name('mantenimiento');
});
