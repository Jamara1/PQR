<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  PasswordRequest $request, User $user
     * @return void
     */
    public function update(PasswordRequest $request, User $user): void
    {
        $request['password'] = Hash::make($request['password']);
        $user->update($request->only('password'));
    }
}
