<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\JsonResponse;

interface Response
{
    public function responseJson(int $code, $data): JsonResponse;
}
