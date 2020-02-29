<?php

namespace App\Http\Controllers;

use App\User as User;
//use App\OauthClient as OauthClient;
//use App\OauthAccessToken as OauthAccessToken;
//use App\OauthRefreshToken as OauthRefreshToken;

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
    



}
