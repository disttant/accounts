<?php

namespace App\Http\Controllers;

use App\User as User;
use App\OauthClient as OauthClient;
use App\OauthAccessToken as OauthAccessToken;
use App\OauthRefreshToken as OauthRefreshToken;

use Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

//use \GuzzleHttp\Client;



class AuthorizationsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( Request $request )
    {

    }



    /**
     * 
     *
     * 
     */
    public function showAuthorizedClients( )
    {
        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin', 'developer', 'user']);

        $clients = User::getAuthorizedClients( Auth::id() );

        return view('authorizations/show', [ 'clients' => $clients ]);
    }



    /**
     * 
     *
     * 
     */
    public function revokeAuthorizedClient( Request $request)
    {
        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin', 'developer', 'user']);

        # Check recieved id hidden field
        $validator = Validator::make($request->all(),[
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect('authorizations/show')
                        ->withErrors($validator)
                        ->withInput();
        }

        # Delete all possible ways for a client to take data
        $revokeAuthCodes = User::revokeAuthCodes( Auth::id(), $request->input('id') );
        $revokeAccessTokens = User::revokeAccessTokens( Auth::id(), $request->input('id') );
        $revokeRefreshTokens = User::revokeRefreshTokens( Auth::id(), $request->input('id') );

        # If there was any error, notify the user
        if( $revokeAuthCodes === false || $revokeAccessTokens === false || $revokeRefreshTokens === false ){
            return redirect('authorizations/show')
                        ->withErrors(__('Something went wrong revoking all permissions to that application') );
        }

        return redirect('authorizations/show');
    }
    



}
