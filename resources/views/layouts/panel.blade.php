@extends('layouts.wrapper')



@push('styles')
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet">
@endpush



@section('app')
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm border border-bottom" style="background-color: #eeeeee !important;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('img/512px.png') }}" style="width: 2rem; height: 2rem;">
                <span>{{ config('app.name', 'Laravel') }}</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="material-icons align-middle">face</i>
                                {{ ucwords(Auth::user()->name, '-') }} 
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    Profile
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>



    <main class="p-0">
        @php
            $menuItems = [
                'My profile' => '/profile',
                'Developers' => '/developers',
                'Contact' => '#'    
            ];
        @endphp

        <div class="menu scrollmenu">
            @foreach ( $menuItems as $item => $uri)
                <a href="{{$uri}}">{{$item}}</a>
            @endforeach
        </div>

        <div class="d-flex flex-row justify-content-start align-items-stretch" style="min-height: 100vh !important;">

            <div class="align-self-stretch py-4 shadow menu side_panel ">
                <ul>
                    @foreach ( $menuItems as $item => $uri)
                    <li class="pl-5 py-2"><a href="{{$uri}}">{{$item}}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="w-100 p-4 text-break">
                @yield('content')
            </div>
        </div>
    </main>



@endsection