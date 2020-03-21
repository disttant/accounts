@extends('layouts.allwonder')

@section('content')

    
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

@endsection
