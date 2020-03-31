@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">{{ __('Nodes') }}</h4>
        <small>{{ __('Manage your properties like a lord')}}</small>
    </div>

    <div class="my-4">
        <a href="{{ url('nodes/create') }}" class="btn btn-primary">
            {{ __('Create a node') }}
        </a>
    </div>

    @if ( count($nodeList['nodes']) === 0 )

        <div class="my-4">
            <div class="alert alert-warning" role="alert">
                {{ __('No nodes added yet. Add one to start the magic.') }}
            </div>
        </div>

    @else

        <ul class="list-group">
            @foreach ( $nodeList['nodes'] as $node )
                <div class="list-group-item list-group-item-action">
                    <div class="d-flex p-2 align-items-stretch">
                        <div class="d-flex flex-grow-1 justify-content-between align-items-center">
                            <div class="d-flex flex-column mb-3 flex-grow-1 ">

                                <div class="my-2">
                                    <div class="font-weight-bold">{{ __('Node name') }}</div>
                                    <div>{{ $node['name'] }}</div>
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
                                            {{ $node['id'] }}
                                        </div>
                                    </div>
                                    <div class="d-flex align-content-center">
                                        <div class="p-0 py-2 flex-shrink-1 my-auto">
                                            <i class="material-icons align-middle text-muted">vpn_key</i>
                                        </div>
                                        <div class="p-0 py-2 px-3 w-100 align-self-center">
                                            {{ $node['key'] }}
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-row mt-3 border border-danger">
                                    <div class="border border-info">
                                        <form action="{{ url('nodes/change/key') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $node['id'] }}">
                                            <input type="hidden" name="key" value="true">
                                            <button type="submit" class="btn btn-primary align-middle" onclick="return confirm('{{ __("Sure you want to regenerate the key?") }}');">
                                                <i class="material-icons align-middle md-24">refresh</i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="border border-info">
                                        <form action="{{ url('nodes/remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $node['id'] }}">
                                            <button type="submit" class="btn btn-primary align-middle" onclick="return confirm('{{ __("Sure you want to delete this node?") }}');">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </ul>

    @endif

@endsection
