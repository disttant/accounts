<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;


#use App\Notifications\TestNotification;

#use App\User as User;
#use App\Developer as Developer;

class NodesController extends Controller
{
    protected $_guzzle;

    public function __Construct(){

        $_guzzle = new \GuzzleHttp\Client([
            'base_uri'    => config('nodes_api_uri'),
            'http_errors' => false
        ]);

        $this->_guzzle = $_guzzle;
    }

    public static function GetAll()
    {
        # Ask for nodes to the API
        $response = $this->_guzzle->get( '/nodes/' . Auth::id() , [
            'headers' => [ 
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json'
             ]
        ]);

        # Check for errors
        if( $response->getStatusCode() >= 300 ){
            return [
                'nodes' => []
            ];
        }

        # Return the results
        return $response->getBody();
    }









    //Notification::send(Auth::user(), new TestNotification() );
    //Auth::user()->notify(new TestNotification() );

    //Auth::user()->sendDeveloperApplicacionResultNotification( 'aprobada', 'te quieeeero' );


    //User::GetProfile(Developer::GetProfile(20)->user_id)->sendDeveloperApplicacionResultNotification( 'aprobada', 'te quieeeero' );

    //dd ( Auth::user() );

    //echo $response->getStatusCode(); # 200
    //echo $response->getHeaderLine('content-type'); # 'application/json; charset=utf8'
    //echo $response->getBody(); # '{"id": 1420053, "name": "guzzle", ...}'

}
