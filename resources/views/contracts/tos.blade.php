@extends('layouts.allwonder')

@section('content')

    <div class="card pb-5 container shadow-sm">
    
        <div class="card-header bg-transparent border-0 p-4">
            <img src="{{ asset('img/512px.png') }}" class="align-middle mr-2" style="width: 3rem; height: 3rem;">
            <h1 class="font-weight-light d-inline align-middle text-lowercase">
                {{ config('app.vendor') }}   
            </h1>
            <h1 class="font-weight-light d-inline align-middle text-lowercase text-secondary">
                {{ __('Terms of Service') }}
            </h1>
        </div>

        <div class="card-body">
            Here the most important contract
        </div>
    </div>

@endsection
