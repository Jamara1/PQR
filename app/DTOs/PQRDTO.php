<?php

declare(strict_types=1);

namespace App\DTOs;

final class PQRDTO
{

    private $pqrs;

    public function __construct($pqrs)
    {
        $this->pqrs = $pqrs;
    }

    public function pqrIndexMap()
    {
        $data = $this->pqrs->map(function ($pqr) {

            $status = '';
            $options = [
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
            ];

            if ($pqr->status == 1) {
                $status = __('New');
            } else if ($pqr->status == 2) {
                $status = __('In progress');
            } else {
                $status = __('Closed');
                $options = [
                    'show' => [
                        'name' => 'show',
                        'route' => route('pqr.show', $pqr->id)
                    ],
                ];
            }

            return [
                'username' => $pqr->users->name,
                'pqr_type' => $pqr->pqrTypes->name,
                'status' => $status,
                'created_at' => $pqr->created_at->format('d-m-Y'),
                'deadline_date' => date("d-m-Y", strtotime($pqr->deadline_date)),
                'options' => $options
            ];
        });

        return $data;
    }

    public function exportMap() {
        $data = $this->pqrs->map(function ($pqr) {

            $status = '';

            if ($pqr->status == 1) {
                $status = __('New');
            } else if ($pqr->status == 2) {
                $status = __('In progress');
            } else {
                $status = __('Closed');
            }

            return [
                'id' => $pqr->id,
                'username' => $pqr->users->name,
                'pqr_type' => $pqr->pqrTypes->name,
                'status' => $status,
                'created_at' => $pqr->created_at,
                'deadline_date' => date("d-m-Y", strtotime($pqr->deadline_date)),
            ];
        });

        return $data;
    }
}
