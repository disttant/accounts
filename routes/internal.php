<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Internal Routes [ THEY MUST NOT BE EXPOSED TO INTERNET ]
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



/* *
 * 
 * Endpoints related to Oauth 2 jobs
 * 
 * */

# Check if an access token is valid
Route::get('/oauth/access_token/validate', function (Request $request) {
    return response()->json([
        'status'    => 'valid',
        'message'   => 'Authenticated'
    ]);
})->middleware('auth:api');