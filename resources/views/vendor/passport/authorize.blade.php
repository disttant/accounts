@extends('layouts.allwonder')

@section('content')

    <div class="card pb-5 container shadow-sm">

        <div class="card-header bg-transparent border-0 p-4">
            <img src="{{asset('img/512px.png')}}" class="align-middle mr-4" style="height: 3rem; width: 3rem;" >
            <h1 class="font-weight-light d-inline align-middle">
                {{ __('Authorize') }}
            </h1>
        </div>

        <div class="card-body">

            <p class="mb-5">
                <strong>{{ $client->name }}</strong> {{ __('is requesting permission to access your account.') }}
            </p>

            @if (count($scopes) > 0)
                <div class="scopes">
                        <p>
                            <strong>{{ __('This application will be able to') }}:</strong>
                        </p>

                        <ul class="p-0 m-0" style="list-style-type:none;">
                            @foreach ($scopes as $scope)
                                <li>{{ $scope->description }}</li>
                            @endforeach
                        </ul>
                </div>
            @endif

            <!-- Buttons wrapper -->
            <div class="d-flex flex-row mb-3 mt-5">
                <div class="mr-3">
                    <!-- Authorize Button -->
                    <form method="post" action="{{ route('passport.authorizations.approve') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="state" value="{{ $request->state }}">
                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                        <button type="submit" class="btn btn-success btn-approve">{{ __('Authorize') }}</button>
                    </form>
                </div>
                <div class="mr-3">
                    <!-- Cancel Button -->
                    <form method="post" action="{{ route('passport.authorizations.deny') }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <input type="hidden" name="state" value="{{ $request->state }}">
                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                        <button class="btn btn-danger">{{ __('Cancel') }}</button>
                    </form>
                </div>
            </div>

            <div class="buttons"></div>

        </div>
    </div>

@endsection
