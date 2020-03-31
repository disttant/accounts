@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">{{ __('Nodes') }}</h4>
        <small>{{ __('Manage your houses')}}</small>
    </div>

    <div class="my-4">
        <a href="#" class="btn btn-primary">
            {{ __('Create a node') }}
        </a>
    </div>

    @if ( count($nodeList['nodes']) === 0 )

        <div class="my-4">
            <div class="alert alert-warning" role="alert">
                {{ __('No properties added') }}
            </div>
        </div>

    @else

        <ul class="list-group">
            @foreach ( $nodeList['nodes'] as $node )
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex p-2 align-items-stretch">
                        <div class="d-flex flex-grow-1 justify-content-between align-items-center">
                            <div class="d-flex flex-column mb-3 flex-grow-1">
                                <div class="font-weight-bold">Name</div>
                                <div>{{ $node->name}}</div>
                                <div class="font-weight-bold">ID</div>
                                <div>{{ $node->id}}</div>
                                <div class="font-weight-bold">Key</div>
                                <div>{{ $node->key}}</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <i class="material-icons align-middle">keyboard_arrow_right</i>
                        </div>
                    </div>
                </a>
            @endforeach
        </ul>

    @endif

@endsection
