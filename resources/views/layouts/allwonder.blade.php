@extends('layouts.wrapper')



@push('styles')
    <style>
        #allwonder-wrapper {
            background: url( "{{asset('/img/bg.jpg')}}" ) no-repeat center center fixed;
            background-size: cover;
            height: 100%;
            overflow: hidden;
        }
    </style>
@endpush



@section('app')
    <div id="allwonder-wrapper" class="d-flex align-items-center justify-content-center" style="height: 100vh; background-color: #eeeeee !important;">
        @yield('content')
    </div>
@endsection