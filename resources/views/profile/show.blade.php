@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">{{ __('Profile') }}</h4>
        <small>{{ __('Tell us a bit about you, sweetie')}}</small>
    </div>

    <div class="my-4">

        @unless ( Auth::user()->hasAnyRole(['developer']) == true )
            <a href="{{ url('developers/apply') }}" class="btn btn-primary">
                {{ __('I want to be developer!') }}
            </a>
        @endunless
        
    </div>

    <ul class="list-group">

        <a href="{{ url('profile/change/name') }}" class="list-group-item list-group-item-action">
            <div class="d-flex p-2 align-items-stretch">
                <div class="d-flex flex-grow-1 justify-content-between align-items-center">
                    <div class="d-flex flex-column mb-3 flex-grow-1">
                        <div class="font-weight-bold">{{ __('Name') }}</div>
                        <div>{{ Auth::user()->name }}</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <i class="material-icons align-middle">keyboard_arrow_right</i>
                </div>
            </div>
        </a>

        <a href="{{ url('profile/change/password') }}" class="list-group-item list-group-item-action">
            <div class="d-flex p-2 align-items-stretch">
                <div class="d-flex flex-grow-1 justify-content-between align-items-center">
                    <div class="d-flex flex-column mb-3 flex-grow-1">
                        <div class="font-weight-bold">{{ __('Password') }}</div>
                        <div>*****</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <i class="material-icons align-middle">keyboard_arrow_right</i>
                </div>
            </div>
        </a>

        <div class="list-group-item list-group-item-action">
            <div class="d-flex p-2 align-items-stretch">
                <div class="d-flex flex-grow-1 justify-content-between align-items-center">
                    <div class="d-flex flex-column mb-3 flex-grow-1">
                        <div class="font-weight-bold">{{ __('Email') }}</div>
                        <div>{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <!--<i class="material-icons align-middle">keyboard_arrow_right</i>-->
                </div>
            </div>
        </div>

        <div class="list-group-item list-group-item-action">
            <div class="d-flex p-2 align-items-stretch">
                <div class="d-flex flex-grow-1 justify-content-between align-items-center">
                    <div class="d-flex flex-column mb-3 flex-grow-1">
                        <div class="font-weight-bold">{{ __('Verified') }}</div>
                        <div class="my-1">
                            @if ( !is_null(Auth::user()->email_verified_at) )
                                <span>{{ __('Verified') }}</span>
                            @else 
                                <span>{{ __('Not verified') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <!--<i class="material-icons align-middle">keyboard_arrow_right</i>-->
                </div>
            </div>
        </div>

        <div class="list-group-item list-group-item-action">
            <div class="d-flex p-2 align-items-stretch">
                <div class="d-flex flex-grow-1 justify-content-between align-items-center">
                    <div class="d-flex flex-column mb-3 flex-grow-1">
                        <div class="font-weight-bold">{{ __('Account type') }}</div>
                        <div class="my-1">

                            @forelse (Auth::user()->roles()->get() as $role)
                                <div class="d-inline">
                                    {{ $role->description }}@if( !$loop->last ), @endif
                                </div>
                            @empty
                                <p>{{ __('No roles for this user') }}</p>
                            @endforelse

                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <!--<i class="material-icons align-middle">keyboard_arrow_right</i>-->
                </div>
            </div>
        </div>

    </ul>

@endsection
