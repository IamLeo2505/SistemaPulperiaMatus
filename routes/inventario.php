<?php
use App\Livewire\Inventario\Inventario;
use App\Livewire\Inventario\CrearProducto;
use App\Livewire\Inventario\Categorias;
use App\Livewire\Inventario\Marcas;

Route::middleware(['auth'])->group(function () {
    Route::get('/inventario', Inventario::class)->name('inventario');
    Route::get('/inventario/crear-producto', CrearProducto::class)->name('inventario.crear');
    Route::get('/inventario/marcas', Marcas::class)->name('inventario.marcas');
    Route::get('/inventario/categorias', Categorias::class)->name('inventario.categorias');
});
