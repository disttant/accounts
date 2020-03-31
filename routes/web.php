<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

# UN-protected routes


# Protect routes
Auth::routes(['verify' => true]);


/* 
 *
 *  Routes for general purposes
 * 
 */
Route::get('/', function () {
    return redirect('profile');
});

Route::get('/home', function () {
    return redirect('/');
});

Route::get('/test', function () {

});



/* 
 *
 *  Routes for public contracts
 * 
 */
Route::prefix('contracts')->group(function () {

    Route::get('/tos', function(){
        return view('contracts/tos');
    });

    Route::get('/privacy', function(){
        return view('contracts/privacy');
    });

});



/* 
 *
 *  Routes for profiles forms and actions
 * 
 */
Route::prefix('profile')->middleware(['auth'])->group(function () {

    Route::get('/', function(){
        return redirect('profile/show');
    });

    Route::get('/show', 'ProfileController@show');

    Route::get('/change/{field}', function ($field) {

        $changableFields = ['name', 'password'];
        $field = Route::current()->field;

        # Check if the field is acceptable
        if( in_array($field, $changableFields ) ){
            return App::call('App\Http\Controllers\ProfileController@showChangeForm', ['field' => $field]);
        }

        # The field is not acceptable, redirect
        return redirect('profile/show');
    });

    Route::post('/change/password', function () {
        return App::call('App\Http\Controllers\ProfileController@updatePassword');
    });

    Route::post('/change/name', function () {
        return App::call('App\Http\Controllers\ProfileController@updateName');
    });

});



/* 
 *
 *  Routes for authorization forms and actions
 * 
 */
Route::prefix('authorizations')->middleware(['auth'])->group(function () {

    Route::get('/', function(){
        return redirect('authorizations/show');
    });

    Route::get('/show', 'AuthorizationsController@showAuthorizedClients');

    Route::post('/revoke', 'AuthorizationsController@revokeAuthorizedClient');

});



/* 
 *
 *  Routes for personal-keys forms and actions
 * 
 */
Route::prefix('nodes')->middleware(['auth'])->group(function () {

    Route::get('/', function(){
        return redirect('nodes/show');
    });

    Route::get('/show', 'NodesController@GetAllView');

    Route::get('/create', 'NodesController@CreateOneView');

    Route::post('/create', 'NodesController@CreateOne');

    //Route::get('/change', 'NodesController@ChangeOne', []);

    Route::post('/remove/{id}', 'NodesController@RemoveOne');

});




/* 
 *
 *  Routes for developers only forms and actions
 * 
 */
Route::prefix('developers')->middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return redirect('/developers/clients/show');
    });

    Route::get('/apply', function () {
        return App::call('App\Http\Controllers\DevelopersController@showDeveloperApplyForm');
    });

    Route::post('/apply', function () {
        return App::call('App\Http\Controllers\DevelopersController@createDeveloper');
    });

    Route::get('/clients/show', function () {
        return App::call('App\Http\Controllers\DevelopersController@showClients');
    });
    
    Route::get('/clients/create', function () {
        return App::call('App\Http\Controllers\DevelopersController@showNewClientForm');
    });
    
    Route::post('/clients/create', function () {
        return App::call('App\Http\Controllers\DevelopersController@createClient');
    });
    
    Route::post('/clients/delete', function () {
        return App::call('App\Http\Controllers\DevelopersController@deleteClient');
    });
    
    Route::get('/clients/restore', function () {
        return App::call('App\Http\Controllers\DevelopersController@showRestoreClientForm');
    });

});



/* 
 *
 *  Routes for administration
 * 
 */
Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/developers/application/{developer_id}', function ($developer_id) {
        return App::call('App\Http\Controllers\AdminController@showDeveloperApplicationForm', ['developer_id' => $developer_id]);
    });

    Route::post('/developers/application/{developer_id}', function ($developer_id) {
        return App::call('App\Http\Controllers\AdminController@ProcessDeveloperApplication', ['developer_id' => $developer_id]);
    });

});

