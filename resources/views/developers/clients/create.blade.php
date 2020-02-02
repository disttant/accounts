@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">Create new app</h4>
        <small>Be strong and make the world better</small>
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
                <form action="{{ url('developers/clients/create') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="pt-4 pb-4">
                            <input name="name" type="text" class="form-control" placeholder="App name" required>
                        </div>

                        <div class="pb-4">
                            <input name="redirect" type="text" class="form-control" placeholder="http://valid.url/gimme/data" required>
                            <small class="form-text text-muted">Valid URI where we will send you some sensitive data</small>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?');">Create my new app!</button>
                    <small class="mt-4 form-text text-muted">Clicking the button means you accept our terms and conditions</small>
                </form>
            </div>
        </li>
        
    </ul>

@endsection
