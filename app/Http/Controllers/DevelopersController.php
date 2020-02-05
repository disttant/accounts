<?php

namespace App\Http\Controllers;

use App\Developer as Developer;

use Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

use Notification;
use App\Notifications\DeveloperApplicacionRequest as DeveloperApplicacionRequest;

//use Illuminate\Support\Facades\Mail;
//use App\Mail\DevelopersApplicationRequest;

//use \GuzzleHttp\Client;



class DevelopersController extends Controller
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
     * Show the list of the clients for the current user
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showDeveloperApplyForm( Request $request )
    {
        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin', 'user']);

        return view('developers/apply');
        
    }



    /**
     * Process the form data and creates a new developer in the database
     *
     */
    public function createDeveloper( Request $request )
    {
        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin', 'user']);

        # Validate the form
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:100',
            'document'  => 'required|alpha_num|unique:developers,document|max:20',
            'email'     => 'required|email|unique:developers,email|max:100',
            'phone'     => 'required|unique:developers,phone|max:20',
            'summary'   => 'required|string|max:200'
        ]);

        # Check if some input failed
        if ($validator->fails()) {
            return redirect('developers/apply')
                        ->withErrors( $validator )
                        ->withInput();
        }

        # Save the developer in the database
        $createDeveloper = Developer::Create(
            Auth::id(),
            $request->input('name'), 
            $request->input('document'),
            $request->input('email'),
            $request->input('phone'),
            $request->input('summary')
        );

        if ( $createDeveloper == null ){
            return redirect('developers/apply')
                    ->withErrors( __('You have already sent a request.') )
                    ->withInput();
        }

        if ( $createDeveloper == false ){
            return redirect('developers/apply')
                    ->withErrors( __('We could not save the request. Try again later.') )
                    ->withInput();
        }

        # Send an email to the administration email
        Notification::route('mail', config('mail.admin.address') )
            ->notify(new DeveloperApplicacionRequest($createDeveloper));

        # Inform the user that request has been saved
        return redirect('developers/apply')
                    ->with('status', __('Your request has been sent and will be checked by our team.') );
    }



    /**
     * Show the list of the clients for the current user
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showClients( Request $request )
    {
        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin', 'developer']);

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
        Auth::user()->authorizeRoles(['admin', 'developer']);

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
        Auth::user()->authorizeRoles(['admin', 'developer']);

        # Validate the form
        $data = $request->validate([
            'name'      => ['required', 'string'],
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
        Auth::user()->authorizeRoles(['admin', 'developer']);

        # Validate the form
        $data = $request->validate([
            'id'      => ['required', 'numeric']
        ]);

        # Request the data
        $newRequest = Request::create('/oauth/clients/'.$data['id'], 'delete',[
            '_token'    =>  $request->_token
        ]);

        # let the framework handle the request
        $response = app()->handle($newRequest);

        return redirect($request->root() . '/developers/clients/show');
    }



}
