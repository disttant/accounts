@extends('layouts.panel')

@section('contentt')

    <div class="mb-5">
        <h4 class="my-1">My account</h4>
        <small>( Last update: {{ $profile->updated_at }} )</small>
    </div>

    <ul class="list-group">

        <a href="/profile/change/name" class="list-group-item list-group-item-action">
            <div class="d-flex p-2 align-items-stretch">
                <div class="d-flex flex-grow-1 justify-content-between align-items-center">
                    <div class="d-flex flex-column mb-3 flex-grow-1">
                        <div class="font-weight-bold">Name</div>
                        <div class="">{{ $profile->name }}</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <i class="material-icons align-middle">keyboard_arrow_right</i>
                </div>
            </div>
        </a>

        <a href="/profile/change/password" class="list-group-item list-group-item-action">
            <div class="d-flex p-2 align-items-stretch">
                <div class="d-flex flex-grow-1 justify-content-between align-items-center">
                    <div class="d-flex flex-column mb-3 flex-grow-1">
                        <div class="font-weight-bold">Password</div>
                        <div class="">*****</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <i class="material-icons align-middle">keyboard_arrow_right</i>
                </div>
            </div>
        </a>

        <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex p-2 align-items-stretch">
                <div class="d-flex flex-grow-1 justify-content-between align-items-center">
                    <div class="d-flex flex-column mb-3 flex-grow-1">
                        <div class="font-weight-bold">Email</div>
                        <div class="">{{ $profile->email }}</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <!--<i class="material-icons align-middle">keyboard_arrow_right</i>-->
                </div>
            </div>
        </a>

        <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex p-2 align-items-stretch">
                <div class="d-flex flex-grow-1 justify-content-between align-items-center">
                    <div class="d-flex flex-column mb-3 flex-grow-1">
                        <div class="font-weight-bold">Verified email</div>
                        <div class="my-1">
                            @if ( !is_null($profile->email_verified_at) )
                                <i class="material-icons align-middle">verified_user</i>
                            @else 
                                <i class="material-icons md-dark md-inactive align-middle">report</i>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <!--<i class="material-icons align-middle">keyboard_arrow_right</i>-->
                </div>
            </div>
        </a>

    </ul>

@endsection
