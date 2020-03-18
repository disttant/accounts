@extends('layouts.wrapper')



@push('styles')
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet">
@endpush



@section('app')
    <nav class="navbar sticky-top navbar-expand-md navbar-light bg-white shadow-sm border-0" style="background-color: white !important; ">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <!--<img src="{{ asset('img/512px.png') }}" class="align-middle" style="width: 2rem; height: 2rem;">-->
                <span class="align-middle text-lowercase font-weight-light">{{ config('app.vendor') }}</span>
                <span class="mx-1 align-middle text-secondary text-lowercase font-weight-light">{{ config('app.name') }}</span>

                @if ( Auth::user()->hasRole('admin') == true )
                    <i class="material-icons md-18 align-middle">lock_open</i>
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
        
        {{-- Top menu --}}
        <div class="menu scrollmenu">

            <a href="{{ url('profile') }}">{{ __('Profile') }}</a>

            <a href="{{ url('authorizations') }}">{{ __('Authorizations') }}</a>
            
            @if ( Auth::user()->hasAnyRole(['admin', 'developer']) == true )
                <a href="{{ url('developers') }}">{{ __('Developers') }}</a>
            @endif

            <a href="{{ url('contact') }}">{{ __('Contact') }}</a>
        </div>

        {{-- Side menu --}}
        <div class="d-flex flex-row justify-content-start align-items-stretch" style="min-height: 100vh !important;">

            <div class="align-self-stretch py-4 shadow menu side_panel">

                <div class="d-flex flex-column">
                    <a href="{{ url('profile') }}" class="pl-5 py-2 text-decoration-none">
                        <i class="material-icons align-middle mr-2">face</i>
                        <span class="align-middle">{{ __('Profile') }}</span>
                    </a>
                </div>

                <div class="d-flex flex-column">
                    <a href="{{ url('authorizations') }}" class="pl-5 py-2 text-decoration-none">
                        <i class="material-icons align-middle mr-2">lock_open</i>
                        <span class="align-middle">{{ __('Authorizations') }}</span>
                    </a>
                </div>
                
                @if ( Auth::user()->hasAnyRole(['admin', 'developer']) == true )
                    <div class="d-flex flex-column">
                        <a href="{{ url('developers') }}" class="pl-5 py-2 text-decoration-none">
                            <i class="material-icons align-middle mr-2">build</i>
                            <span class="align-middle">{{ __('Developers') }}</span> 
                        </a>
                    </div>
                @endif

                <div class="d-flex flex-column">
                    <a href="{{ url('contact') }}" class="pl-5 py-2 text-decoration-none">
                        <i class="material-icons align-middle mr-2">question_answer</i>
                        <span class="align-middle">{{ __('Contact') }}</span>
                    </a>
                </div>

            </div>

            <div class="w-100 p-4 text-break" style="background-color: #eeeeee;">
                @yield('content') 

                <div class="d-flex justify-content-center my-5 text-muted">
                    &copy; {{ config('app.vendor') }}
                </div>
            </div>

        </div>
    </main>



@endsection