@extends('layouts.allwonder')

@section('content')

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group row">
            <div class="col-md-6 offset-md-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Email') }}" >
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 offset-md-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 offset-md-3">
                <div class="form-check">

                    @php 
                        # <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        # <label class="form-check-label d-none" for="remember">
                        #     {{ __('Remember Me') }}
                        # </label>
                    @endphp

                    <input type="checkbox" class="form-check-input d-none" name="remember" id="remember" checked>

                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-3">
                <button type="submit" class="btn btn-primary">
                    {{ __('Sign in') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </div>

        <div class="form-group row mb-0 mt-4">
            <div class="col-md-6 offset-md-3">
            {{ __('No account?') }} <a href="{{ route('register') }}">{{ __('Create one') }}</a>
            </div>
        </div>

    </form>

@endsection
