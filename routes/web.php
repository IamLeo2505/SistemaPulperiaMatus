<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
Route::get('/', function () {
    return view('template');
});

// Rutas del sistema
Route::get('/productos', [App\Http\Controllers\ProductosController::class, 'index'])->name('productos.index');
Route::get('/clientes', [App\Http\Controllers\ClientesController::class, 'index'])->name('clientes.index');
Route::get('/ventas', [App\Http\Controllers\VentasController::class, 'index'])->name('ventas.index');
Route::get('/compras', [App\Http\Controllers\ComprasController::class, 'index'])->name('compras.index');
Route::get('/usuarios', [App\Http\Controllers\UsuariosController::class, 'index'])->name('usuarios.index');
Route::get('/categoria', [App\Http\Controllers\CategoriaController::class, 'index'])->name('categoria.index');
Route::get('/detalleventas', [App\Http\Controllers\DetalleVentasController::class, 'index'])->name('detalleventas.index');
Route::get('/detallecompras', [App\Http\Controllers\DetalleCompraController::class, 'index'])->name('detallecompras.index');
Route::get('/proveedor', [App\Http\Controllers\ProveedorController::class, 'index'])->name('proveedor.index');
Route::get('/unidadmedida', [App\Http\Controllers\UnidadMedidaController::class, 'index'])->name('unidadmedida.index');
Route::get('/tiempo', [App\Http\Controllers\TiempoController::class, 'index'])->name('tiempo.index');
Route::get('/compras', [App\Http\Controllers\ComprasController::class, 'index'])->name('compras.index');
Route::get('/precioproducto', [App\Http\Controllers\PrecioProductoController::class, 'index'])->name('precioproducto.index');



