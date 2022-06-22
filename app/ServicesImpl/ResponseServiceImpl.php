<?php

declare(strict_types=1);

namespace App\ServicesImpl;

use App\Services\Response;
use Illuminate\Http\JsonResponse;

class ResponseServiceImpl implements Response
{

    public function responseJson($code, $data): JsonResponse
    {
        $status = 'ok';

        if ($code != 200) {
            $status = 'bad';
        }

        return response()->json([
            'status' => $status,
            'data' => $data
        ], $code);
    }
}
