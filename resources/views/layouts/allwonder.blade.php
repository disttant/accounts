@extends('layouts.wrapper')



@push('styles')
    <link href="{{ asset('css/allwonder.css') }}" rel="stylesheet">
@endpush



@section('app')
    <div id="allwonder-wrapper" class="d-flex flex-column align-items-center justify-content-center" >
        <div class="container p-0">

            <div class="m-0 py-1 bg-fade rounded-top"></div>

            <div class="card p-3 py-5 container shadow-sm">

                <div class="card-header bg-transparent m-0 p-0 py-5">
                    <div class="row m-0">
                        <div class="col-md-6 offset-md-3">
                            <img src="{{ asset('img/512px.png') }}" class="align-middle mr-2" style="width: 3rem; height: 3rem;">
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