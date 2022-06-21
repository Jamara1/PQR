@extends('layouts.app')

@section('content')
    <x-card title="Users" showCreate="true" routeCreate="usuarios.create">
        <div class="row">
            <div class="col-sm-12">
                <x-table :headers=$headers :data=$data></x-table>
            </div>
        </div>
    </x-card>
@endsection
