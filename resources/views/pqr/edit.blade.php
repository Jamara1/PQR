@extends('layouts.app')

@section('content')
    <x-card title="Edit PQR" showReturn="true" routeReturn="pqr.index">

        <form action="{{ route('pqr.update', $pqr->id) }}" method="post">
            {{ method_field('PUT') }}
            @csrf
            <div class="row">

                <div class="col-sm-12 mb-3">
                    <x-form-select label="PQR type" name="pqr_type_id" :data=$pqrTypes :dataEdit=$pqr></x-form-select>
                </div>

                <div class="col-sm-12">
                    <x-form-textarea label="Subject" name="subject" :dataEdit=$pqr></x-form-textarea>
                </div>

                <div class="col-sm-12 text-end mt-4">
                    <button type="submit" class="btn btn-success">
                        {{ __('Send') }}
                    </button>
                </div>
        </form>
    </x-card>
@endsection
