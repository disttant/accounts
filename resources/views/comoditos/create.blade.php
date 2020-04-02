@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">{{ __('Create new Comodito') }}</h4>
        <small>{{ __('Put here the data that accomodation gave to you') }}</small>
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
                <form action="{{ url('comoditos/create') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="pt-4 pb-4">
                            <input name="name" type="text" class="form-control" placeholder="{{ __('A trivial tag for this key')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="pt-4 pb-4">
                            <input name="name" type="text" class="form-control" placeholder="{{ __('Node ID')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="pt-4 pb-4">
                            <input name="name" type="text" class="form-control" placeholder="{{ __('Node key')}}" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    <small class="mt-4 form-text text-muted">{{ __('For your security the key will be hidden from now') }}</small>
                </form>
            </div>
        </li>
    </ul>

@endsection
