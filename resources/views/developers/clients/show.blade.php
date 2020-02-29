@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">{{ __('Developers') }}</h4>
        <small>{{ __('Show you are a god and build an app') }}</small>
    </div>

    <div class="my-4">
        <a href="{{ url('developers/clients/create') }}" class="btn btn-primary">
            {{ __('Create an app!') }}
        </a>
    </div>

    <ul class="list-group">

        @if ( count($clients) === 0 )
            <div class="alert alert-warning">
                {{ __('Click the botton and start the process.') }}
            </div>
        @endif


        @foreach ($clients as $client)

            <div class="list-group-item list-group-item-action">
                <div class="d-flex p-2 align-items-stretch">
                    <div class="d-flex flex-grow-1 justify-content-between align-items-center">
                        <div class="d-flex flex-column mb-3 flex-grow-1 ">
                            <div class="my-2">
                                <div class="font-weight-bold">{{ __('Application name') }}</div>
                                <div>{{ $client['name'] }}</div>
                            </div>

                            <div class="my-2">
                                <div class="font-weight-bold">{{ __('Data destination')  }}</div>
                                <div>{{ $client['redirect'] }}</div>
                            </div>

                            <div class="my-2">
                                <div class="font-weight-bold">
                                    {{ __('Credentials') }}
                                </div>

                                <div class="d-flex align-content-center">
                                    <div class="p-0 py-2 flex-shrink-1 my-auto">
                                        <i class="material-icons align-middle text-muted">security</i>
                                    </div>
                                    <div class="p-0 py-2 px-3 w-100 align-self-center">
                                        {{ $client['id'] }}
                                    </div>
                                </div>
                                <div class="d-flex align-content-center">
                                    <div class="p-0 py-2 flex-shrink-1 my-auto">
                                        <i class="material-icons align-middle text-muted">vpn_key</i>
                                    </div>
                                    <div class="p-0 py-2 px-3 w-100 align-self-center">
                                        {{ $client['secret'] }}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <form action="{{ url('developers/clients/delete') }}" method="POST">
                                    @csrf
                                    <!--@method('DELETE')-->
                                    <input type="hidden" name="id" value="{{ $client['id'] }}">
                                    <button type="submit" class="btn btn-primary" onclick="return confirm('{{ __("Sure you want to delete this app?") }}');">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

    </ul>

@endsection
