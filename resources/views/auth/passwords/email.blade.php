@extends('layouts.allwonder')

@section('content')

    <div class="card pb-5 container shadow-sm">

        <div class="card-header bg-transparent border-0 p-4">
            <img src="{{asset('img/512px.png')}}" class="align-middle mr-4" style="height: 3rem; width: 3rem;" >
            <h1 class="font-weight-light d-inline align-middle">
                {{ __('Reset') }}
            </h1>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group row">
                    <div class="col-md-4 col-form-label text-md-right"></div>

                    <div class="col-md-6">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Email') }}">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Send me a reset link') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
