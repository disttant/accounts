<?php

namespace App\Http\Controllers;

use App\Comodito;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ComoditosController extends Controller
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
                Rule::unique('comoditos')->where(function ($query) {
                    return $query->where( 'user_id', Auth::id() );
                })
            ],
        ]);

        # Check for errors on input data
        if ($validator->fails()){
            return redirect('comoditos/create')
                        ->withErrors([
                            'message' => __('Some field is malformed. May be the key?')
                        ])
                        ->withInput();
        }

        # Save into DB
        $newComodito          = new Comodito;
        $newComodito->name    = $request->input('name');
        $newComodito->node_id = $request->input('node_id');
        $newComodito->key     = $request->input('key');

        # Check for errors saving data
        if ( $newComodito->save() === false ){
            return redirect('comoditos/create')
                    ->withErrors([
                        'message' => __('Comodito could not be created')
                    ])
                    ->withInput();
        }

        # Success, go to list
        return redirect('comoditos/show');
    }



    /* *
     *
     *  Delete a comodito
     *
     * */
    public static function RemoveOne( Request $request )
    {
        # Check if the body is right
        $validator = Validator::make($request->all(), [
            'id' => [
                'required',
                'regex:/^[0-9]+$/',
            ]
        ]);

        # Find and delete the resource
        $deleteComodito = Comodito::where('id', $request->input('id'))
            ->where('user_id', Auth::id())
            ->delete();

        if ( $deleteComodito == false ){
            return redirect('comoditos/show')
                ->withErrors([
                    'message' => __('Comodito could not be deleted')
                ])
                ->withInput();
        }

        # Success, go to list
        return redirect('comoditos/show');
    }



    /* *
     *
     *  Get all comoditos' of the user
     *
     * */
    public static function GetAll( )
    {
        $comoditos = Comodito::select('id', 'name', 'node_id', 'key')
                    ->where( 'user_id', Auth::id() )
                    ->get();
        
        # Return empty structure
        if( $comoditos->isEmpty() ){
            return [
                    'comoditos' => []
            ];
        }

        # Process the request a bit
        $result = [];
        foreach ($comoditos as $item => $data){
            $result['comoditos'][] = [
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
     * Show form to create a new comodito
     */
    public function CreateOneView(){

        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin', 'developer', 'user']);

        return view('comoditos/create');
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
        $comoditoList = self::GetAll();

        return view('comoditos/show', ['comoditoList' => $comoditoList]);
    }









}