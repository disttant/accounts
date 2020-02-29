@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">{{ __('Authorizations') }}</h4>
        <small>{{ __('Be careful with the apps you allow access your data!') }}</small>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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

                        <form action="{{ url('authorizations/revoke') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $client->id }}">
                            <button type="submit" class="btn btn-primary" onclick="return confirm('{{ __("Sure you want to revoke all permissions for this application?") }}');">
                                {{ __('Revoke') }}
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning">
                {{ __('There are no authorized applications to access your data yet') }}
            </div>
        @endforelse

    </ul>

@endsection
