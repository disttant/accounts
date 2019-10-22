@extends('layouts.panel')

@section('contentt')

    <div class="mb-5">
        <h4 class="my-1">Change your {{$field}}</h4>
        <small>Keep your data safe: use letters, numbers, symbols, etc</small>
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
                <form action="/profile/change/password" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="pt-4 pb-5">
                            <label for="TheOldInput" class="font-weight-bold">Write your old password</label>
                            <input name="old_password" type="text" class="form-control" id="TheOldInput" placeholder="Old password" required>
                        </div>

                        <div class="pt-5 pb-4">
                            <label for="TheInput" class="font-weight-bold">Write you new password</label>
                            <input name="password" type="text" class="form-control" id="TheInput" placeholder="New password" required>
                        </div>

                        <div class="py-4">
                            <!--<label for="TheOtherInput" class="font-weight-bold">Let's assure. Write it again</label>-->
                            <input name="password_confirmation" type="text" class="form-control" id="TheOtherInput" placeholder="New password (again)" required>
                        </div>
                        <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                    </div>
                    <button type="submit" class="btn btn-primary">Change</button>
                </form>
            </div>
        </li>
        
    </ul>

@endsection
