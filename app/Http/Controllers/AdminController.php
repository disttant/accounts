<?php

namespace App\Http\Controllers;

use App\User as User;
use App\Developer as Developer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{



    /**
     * Process the form data and creates a new developer in the database
     *
     */
    public function showDeveloperApplicationForm( int $developer_id ){

        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin']);

        # Get all the user data
        $profile['developer'] = Developer::GetProfile( $developer_id );

        if ( @count($profile['developer']) > 0 ){
            $profile['user'] = User::GetProfile( $profile['developer']->user_id );

            return view('admin/developers/application', ['profile' => $profile]);
        }

        return 'hola papi <3';  //////////////////////////////////////////////////////////////////////////

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
            'message'     => 'required|string',
        ]);

        # Check if some input failed
        if ($validator->fails()) {
            return back()
                    ->withErrors('The message is malformed')
                    ->withInput();
        }

        # Process the application
        if ($request->has('decline')) {
            
            # Delete developer info from database
            if( Developer::RemoveOne( $developer_id ) == false ){
                return back()
                        ->withErrors('Error removing the developer from the system')
                        ->withInput();
            }

            # Send the user an email giving information

        }

        # Process the application
        if ($request->has('accept')) {
            
            # Add a new role for that user
            if( User::SetRole('developer', Developer::GetProfile($developer_id)->user_id ) == false ){
                return back()
                        ->withErrors('Error setting the developer role to the user')
                        ->withInput();
            }


            # Send the user an email giving information

        }

    }

}
