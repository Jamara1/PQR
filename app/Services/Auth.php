<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Mockery\Matcher\Any;

interface Auth
{
    public function register($request): User;
    public function login($request): array;
    public function userProfile(): User;
    public function logout(): string;
}
