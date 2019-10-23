@extends('layouts.app')


@section('content')



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
            @yield('contentt')
        </div>
    </div>
@endsection