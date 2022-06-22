<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\ServicesImpl\ResponseServiceImpl;
use App\ServicesImpl\AuthServiceImpl;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    private $authServiceImpl;
    private $responseServiceImpl;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authServiceImpl = new AuthServiceImpl();
        $this->responseServiceImpl = new ResponseServiceImpl();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function register(UserRequest $request)
    {
        $user = $this->authServiceImpl->register($request);
        return $this->responseServiceImpl->responseJson(200, $user);
    }

    public function login(LoginRequest $request)
    {
        $user = $this->authServiceImpl->login($request);
        return $this->responseServiceImpl->responseJson($user[0], $user[1]);
    }

    public function userProfile()
    {
        $user = $this->authServiceImpl->userProfile();
        return $this->responseServiceImpl->responseJson(200, $user);
    }

    public function logout()
    {
        $user = $this->authServiceImpl->logout();
        return $this->responseServiceImpl->responseJson(200, $user);
    }
}
