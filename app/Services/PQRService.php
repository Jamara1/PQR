<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\PQR;

interface PQRService extends Services
{
    public function findPqrForUser(): array;
    public function updateStatus($pqr): PQR;
}
