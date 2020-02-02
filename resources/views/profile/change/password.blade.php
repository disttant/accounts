@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">Change your {{$field}}</h4>
        <small>Use upper and lower letters, numbers and symbols</small>
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
                <form action="{{ url('profile/change/password') }}" method="post">

                    @csrf

                    <div class="form-group">
                        <div class="mt-4">
                            <input name="old_password" type="text" class="form-control" placeholder="Old password" required>
                        </div>

                        <div class="mt-5">
                            <input name="password" type="text" class="form-control" placeholder="New password" required>
                        </div>

                        <div class="my-4">
                            <input name="password_confirmation" type="text" class="form-control" placeholder="New password (again)" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Change</button>

                </form>
            </div>
        </li>
        
    </ul>

@endsection
