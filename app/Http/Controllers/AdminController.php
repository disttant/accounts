<?php

namespace App\Http\Controllers;

use App\User as User;
use App\Developer as Developer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\Mail\DevelopersApplicationResponse;



class AdminController extends Controller
{

    /**
     * Process the form data and creates a new developer in the database
     *
     */
    public function showDeveloperApplicationForm( int $developer_id ){

        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin']);

        # Get all the developer data
        $profile['developer'] = Developer::GetProfile( $developer_id );

        if ( @count($profile['developer']) > 0 ){

            # Get all the user data
            $profile['user'] = User::GetProfile( $profile['developer']->user_id );

            return view('admin/developers/application', ['profile' => $profile]);
        }

        # Developer not found
        return abort(404);

    }



    /**
     * Process the request and set (or not) the developer role to developer ID
     *
     */
    public function ProcessDeveloperApplication ( Request $request, int $developer_id ){

        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin']);

        # Validate the form
        $validator = Validator::make($request->all(), [
            'message'     => 'required|string|max:500',
        ]);

        # Check if some input failed
        if ($validator->fails()) {
            return back()
                    ->withErrors( $validator )
                    ->withInput();
        }

        # Process the application
        if ($request->has('decline')) {
            
            # Delete developer info from database
            if( Developer::RemoveOne( $developer_id ) == false ){
                return back()
                        ->withErrors('Developer could not be removed')
                        ->withInput();
            }

            # Send the user an email giving information
            Mail::to( User::GetProfile(Developer::GetProfile($developer_id)->user_id)->email )
                ->send(new DevelopersApplicationResponse ( false, $request->message ) );

        }

        # Process the application
        if ($request->has('accept')) {
            
            # Add a new role for that user
            if( User::SetRole('developer', Developer::GetProfile($developer_id)->user_id ) == false ){
                return back()
                        ->withErrors( __('User could not switch to developer') )
                        ->withInput();
            }

            # Send the user an email giving information
            Mail::to( User::GetProfile(Developer::GetProfile($developer_id)->user_id)->email )
                ->send(new DevelopersApplicationResponse ( true, $request->message ) );

        }

        # Inform the user that request has been saved
        return back()->with('status', __('Application has been processed successfully') );

    }

}
