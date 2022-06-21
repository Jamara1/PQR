@extends('layouts.app')

@section('content')
    <x-card title="Home">
        <div class="row">
            <div class="d-flex col-sm-12 mb-5">
                <img src="{!! asset('images/pqr-logo.png') !!}" alt="pqr-logo.png" width="50" height="50">

                <h1 class="w-100 mt-2 text-center">PQR</h1>
            </div>

            <div class="col-sm-12 px-4">

                <h3>{{ __('Introduction') }}</h3>
                <p class="text-justify">
                    {{ __('pqr.introduction') }}
                </p>

                <br>

                <h3>{{ __('Definition') }}</h3>
                <p class="text-justify">
                    {{ __('pqr.definition_1') }}
                </p>

                <br>

                <p class="text-justify">
                    {{ __('pqr.definition_2') }}
                </p>

                @can('pqr.create')
                    <div class="text-end">
                        <a class="btn btn-success" href="{{ route('pqr.create') }}">
                            {{ __('Create a PQR') }}
                        </a>
                    </div>
                @endcan
            </div>
        </div>
    </x-card>
@endsection
