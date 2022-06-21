@extends('layouts.app')

@section('content')
    <x-card title="User" showReturn="true" routeReturn="usuarios.index">

        <div class="row">
            <div class="col-sm-6 mb-3">
                <x-textview label="Name" data="{{ $usuario->name }}" />
            </div>

            <div class="col-sm-6 mb-3">
                <x-textview label="Role" data="{{ $usuario->roles[0]->name }}" />
            </div>

            <div class="col-sm-12">
                <x-textview label="E-Mail Address" data="{{ $usuario->email }}" />
            </div>
        </div>
    </x-card>
@endsection
