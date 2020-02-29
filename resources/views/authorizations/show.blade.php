@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">{{ __('Authorizations') }}</h4>
        <small>{{ __('Do NOT authorize too much fake buddies, dude!')}}</small>
    </div>

    <!--<div class="alert alert-warning" role="alert">
        Here you can revoke permissions to third party applications
        @php
            //var_dump( Laravel\Passport\Passport::scopes() );
        @endphp
    </div>-->

    <ul class="list-group">

        @forelse ($clients as $client)
            <div class="list-group-item list-group-item-action">
                <div class="d-flex p-2 align-items-stretch">
                    <div class="d-flex flex-grow-1 flex-column">
                        <div class="p-2">
                            <div class="font-weight-bold">{{ __('Application name') }}</div>
                            <div>{{ $client->name }}</div>
                        </div>
                        <!--<div class="p-2"></div>-->
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ url('authorizations/revoke/' . $client->id) }}" class="btn btn-primary" onclick="return confirm('{{ __("Sure you want to revoke permissions to this application?") }}');">
                            {{ __('Revoke') }}
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p>No authorizations given</p>
        @endforelse

    </ul>

@endsection
