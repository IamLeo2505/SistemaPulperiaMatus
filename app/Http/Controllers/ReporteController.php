<?php

namespace App\Http\Controllers;

use App\Exports\{
    ReporteProveedorExport, ReporteCategoriasExport, ReporteClienteExport, 
    ReporteEmpleadoExport, ReporteVentasExport, ReporteCompraExport,
    ReporteUsuarioExport, ReporteMarcaExport, ReporteInventarioExport
};
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function exportar($tipo)
    {
        return match($tipo) {
            'proveedores' => Excel::download(new ReporteProveedorExport, 'reporte_proveedores.xlsx'),
            'clientes' => Excel::download(new ReporteClienteExport, 'reporte_clientes.xlsx'),
            'ventas' => Excel::download(new ReporteVentasExport, 'reporte_ventas.xlsx'),
            'compras' => Excel::download(new ReporteCompraExport, 'reporte_compras.xlsx'),
            'empleados' => Excel::download(new ReporteEmpleadoExport, 'reporte_empleados.xlsx'),
            'usuarios' => Excel::download(new ReporteUsuarioExport, 'reporte_usuarios.xlsx'),
            'marca' => Excel::download(new ReporteMarcaExport, 'reporte_marcas.xlsx'),
            'inventario' => Excel::download(new ReporteInventarioExport, 'reporte_inventario.xlsx'),
            'categoria' => Excel::download(new ReporteCategoriasExport, 'reporte_categorias.xlsx'),
            default => abort(404),
        };
    }
}
