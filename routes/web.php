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

    # Sending an email
    //Mail::to( config('mail.from.address') )->send(new DeveloperApplication());

    # Testing a mail view
    //return new App\Mail\DevelopersApplicationResponse;

    /*
    #http://accounts.dalher.net/oauth/authorize?redirect_uri=http://google.es/gimme&client_id=1&scope=adaptative_r%20adaptative_w%20adaptative_d&response_type=token&state=pxsnrnj48l9dvfhaomb525ahhxt8w4kn
    return view('vendor/passport/authorize', []);
    */
});



/* 
 *
 *  Routes for profiles forms and actions
 * 
 */
Route::prefix('contracts')->group(function () {

    Route::get('/tos', function(){
        return view('contracts/tos');
    })->name('tos');

    Route::get('/privacy', function(){
        return view('contracts/privacy');
    })->name('privacy');

});



/* 
 *
 *  Routes for profiles forms and actions
 * 
 */
Route::prefix('profile')->middleware(['auth'])->group(function () {

    Route::get('/', function(){
        return redirect('/profile/show');
    })->name('profile');

    Route::get('/show', 'ProfileController@show');

    Route::get('/change/{field}', function ($field) {

        $changableFields = ['name', 'password'];
        $field = Route::current()->field;

        # Check if the field is acceptable
        if( in_array($field, $changableFields ) ){
            return App::call('App\Http\Controllers\ProfileController@showChangeForm', ['field' => $field]);
        }

        # The field is not acceptable, redirect
        return redirect('profile');
    });

    Route::post('/change/password', function () {

        # Check if the field is acceptable
        return App::call('App\Http\Controllers\ProfileController@updatePassword');
    });

    Route::post('/change/name', function () {

        # Check if the field is acceptable
        return App::call('App\Http\Controllers\ProfileController@updateName');
    });

});



/* 
 *
 *  Routes for developers only forms and actions
 * 
 */
Route::prefix('developers')->middleware(['auth'])->group(function () {
    ## ->middleware(['auth', 'verified'])

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
    })->name('clients');
    
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
    })->name('admin.developers.application');

    Route::post('/developers/application/{developer_id}', function ($developer_id) {
        return App::call('App\Http\Controllers\AdminController@ProcessDeveloperApplication', ['developer_id' => $developer_id]);
    });

});