<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\ServicesImpl\UserServiceImpl;

class UserController extends Controller
{
    private $userServiceImpl;
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
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headers = $this->userServiceImpl->findAllIndex()[0];
        $data = $this->userServiceImpl->findAllIndex()[1];
        return view('user.index', compact('headers', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->userServiceImpl->save($request);
        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        return view('user.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        return view('user.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $usuario)
    {
        $this->userServiceImpl->update($request, $usuario);
        return redirect()->route('usuarios.index');
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
