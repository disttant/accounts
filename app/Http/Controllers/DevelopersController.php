<?php

namespace App\Http\Controllers;

use Route;
use App\Developer as Developer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
//use Notification;
//use App\Notifications\DeveloperApplicacionRequest as DeveloperApplicacionRequest;

class DevelopersController extends Controller
{
    /**
     * Show the list of the clients for the current user
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showClients( Request $request )
    {
        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin']);

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
        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin']);

        return view('developers/clients/create');
    }



    /**
     * Process the form data and creates a new client
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createClient( Request $request )
    {

        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin']);

        # Validate the form
        $data = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'redirect'  => ['required', 'url']
        ]);

        # Request the data
        $newRequest = Request::create('/oauth/clients', 'post', [
            '_token'    =>  $request->_token,
            'name'      =>  $data['name'],
            'redirect'  =>  $data['redirect']
        ]);

        # let the framework handle the request
        $response = app()->handle($newRequest);

        return redirect($request->root() . '/developers/clients/show');
    }



    /**
     * Process the form data and deletes a client
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deleteClient( Request $request )
    {
        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin']);

        # Validate the form
        $data = $request->validate([
            'id'      => ['required', 'numeric']
        ]);

        # Request the data
        $newRequest = Request::create('/oauth/clients/'.$data['id'], 'delete', [
            '_token'    =>  $request->_token
        ]);

        # let the framework handle the request
        $response = app()->handle($newRequest);

        return redirect($request->root() . '/developers/clients/show');
    }



}
