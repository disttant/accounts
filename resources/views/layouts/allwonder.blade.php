@extends('layouts.wrapper')



@push('styles')
    <link href="{{ asset('css/allwonder.css') }}" rel="stylesheet">
@endpush



@section('app')
    <div id="allwonder-wrapper" class="d-flex flex-column align-items-center justify-content-center p-2" >

        <div class="container p-0">
            @yield('content')
        </div>

    </div>
    
@endsection