<?php

namespace App\Http\Controllers;

use App\Card;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CardsController extends Controller
{
    # #########################
    # ACTIONS
    # #########################

    /* *
     *
     *  Create new card
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
                Rule::unique('cards')->where(function ($query) {
                    return $query->where( 'user_id', Auth::id() );
                })
            ],
        ]);

        # Check for errors on input data
        if ($validator->fails()){
            return redirect('cards/create')
                        ->withErrors([
                            'message' => __('Some field is malformed. May be the key?')
                        ])
                        ->withInput();
        }

        # Save into DB
        $newCard           = new Card;
        $newCard->name     = $request->input('name');
        $newCard->user_id  = Auth::id();
        $newCard->node_id  = $request->input('node_id');
        $newCard->key      = $request->input('key');

        # Check for errors saving data
        if ( $newCard->save() === false ){
            return redirect('cards/create')
                    ->withErrors([
                        'message' => __('Card could not be created')
                    ])
                    ->withInput();
        }

        # Success, go to list
        return redirect('cards/show');
    }



    /*
     * Disable all passes of signed in user
     * Set (current = false)
     */
    public static function DisableCards()
    {
        # Retrieve card from the db
        $updateCards = Card::where('user_id', Auth::id() )
                            ->update(['current' => false]);
        if( ! $updateCards ){
            return false;
        }
        return true;
    }



    /* *
     *
     *  Change some card field
     *
     * */
    public static function ChangeOne( Request $request )
    {
        return response( $request->all() )->send();

        # Check if the body is right
        $validator = Validator::make($request->all(), [
            'id' => [
                'required',
                'regex:/^[0-9]+$/',
                Rule::exists('cards')->where(function ($query) {
                    return $query->where( 'user_id', Auth::id() );
                })
            ],
            'current' => [
                'boolean',
            ]
        ]);

        # Check for errors on input data
        if ($validator->fails()){
            return redirect('cards/show')
                        ->withErrors($validator)
                        ->withInput();
        }

        # Retrieve comodito from the db
        $updateCard = Card::where('id', $request->input('id'))
            ->where('user_id', Auth::id() )
            ->first();

        # Request wants to be the current active?
        if( $request->has('current') ){
            if( ! self::DisableCards() ){
                return redirect('cards/show')
                        ->withErrors([
                            'message' => __('Oops!, Some active card could not be disabled')
                        ])
                        ->withInput();
            }
            $updateCard->current = true;
        }

        # Save and check errors
        if ( ! $updateCard->save() ){
            return redirect('cards/show')
                        ->withErrors([
                            'message' => __('Oops!, Card could not be changed')
                        ])
                        ->withInput();
        }

        # Success, go to list
        return redirect('cards/show');
    }



    /* *
     *
     *  Delete a card
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
        $deleteCard = Card::where('id', $request->input('id'))
            ->where('user_id', Auth::id())
            ->delete();

        if ( $deleteCard == false ){
            return redirect('cards/show')
                ->withErrors([
                    'message' => __('Card could not be deleted')
                ])
                ->withInput();
        }

        # Success, go to list
        return redirect('cards/show');
    }



    /* *
     *
     *  Get all cards' of the user
     *
     * */
    public static function GetAll( )
    {
        $cards = Card::select('id', 'name', 'node_id', 'key')
                    ->where( 'user_id', Auth::id() )
                    ->get();
        
        # Return empty structure
        if( $cards->isEmpty() ){
            return [
                    'cards' => []
            ];
        }

        # Process the request a bit
        $result = [];
        foreach ($cards as $item => $data){
            $result['cards'][] = [
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
    public static function CreateOneView(){

        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin', 'developer', 'business', 'user']);

        return view('cards/create');
    }



    /* *
     *
     *  Show main view with the staypasses list
     *
     * */
    public static function GetAllView( )
    {
        # Set authorized roles for this actions
        Auth::user()->authorizeRoles(['admin', 'developer', 'business', 'user']);

        # Get nodes from the API
        $cardList = self::GetAll();

        return view('cards/show', ['cardList' => $cardList]);
    }









}