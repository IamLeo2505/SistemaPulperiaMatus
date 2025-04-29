<?php

use Illuminate\Support\Facades\Route;

// Página de bienvenida
Route::view('/', 'index')->name('login');

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

// Agrupamos rutas por funcionalidad
require __DIR__.'/login.php';
require __DIR__.'/forgot-password.php';
require __DIR__.'/dashboard.php';
require __DIR__.'/ventas.php';
require __DIR__.'/compras.php';
require __DIR__.'/inventario.php';
require __DIR__.'/clientes.php';
require __DIR__.'/proveedores.php';
require __DIR__.'/empleados.php';
require __DIR__.'/usuarios.php';
require __DIR__.'/mantenimiento.php';
require __DIR__.'/reportes.php';
require __DIR__.'/otros.php';

