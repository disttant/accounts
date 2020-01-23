@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">Change your name</h4>
        <small>What is your real name? who are you? are you real?</small>
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
                <form action="/profile/change/name" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="TheInput" class="font-weight-bold">Write your entire name</label>
                        <input name="name" type="text" class="form-control" id="TheInput" placeholder="Sad void..." value="{{ $value }}" required>
                        <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                    </div>
                    <button type="submit" class="btn btn-secondary">Change</button>
                </form>
            </div>
        </li>
        
    </ul>

@endsection
