<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the profile of the user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        $profile = Auth::user();
        return view('profile/show', ['profile' => $profile] );
    }

    /**
     * Show the Changing form in the profile of the user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showChangeForm($field)
    {
        $value = Auth::user()->$field;
        return view('profile/change/'.$field, ['field' => $field, 'value' => $value] );
    }

    /**
     * Show the Changing form in the profile of the user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updatePassword(Request $request)
    {
        $profile = Auth::user();

        # Validate the form
        $data = $request->validate([
            'old_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
        
        # Check if old password is right
        if ( !Hash::check($data['old_password'], $profile->password) ){
            return redirect('profile');
        }

        # Change and save new data
        $profile->password = Hash::make($data['password']);
        $profile->save();

        return redirect('profile');
    }

    /**
     * Show the Changing form in the profile of the user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateName(Request $request)
    {
        $profile = Auth::user();

        # Validate the form
        $data = $request->validate([
            'name' => ['required', 'string', 'min:8']
        ]);

        # Change and save new data
        $profile->name = $data['name'];
        $profile->save();

        return redirect('profile');
    }

}
