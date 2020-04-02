<?php

namespace App\Http\Controllers;

use App\Staypass;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StaypassesController extends Controller
{
    # #########################
    # ACTIONS
    # #########################
    
    /* *
     *
     *  Create new staypass
     *
     * */
    public static function CreateOne( Request $request )
    {
        # Check if the body is right
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'regex:/^[a-z0-9]{1,30}$/',
            ],
            'node_id' => [
                'required',
                'regex:/^[0-9]+$/',
            ],
            'key' => [
                'required',
                'regex:/^[a-z0-9]{64}$/',
                Rule::unique('staypasses')->where(function ($query) {
                    return $query->where( 'user_id', Auth::id() );
                })
            ],
        ]);

        # Check for errors on input data
        if ($validator->fails()){
            return redirect('staypasses/create')
                        ->withErrors([
                            'message' => __('Staypass could not be created')
                        ])
                        ->withInput();
        }

        # Save into DB
        $newStaypass          = new Staypass;
        $newStaypass->name    = $request->input('name');
        $newStaypass->node_id = $request->input('node_id');
        $newStaypass->key     = $request->input('key');

        # Check for errors saving data
        if ( $newStaypass->save() === false ){
            return redirect('staypasses/create')
                    ->withErrors([
                        'message' => __('Staypass could not be created')
                    ])
                    ->withInput();
        }

        # Success, go to list
        return redirect('staypasses/show');
    }



    /* *
     *
     *  Delete a node
     *
     * */
    public static function RemoveOne( int $nodeId )
    {
        # Find and delete the resource
        $deleteStaypass = Staypass::where('node_id', $nodeId)
            ->where('user_id', Auth::id())
            ->delete();

        if ( $deleteStaypass == false ){
            return redirect('staypasses/show')
                ->withErrors([
                    'message' => __('Staypass could not be deleted')
                ])
                ->withInput();
        }

        # Success, go to list
        return redirect('staypasses/show');
    }



    /* *
     *
     *  Get all staypasses of the user
     *
     * */
    public static function GetAll( )
    {
        $staypasses = Staypass::select('id', 'name', 'node_id', 'key')
                    ->where( 'user_id', Auth::id() )
                    ->get();
        
        # Return empty structure
        if( $staypasses->isEmpty() ){
            return [
                    'staypasses' => []
            ];
        }

        # Process the request a bit
        $result = [];
        foreach ($staypasses as $item => $data){
            $result['staypasses'][] = [
                'id'       => $data->id,
                'name'     => $data->name,
                'node_id'  => $data->name,
                'key'      => $data->key,
            ];
        }

        # Return the results
        return $result;
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

        return view('staypasses/create');
    }



    /* *
     *
     *  Show main view with the staypasses list
     *
     * */
    public static function GetAllView( )
    {
        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin', 'developer', 'user']);

        # Get nodes from the API
        $staypassList = self::GetAll();

        return view('staypasses/show', ['$staypassList' => $staypassList]);
    }









}