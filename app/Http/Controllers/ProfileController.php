<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the profile of the user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin', 'business', 'developer', 'user']);

        return view('profile/show');
    }



    /**
     * Show the Changing form in the profile of the user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showChangeForm($field)
    {
        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin', 'business', 'developer', 'user']);

        return view('profile/change/'.$field, ['field' => $field, 'value' => Auth::user()->$field] );
    }



    /**
     * Show the Changing form in the profile of the user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updatePassword(Request $request)
    {
        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin', 'business', 'developer', 'user']);

        $profile = Auth::user();

        # Validate the form
        $data = $request->validate([
            'old_password' => ['required', 'string'],
            'password'     => ['required', 'string', 'min:8', 'confirmed']
        ]);
        
        # Check if old password is right
        if ( !Hash::check($data['old_password'], $profile->password) ){
            return redirect('profile/show');
        }

        # Change and save new data
        $profile->password = Hash::make($data['password']);
        $profile->save();

        return redirect('profile/show');
    }



    /**
     * Show the Changing form in the profile of the user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateName(Request $request)
    {
        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin', 'business', 'developer', 'user']);

        $profile = Auth::user();

        # Validate the form
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        # Change and save new data
        $profile->name = $data['name'];
        $profile->save();

        return redirect('profile/show');
    }


    
}
