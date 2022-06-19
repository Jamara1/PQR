@extends('layouts.app')

@section('content')
    <x-card title="PQR" showCreate="true" routeCreate="usuarios.create">
        <div class="row">
            <div class="col-sm-12">
                <a href="http://">

                </a>
            </div>
            <div class="col-sm-12">
                <x-table></x-table>
            </div>
        </div>
    </x-card>
@endsection
