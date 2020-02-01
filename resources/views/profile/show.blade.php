@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">Profile</h4>
        <small>Tell us a bit about you, sweetie </small>
    </div>

    <div class="my-4">

        @unless ( Auth::user()->hasAnyRole(['developer']) == true )
            <a href="{{ url('developers/apply') }}" class="btn btn-secondary">
                I want to be developer!
            </a>
        @endunless
        
    </div>

    <ul class="list-group">

        <a href="{{ url('profile/change/name') }}" class="list-group-item list-group-item-action">
            <div class="d-flex p-2 align-items-stretch">
                <div class="d-flex flex-grow-1 justify-content-between align-items-center">
                    <div class="d-flex flex-column mb-3 flex-grow-1">
                        <div class="font-weight-bold">Name</div>
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
                        <div class="font-weight-bold">Password</div>
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
                        <div class="font-weight-bold">Email</div>
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
                        <div class="font-weight-bold">Verified email</div>
                        <div class="my-1">
                            @if ( !is_null(Auth::user()->email_verified_at) )
                                <span>Verified</span>
                            @else 
                                <span>Pending</span>
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
                        <div class="font-weight-bold">Account type</div>
                        <div class="my-1">

                            @forelse (Auth::user()->roles()->get() as $role)
                                <div class="d-inline">
                                    {{ $role->description }}@if( !$loop->last ), @endif
                                </div>
                            @empty
                                <p>No roles for this user</p>
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
