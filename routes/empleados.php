<?php
use App\Livewire\Empleados\empleados;

Route::middleware(['auth'])->group(function () {
    Route::get('/empleados', Empleados::class)->name('empleados');
});
