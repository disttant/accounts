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
                        {{ __('Verify your account') }}
                    </h1>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
            </form>
        </div>
    </div>

@endsection
