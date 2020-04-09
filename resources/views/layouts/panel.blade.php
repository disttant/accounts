@extends('layouts.wrapper')



@push('styles')
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet">
@endpush



@section('app')
    <div class="sticky-top">

        {{-- Top bar --}}
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm border-0" style="background-color: white !important; ">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/512px.png') }}" class="align-middle mr-2" style="width: 2rem; height: 2rem;">
                    <span class="align-middle text-lowercase font-weight-light">{{ config('app.vendor') }}</span>
                    <!--<span class="mx-1 align-middle text-secondary text-lowercase font-weight-light">{{ config('app.name') }}</span>-->
                </a>
                <div class="dropdown" style="z-index: 1030 !important;">
                    <button class="btn btn-link text-decoration-none text-reset p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">account_circle</i>
                        <i class="material-icons">arrow_drop_down</i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        @if ( Auth::user()->hasRole('admin') == true )
                            <h6 class="dropdown-header py-3 text-warning">
                                <i class="material-icons md-18 align-middle">lock_open</i>
                                <span class="align-middle">Warning!</span>
                            </h6>
                        @endif
                        <h6 class="dropdown-header py-3">{{ strtolower(Auth::user()->email) }}</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        {{-- Top menu --}}
        <div class="menu scrollmenu sticky-top" style="top:56px;">
            <a href="{{ url('profile') }}">{{ __('Profile') }}</a>
            <a href="{{ url('authorizations') }}">{{ __('Authorizations') }}</a>
            <a href="{{ url('cards') }}">{{ __('Cards') }}</a>
            @if ( Auth::user()->hasAnyRole(['admin', 'business']) == true )
                <a href="{{ url('nodes') }}">{{ __('Nodes') }}</a>
            @endif
            @if ( Auth::user()->hasAnyRole(['admin']) == true )
                <a href="{{ url('developers') }}">{{ __('Developers') }}</a>
            @endif
        </div>

    </div>



    <main class="p-0">

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

                <div class="d-flex flex-column">
                    <a href="{{ url('cards') }}" class="pl-5 py-2 text-decoration-none">
                        <i class="material-icons align-middle mr-2">vpn_key</i>
                        <span class="align-middle">{{ __('Cards') }}</span>
                    </a>
                </div>
                
                @if ( Auth::user()->hasAnyRole(['admin', 'business']) == true )
                    <div class="d-flex flex-column">
                        <a href="{{ url('nodes') }}" class="pl-5 py-2 text-decoration-none">
                            <i class="material-icons align-middle mr-2">home_work</i>
                            <span class="align-middle">{{ __('Nodes') }}</span>
                        </a>
                    </div>
                @endif

                @if ( Auth::user()->hasAnyRole(['admin']) == true )
                    <div class="d-flex flex-column">
                        <a href="{{ url('developers') }}" class="pl-5 py-2 text-decoration-none">
                            <i class="material-icons align-middle mr-2">build</i>
                            <span class="align-middle">{{ __('Developers') }}</span> 
                        </a>
                    </div>
                @endif

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

