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

    <div class="d-flex flex-row justify-content-start align-items-stretch" style="height: 100%">
        <div class="menu sidebar py-4 shadow">
            <ul>
                @foreach ( $menuItems as $item => $uri)
                <li class="pl-5 py-1"><a href="{{$uri}}">{{$item}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="w-100 p-4 text-break">
            @yield('contentt')
        </div>
    </div>
@endsection