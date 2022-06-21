<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

interface Services
{
    public function findAll(): Collection;
    public function findAllIndex(): array;
    public function save($request): Model;
    public function update($request, $model): Model;
}
