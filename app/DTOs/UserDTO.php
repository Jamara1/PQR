<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Models\User;

final class UserDTO
{
    public function userIndexMap()
    {
        $data = User::all()->map(function ($user) {

            return [
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->roles[0]->name,
                'created_at' => $user->created_at->format('d-m-Y'),
                'options' => [
                    'edit' => [
                        'name' => 'edit',
                        'route' => route('usuarios.edit', $user->id)
                    ],
                    'show' => [
                        'name' => 'show',
                        'route' => route('usuarios.show', $user->id)
                    ]
                ]
            ];
        });

        return $data;
    }
}
