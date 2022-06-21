@extends('layouts.app')

@section('content')
    <x-card title="Change Password" showReturn="true" routeReturn="home">
        <form action="{{ route('password.update', $usuario->id) }}" method="post">
            @csrf
            {{ method_field('PUT') }}
            <div class="row">
                <div class="col-sm-12 mb-2">
                    <x-form-input label="Password" name="password" type="password"></x-form-input>
                </div>

                <div class="col-sm-12">
                    <x-form-input label="Confirm Password" name="password_confirmation" type="password"></x-form-input>
                </div>

                <div class="col-sm-12 text-end mt-4">
                    <button type="submit" class="btn btn-success">
                        {{ __('Send') }}
                    </button>
                </div>
            </div>
        </form>
    </x-card>
@endsection
