@extends('layouts.allwonder')

@section('content')

    <div class="card pb-5 container shadow-sm">

        <div class="card-header bg-transparent border-0 py-5">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <img src="{{ asset('img/512px.png') }}" class="align-middle mr-2" style="width: 3rem; height: 3rem;">
                    <h1 class="font-weight-light d-inline align-middle text-lowercase">
                        {{ config('app.vendor') }}
                    </h1>
                    <h1 class="font-weight-light d-inline align-middle text-lowercase text-secondary">
                        {{ __('Register') }}
                    </h1>
                </div>
            </div>
        </div>


        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ __('Name') }}">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('Email') }}">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Sign up') }}
                        </button>
                        
                    </div>
                    <div class="col-md-6 offset-md-3 mt-3">
                        <small>
                            {{ __('Creating an account means you are accepting our') }} <a href="{{ url('contracts/tos') }}" target="_blank">{{ __('Terms of Service') }}</a> 
                            {{ __('and') }} <a href="{{ url('contracts/privacy') }}" target="_blank">{{ __('Privacy Policy') }}</a>
                        </small>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
