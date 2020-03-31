<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

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


    # #########################
    # ACTIONS
    # #########################

    /* *
     *
     *  Create a new node
     *
     * */
    public function CreateOne( Request $request )
    {
        # Check if the body is right
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'regex:/^[a-zA-Z0-9]{1,30}$/',
            ]
        ]);

        # Check for errors on input data
        if ($validator->fails()){
            return redirect('nodes/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        # Generate a new node in the API
        $response = $this->guzzle->post( '/internal/node', [
            'body' => json_encode([
                'name'    => Str::lower($request->input('name')),
                'user_id' => Auth::id(),
                'key'     => Str::lower(Str::random(64))
            ])
        ]);

        # Check for errors
        if( $response->getStatusCode() >= 300 ){
            return redirect('nodes/create')
                        ->withErrors([
                            'message' => __('Node could not be created')
                        ])
                        ->withInput();
        }

        # Success, go to list
        return redirect('nodes/show');
    }



    /* *
     *
     *  Delete a node
     *
     * */
    public function RemoveOne( $id )
    {
        # Generate a new node in the API
        $response = $this->guzzle->delete( '/internal/node/'.$id.'/'.Auth::id() );

        # Check for errors
        if( $response->getStatusCode() >= 300 ){
            return redirect('nodes/show')
                        ->withErrors([
                            'message' => __('Node could not be deleted')
                        ])
                        ->withInput();
        }

        # Success, go to list
        return redirect('nodes/show');
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



    # #########################
    # VIEWS
    # #########################

    /*
     * Show form to create a new node
     */
    public function CreateOneView(){

        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin', 'developer', 'user']);

        return view('nodes/create');
    }



    /*
     * Show main view with the node list
     */
    public function GetAllView(){

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
