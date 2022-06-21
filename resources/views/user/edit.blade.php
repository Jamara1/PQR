@extends('layouts.app')

@section('content')
    <x-card title="Edit user" showReturn="true" routeReturn="usuarios.index">

        <form action="{{ route('usuarios.update', $usuario->id) }}" method="post">
            {{ method_field('PUT') }}
            @csrf

            <div class="col-sm-12 mb-2">
                <x-form-input label="Name" name="name" type="text" :dataShow=$usuario />
            </div>

            <div class="col-sm-12 mb-2">
                <x-form-input label="E-Mail Address" name="email" type="email" :dataShow=$usuario />
            </div>

            <div class="col-sm-12 text-end mt-4">
                <button type="submit" class="btn btn-success">
                    {{ __('Send') }}
                </button>
            </div>
        </form>
    </x-card>
@endsection
