<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\ServicesImpl\ResponseServiceImpl;
use App\ServicesImpl\UserServiceImpl;

class UserController extends Controller
{
    private $userServiceImpl;
    private $responseServiceImpl;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:user.index|user.create|user.edit|user.delete', ['only' => ['index']]);
        $this->middleware('permission:user.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user.edit', ['only' => ['edit', 'update', 'updatePassword']]);
        $this->middleware('permission:user.delete', ['only' => ['destroy']]);

        $this->userServiceImpl = new UserServiceImpl();
        $this->responseServiceImpl = new ResponseServiceImpl();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userServiceImpl->findAll();
        return $this->responseServiceImpl->responseJson(200, $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = $this->userServiceImpl->save($request);
        return $this->responseServiceImpl->responseJson(200, $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->responseServiceImpl->responseJson(200, $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $this->userServiceImpl->update($request, $user);
        return $this->responseServiceImpl->responseJson(200, $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
