    <?php

    use App\Http\Controllers\ReporteController;
    use Illuminate\Support\Facades\Route;
    use App\Livewire\Login\Login;
    use App\Livewire\Inventario\Categorias;
    use App\Livewire\Inventario\Marcas;
    use App\Livewire\Inventario\CrearProducto;

    //Página de inicio
    Route::get('/', Login::class)->name('login.index');

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
    require __DIR__.'/recover-password.php';
    require __DIR__.'/dashboard.php';
    require __DIR__.'/ventas.php';
    require __DIR__.'/compras.php';
    require __DIR__.'/inventario.php';
    require __DIR__.'/clientes.php';
    require __DIR__.'/proveedores.php';
    require __DIR__.'/empleados.php';
    require __DIR__.'/usuarios.php';
    require __DIR__.'/mantenimiento.php';
    require __DIR__.'/acercaDe.php';
    require __DIR__.'/soporte.php';
    require __DIR__.'/reportes.php';
    require __DIR__.'/otros.php';


    Route::get('/inventario/categorias', Categorias::class)->name('inventario.categorias');
    Route::get('/inventario/marcas', Marcas::class)->name('inventario.marcas');
    Route::get('/inventario/crear-producto', CrearProducto::class)->name('inventario.crear');
    Route::get('lang/{locale}', function ($locale) {
        session()->put('locale', $locale);
        app()->setLocale($locale);
        return redirect()->back();
    })->name('lang.switch');


    Route::get('/reportes/exportar/{tipo}', [ReporteController::class, 'exportar'])->name('reportes.exportar');

