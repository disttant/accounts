


        
@extends('layouts.allwonder')

@section('content')


    <div class="row">
        <div class="col-md-6 offset-md-3 border">
            <img src="{{ asset('img/isometric.png') }}" style="height: 10rem; width: 10rem;">
            <h1 class="display-4">@yield('code', __('Oh no'))</h1>
            <h1 class="font-weight-light">@yield('message')</h1>
            <div class="mt-5">
                <a href="{{ app('router')->has('home') ? route('home') : url('/') }}">
                    <button type="button" class="btn btn-primary">
                        {{ __('Go Home') }}
                    </button>
                </a>
            </div>
        </div>

    </div>


@endsection