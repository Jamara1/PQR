<?php

namespace App\Exports;

use App\DTOs\PQRDTO;
use App\Models\PQR;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PQRExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return [
            'Id',
            __('User'),
            __('PQR type'),
            __('Status'),
            __('Created at'),
            __('Deadline date'),
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $pqrs = PQR::all();
        $pqrDTO = new PQRDTO($pqrs);

        return $pqrDTO->exportMap();
    }
}
