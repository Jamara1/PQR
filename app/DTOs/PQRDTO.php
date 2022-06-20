<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Models\PQR;
use DateTime;

final class PQRDTO
{
    public function pqrIndexMap()
    {
        $data = PQR::all()->map(function ($pqr) {

            return [
                'username' => $pqr->users->name,
                'pqr_type' => $pqr->pqrTypes->name,
                'status' => $pqr->status,
                'created_at' => $pqr->created_at->format('d-m-Y'),
                'deadline_date' => date("d-m-Y", strtotime($pqr->deadline_date)),
                'options' => [
                    'edit' => [
                        'name' => 'edit',
                        'route' => route('pqr.edit', $pqr->id)
                    ],
                    'show' => [
                        'name' => 'show',
                        'route' => route('pqr.show', $pqr->id)
                    ],
                    'destroy' => [
                        'name' => 'destroy',
                        'route' => route('pqr.destroy', $pqr->id)
                    ],
                ]
            ];
        });

        return $data;
    }
}
