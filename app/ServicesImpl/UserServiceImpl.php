<?php

declare(strict_types=1);

namespace App\ServicesImpl;

use App\DTOs\UserDTO;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\Services;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserServiceImpl implements Services
{

    public function findAll(): Collection
    {
        return User::all();
    }

    public function findAllIndex(): array
    {
        $userDTO = new UserDTO();
        $headers = [
            __('#'),
            __('Name'),
            __('E-Mail Address'),
            __('Role'),
            __('Created at'),
            __('Options'),
        ];
        $data = $userDTO->userIndexMap();

        return [$headers, $data];
    }

    public function save($request): User
    {
        $request['password'] = Hash::make($request['password']);
        $user = User::create($request->except('_token'));
        $user->assignRole('admin');

        return $user;
    }

    public function update($request, $user): User
    {
        $user->update($request->only('name', 'email'));
        return$user;
    }

    public function destroy($model): array
    {
        return [];
    }
}
