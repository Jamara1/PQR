<?php

namespace App\Exports;

use App\Models\PQR;
use Maatwebsite\Excel\Concerns\FromCollection;

class PQRExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PQR::all();
    }
}
