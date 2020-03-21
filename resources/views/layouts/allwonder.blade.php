@extends('layouts.wrapper')



@push('styles')
    <link href="{{ asset('css/allwonder.css') }}" rel="stylesheet">
@endpush



@section('app')
    <div id="allwonder-wrapper" class="d-flex flex-column align-items-center justify-content-center p-2" >
        <div class="container p-0">
            <div class="card pb-5 container shadow-sm">
                <div class="py-2 w-100 bg-fade"></div>

                <div class="card-header bg-transparent border-0 p-5">
                    <div class="row">
                        <div class="col-md-6 offset-md-3 p-0">
                            <img src="{{ asset('img/512px.png') }}" class="align-middle mr-2" style="width: 2rem; height: 2rem;">
                            <h1 class="font-weight-light d-inline align-middle text-lowercase">
                                {{ config('app.vendor') }}
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @yield('content')
                </div>

            </div>
        </div>
    </div>
    
@endsection