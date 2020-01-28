@extends('layouts.wrapper')



@push('styles')
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet">
@endpush



@section('app')
    <nav class="navbar sticky-top navbar-expand-md navbar-light bg-white shadow-sm border border-bottom" style="background-color: #eeeeee !important;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('img/512px.png') }}" style="width: 2rem; height: 2rem;">
                <span>{{ config('app.name') }}</span>

                @if ( Auth::user()->hasRole('admin') == true )
                    <span class="badge badge-danger">
                        <i class="material-icons md-18">lock_open</i>
                    </span>
                @endif
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
                                {{ strtolower(Auth::user()->email) }} 
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    Account
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
        
        <div class="menu scrollmenu">
            

            <a href="/profile">Profile</a>
            
            @if ( Auth::user()->hasAnyRole(['admin', 'developer']) == true )
                <a href="/developers">Developers</a>
            @endif

            <a href="#">Contact</a>

        </div>

        <div class="d-flex flex-row justify-content-start align-items-stretch" style="min-height: 100vh !important;">

            <div class="align-self-stretch py-4 shadow menu side_panel ">
                <ul>
                    <li class="pl-5 py-2">
                        <a href="/profile" class="text-decoration-none ">Profile</a>
                    </li>
                    
                    @if ( Auth::user()->hasAnyRole(['admin', 'developer']) == true )
                        <li class="pl-5 py-2">
                            <a href="/developers" class="text-decoration-none ">Developers</a>
                        </li>
                    @endif

                    <li class="pl-5 py-2">
                        <a href="#" class="text-decoration-none ">Contact</a>
                    </li>

                </ul>
            </div>

            <div class="w-100 p-4 text-break">
                @yield('content')

                <div class="d-flex justify-content-center my-5 text-muted">
                    &copy; ALKE Systems
                </div>
            </div>

        </div>
    </main>



@endsection