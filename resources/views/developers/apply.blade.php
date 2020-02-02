@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">I want to be developer!</h4>
        <small>Be smart and make the world better</small>
    </div>

    @if ($errors->any())
        <div class="p-2 alert alert-danger">
            <ul style="list-style-type:none;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="container-fluid alert alert-warning text-justify">
        <strong>Attention developers</strong>
        <p>
            You should read this in advance. 
            We are very happy with external people developing for our platform 
            but we would like to keep this safe for everyone. 
            Think that we are creating systems that manage sensitive data.
            For that, we control some aspects around our services. Detecting anyone 
            breaking the contract means the revokation of permissions and cancelation of the account so, 
            please, read the entire contract. Although we are not responsible for 
            the use the users do of our services, we will do everything in our power 
            to make everyone respects the terms of service and the privacy policy.
        </p>

        <strong>
            Read the <a href="{{ url('contracts/tos') }}" target="_blank" class="text-light text-decoration-none">TOS</a>
            and our <a href="{{ url('contracts/privacy') }}" target="_blank" class="text-light text-decoration-none">privacy policy</a>
        </strong>
    </div>

    <ul class="list-group">
        <li class="list-group-item py-4">
            <div class="d-flex flex-column mb-3 flex-grow-1">

                <form action="{{ url('developers/apply') }}" method="post">
                    @csrf
                    <div class="form-group">

                        <div class="mt-3 mb-3">
                            <span class="my-5 h5">
                                Entity
                            </span>
                        </div>

                        <div class="pt-4 pb-2">
                            <input name="name" type="text" maxlength="100" class="form-control" placeholder="Yours / Your business name" required autofocus>
                        </div>

                        <div class="pt-4 pb-4">
                            <input name="document" type="text" maxlength="20" class="form-control" placeholder="Yours / Your business ID" required>
                        </div>

                        <div class="mt-5">
                            <span class="my-5 h5">
                                Contact
                            </span>
                        </div>

                        <div class="pt-4 pb-2">
                            <input name="email" type="text" maxlength="100" class="form-control" placeholder="Email to contact your team" required>
                        </div>

                        <div class="pt-4 pb-4">
                            <input name="phone" type="text" maxlength="20" class="form-control" placeholder="A phone to call your team" required>
                            <small class="text-muted">Be global: +00555555...</small>
                        </div>

                        <div class="mt-5">
                            <span class="my-5 h5">
                                Other things
                            </span>
                        </div>

                        <div class="pt-4 pb-4">
                            <textarea maxlength="200" rows="5" class="form-control" name="summary" placeholder="What kind of apps you want to develop" required></textarea>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you accept our TOS and Privacy Policy?');">Send my request</button>
                    <small class="mt-4 form-text text-muted">Clicking the button means you accept our TOS and Privacy Policy</small>
                </form>
            </div>
        </li>
        
    </ul>

@endsection
