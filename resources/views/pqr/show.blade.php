@extends('layouts.app')

@section('content')
    <x-card title="PQR" showReturn="true" routeReturn="pqr.index">

        <div class="row">
            <div class="col-sm-6 mb-3">
                <x-textview label="User" data="{{ $pqr->users->name }}" />
            </div>

            <div class="col-sm-6 mb-3">
                <x-textview label="PQR type" data="{{ $pqr->pqrTypes->name }}" />
            </div>

            <div class="col-sm-12">
                <x-textview label="Subject" data="{{ $pqr->subject }}" />
            </div>
        </div>

        <form action="{{ route('pqr.change.status', $pqr->id) }}" method="post">
            {{ method_field('PUT') }}
            @csrf
            @can('pqr.edit')
                <div class="col-sm-12 text-end mt-4">
                    @switch($pqr->status)
                        @case(1)
                            <button type="submit" class="btn btn-success">
                                {{ __('New') }}
                            </button>
                        @break

                        @case(2)
                            <button type="submit" class="btn btn-warning fw-bold">
                                {{ __('In progress') }}
                            </button>
                        @break

                        @case(3)
                            <button type="submit" class="btn btn-danger" disabled>
                                {{ __('Closed') }}
                            </button>
                        @break
                    @endswitch
                </div>
            @endcan
        </form>
    </x-card>
@endsection
