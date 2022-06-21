@extends('layouts.app')

@section('content')
    <x-card title="PQR" showCreate="true" routeCreate="pqr.create">
        <div class="row">
            @role('admin')
                <div class="col-sm-12 text-end mb-3">
                    <a class="btn btn-light border border-success" href="{{ route('pqr.export') }}">
                        <img src="{!! asset('images/excel.png') !!}" alt="excel.png" width="25" height="25">
                    </a>
                </div>
            @endrole

            <div class="col-sm-12">
                <x-table :headers=$headers :data=$data></x-table>
            </div>
        </div>
    </x-card>
@endsection
