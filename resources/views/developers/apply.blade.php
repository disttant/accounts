@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">{{ __('I want to be developer!') }} </h4>
        <small>{{ __('Be smart and make the world better') }}</small>
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
        <strong>{{ __('Attention developers') }}</strong>
        <p>
            {{ __('You should read this in advance.') }}
            {{ __('We are very happy with external people developing for our platform.') }}
            {{ __('We would like to keep this safe for everyone.') }}
            {{ __('Think that we are creating systems that manage sensitive data.') }}
            {{ __('For that, we control some aspects around our services.') }}
            {{ __('Ignoring the rules means the cancelation of the account.') }}
            {{ __('Please, read the entire contract.') }}
            {{ __('We are not responsible for the use done of our services.') }}
        </p>

        <strong>
            <a href="{{ url('contracts/tos') }}" target="_blank">{{ __('Terms of Service') }}</a> 
            {{ __('and') }} 
            <a href="{{ url('contracts/privacy') }}" target="_blank">{{ __('Privacy Policy') }}</a>
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
                                {{ __('Entity') }}
                            </span>
                        </div>

                        <div class="pt-4 pb-2">
                            <input name="name" type="text" maxlength="100" class="form-control" placeholder="{{ __('Name') }}" required autofocus>
                        </div>

                        <div class="pt-4 pb-4">
                            <input name="document" type="text" maxlength="20" class="form-control" placeholder="{{ __('Document') }}" required>
                            <small class="text-muted">{{ __('National document identification number') }}</small>
                        </div>

                        <div class="mt-5">
                            <span class="my-5 h5">
                                {{ __('Contact') }}
                            </span>
                        </div>

                        <div class="pt-4 pb-2">
                            <input name="email" type="text" maxlength="100" class="form-control" placeholder="{{ __('Email') }}" required>
                        </div>

                        <div class="pt-4 pb-4">
                            <input name="phone" type="text" maxlength="20" class="form-control" placeholder="{{ __('Phone') }}" required>
                            <small class="text-muted">{{ __('International format') }}: +00555555...</small>
                        </div>

                        <div class="mt-5">
                            <span class="my-5 h5">
                                {{ __('Other things') }}
                            </span>
                        </div>

                        <div class="pt-4 pb-4">
                            <textarea maxlength="200" rows="5" class="form-control" name="summary" placeholder="{{ __('What kind of app you want to develop?') }}" required></textarea>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Send my request') }}</button>
                    <small class="mt-4 form-text text-muted">
                        {{ __('Clicking the button means you accept our TOS and Privacy Policy') }}
                    </small>
                </form>
            </div>
        </li>
        
    </ul>

@endsection
