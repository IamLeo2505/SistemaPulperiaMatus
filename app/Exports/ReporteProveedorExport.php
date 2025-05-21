<?php

namespace App\Exports;

use App\Models\proveedor;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReporteProveedorExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return proveedor::all();
    }
}
