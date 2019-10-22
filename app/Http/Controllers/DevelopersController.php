<?php

namespace App\Http\Controllers;

use Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DevelopersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the list of the clients for the current user
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showClients( Request $request )
    {
        $newRequest = Request::create('/oauth/clients', 'GET');

        $clients = json_decode( Route::dispatch($newRequest)->getContent(), true );

        return view('developers/clients/show', [ 'clients' => $clients ]);
        
    }

    /**
     * Show the form for adding new clients
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showNewClientForm( Request $request )
    {
        return view('developers/clients/create');
        
    }

    /**
     * Process the form data and creates a new client
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createClient( Request $request )
    {

        return 'hola';
        /*$newRequest = Request::create('/oauth/clients', 'GET');

        $clients = json_decode( Route::dispatch($newRequest)->getContent(), true );

        return view('developers/clients/show', [ 'clients' => $clients ]);*/
        
    }
}
