@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">{{ __('Create new node') }}</h4>
        <small>{{ __('Like a craftman, but without bricks') }}</small>
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
        <li class="list-group-item py-4">
            <div class="d-flex flex-column mb-3 flex-grow-1">
                <form action="{{ url('nodes/create') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="pt-4 pb-4">
                            <input name="name" type="text" class="form-control" placeholder="{{ __('Node name')}}" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    <small class="mt-4 form-text text-muted">{{ __('Key will be generated automatically') }}</small>
                </form>
            </div>
        </li>
    </ul>

@endsection
