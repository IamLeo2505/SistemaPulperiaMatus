<?php

namespace App\Exports;

use App\Models\categoria;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReporteCategoriasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return categoria::all();
    }
}
