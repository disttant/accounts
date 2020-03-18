@extends('layouts.allwonder')

@section('content')

    <div class="card pb-5 container shadow-sm">
        
        <div class="card-header bg-transparent border-0 p-4">
            <h1 class="font-weight-light d-inline align-middle text-lowercase">
                {{ config('app.vendor') }}   
            </h1>
            <h1 class="font-weight-light d-inline align-middle text-lowercase text-secondary">
                {{ __('Privacy Policy') }}
            </h1>
        </div>

        <div class="card-body">
            Here all the contract
        </div>
    </div>

@endsection
