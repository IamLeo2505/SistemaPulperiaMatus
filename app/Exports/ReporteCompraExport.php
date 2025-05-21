<?php

namespace App\Exports;

use App\Models\compra;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReporteCompraExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return compra::all();
    }
}
