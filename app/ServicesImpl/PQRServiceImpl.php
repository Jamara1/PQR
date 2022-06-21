<?php

declare(strict_types=1);

namespace App\ServicesImpl;

use App\DTOs\PQRDTO;
use App\Models\PQR;
use App\Services\PQRService;
use Illuminate\Database\Eloquent\Collection;

final class PQRServiceImpl implements PQRService
{
    public function findAll(): Collection
    {
        return PQR::all();
    }

    public function findAllIndex(): array
    {
        $pqrs = PQR::all();
        $pqrDTO = new PQRDTO($pqrs);
        $headers = [
            __('#'),
            __('User'),
            __('PQR type'),
            __('Status'),
            __('Created at'),
            __('Deadline date'),
            __('Options'),
        ];
        $data = $pqrDTO->pqrIndexMap();

        return [$headers, $data];
    }

    public function save($request): PQR
    {
        $date = date("Y-m-d H:i:s");
        $mod_date = null;

        $request['user_id'] = auth()->id();
        $request['status'] = 1;

        if ($request['pqr_type_id'] == 1) {
            //Increasing 7 days
            $mod_date = strtotime($date . "+ 7 days");
        }

        if ($request['pqr_type_id'] == 2) {
            //Increasing 3 days
            $mod_date = strtotime($date . "+ 3 days");
        }

        if ($request['pqr_type_id'] == 3) {
            //Increasing 2 days
            $mod_date = strtotime($date . "+ 2 days");
        }

        $request['deadline_date'] = date("Y-m-d H:i:s", $mod_date);

        $pqr = PQR::create($request->except('_token'));

        return $pqr;
    }

    public function update($request, $pqr): PQR
    {
        $date = date("Y-m-d H:i:s");
        $mod_date = null;

        if ($request['pqr_type_id'] == 1) {
            //Increasing 7 days
            $mod_date = strtotime($date . "+ 7 days");
        }

        if ($request['pqr_type_id'] == 2) {
            //Increasing 3 days
            $mod_date = strtotime($date . "+ 3 days");
        }

        if ($request['pqr_type_id'] == 3) {
            //Increasing 2 days
            $mod_date = strtotime($date . "+ 2 days");
        }

        $request['deadline_date'] = date("Y-m-d H:i:s", $mod_date);

        $pqr->update($request->except('_token'));

        return $pqr;
    }

    public function findPqrForUser(): array
    {
        $pqrs = PQR::where('user_id', auth()->user());
        $pqrDTO = new PQRDTO($pqrs);
        $headers = [
            __('#'),
            __('User'),
            __('PQR type'),
            __('Status'),
            __('Created at'),
            __('Deadline date'),
            __('Options'),
        ];
        $data = $pqrDTO->pqrIndexMap();

        return [$headers, $data];
    }

    public function updateStatus($pqr): PQR
    {
        if ($pqr->status == 1) {
            $pqr->update(['status' => 2]);
        } else if ($pqr->status == 2) {
            $pqr->update(['status' => 3]);
        }
        return $pqr;
    }
}
