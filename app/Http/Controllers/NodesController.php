<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class NodesController extends Controller
{
    protected $guzzle;

    /*
     * Init the connection to the Nodes API
     *
     */
    public function __construct()
    {
        $this->guzzle = new \GuzzleHttp\Client([
            'base_uri'    => config('internals.nodes_api_uri'),
            'http_errors' => false,
            'headers' => [
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json'
             ]
        ]);
    }



    /*
     * Get a list of nodes for the current user
     *
     */
    public function GetAll()
    {
        # Ask for nodes to the API
        $response = $this->guzzle->get( '/internal/nodes/' . Auth::id() );

        # Check for errors
        if( $response->getStatusCode() >= 300 ){
            return [
                'nodes' => []
            ];
        }

        # Return the results
        return json_decode((string) $response->getBody(), true);
    }



    /*
     * Main view that shows the node list
     */
    public function Show(){

        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin', 'developer', 'user']);

        # Get nodes from the API
        $nodeList = self::GetAll();

        return view('nodes/show', ['nodeList' => $nodeList]);

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
