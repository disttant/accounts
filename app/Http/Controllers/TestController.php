<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;


use App\Notifications\TestNotification;

use App\User as User;
use App\Developer as Developer;

class TestController extends Controller
{
    //

    public function test(){

        //Notification::send(Auth::user(), new TestNotification() );
        //Auth::user()->notify(new TestNotification() );

        //Auth::user()->sendDeveloperApplicacionResultNotification( 'aprobada', 'te quieeeero' );


        //User::GetProfile(Developer::GetProfile(20)->user_id)->sendDeveloperApplicacionResultNotification( 'aprobada', 'te quieeeero' );

        //dd ( Auth::user() );
    }

}
