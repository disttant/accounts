@extends('layouts.wrapper')



@push('styles')
    <link href="{{ asset('css/allwonder.css') }}" rel="stylesheet">
@endpush



@section('app')
    <div id="allwonder-wrapper" class="d-flex align-items-center justify-content-center" >
        @yield('content')
    </div>
@endsection