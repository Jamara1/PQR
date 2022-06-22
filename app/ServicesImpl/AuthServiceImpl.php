<?php

declare(strict_types=1);

namespace App\ServicesImpl;

use App\Models\User;
use App\Services\Auth;
use Illuminate\Support\Facades\Hash;

class AuthServiceImpl implements Auth
{

    public function register($request): User
    {
        $request['password'] = Hash::make($request['password']);
        $user = User::create($request->all());
        $user->assignRole('user');

        return $user;
    }

    public function login($request): array
    {
        $user = User::where("email",$request->email)->first();

        if (isset($user->id)) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('auth_token')->plainTextToken;
                return [200, ['_token' => $token]];
            } else {
                return [404, 'The password incorrect'];
            }
        } else {
            return [404, 'The user is not registered'];
        }
    }

    public function userProfile(): User
    {
        return auth()->user();
    }

    public function logout(): string
    {
        auth()->user()->tokens()->delete();

        return 'Session successfully closed!';
    }
}
