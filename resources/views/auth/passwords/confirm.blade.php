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
                        {{ __('Reset') }}
                    </h1>
                </div>
            </div>
        </div>

        <div class="card-body">
            {{ __('Please confirm your password before continuing.') }}

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Confirm Password') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
