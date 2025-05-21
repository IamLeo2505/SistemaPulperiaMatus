<?php

namespace App\Exports;

use App\Models\usuario;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReporteUsuarioExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return usuario::all();
    }
}
