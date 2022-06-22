<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\PQR;
use Illuminate\Database\Eloquent\Collection;

interface PQRService extends Services
{
    public function findForUser(): Collection;
    public function findPqrForUserIndex(): array;
    public function updateStatus($pqr): PQR;
}
