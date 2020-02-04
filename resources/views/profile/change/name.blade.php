@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">{{ __('Change your name') }}</h4>
        <small>{{ __('Your entire name and surnames') }}</small>
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
                <form action="{{ url('profile/change/name') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input name="name" type="text" class="form-control" placeholder="{{ __('Entire name') }}" value="{{ $value }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Accept') }}</button>
                </form>
            </div>
        </li>
        
    </ul>

@endsection
