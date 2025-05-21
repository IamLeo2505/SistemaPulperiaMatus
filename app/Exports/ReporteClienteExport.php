<?php

namespace App\Exports;

use App\Models\cliente;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReporteClienteExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return cliente::all();
    }
}
