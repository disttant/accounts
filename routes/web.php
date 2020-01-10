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


# Protected routes
Auth::routes();

Route::get('/', function () {
    return redirect('home');
});

Route::get('/home', function () {
    #$user = Auth::User();
    #return view('home', ['user' => $user]);

    return redirect('profile');
})->name('home');



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
 *  Routes for developers forms and actions
 * 
 */
Route::prefix('developers')->middleware(['auth', 'developer.checker'])->group(function () {

    Route::get('/', function () {
        return redirect('/developers/clients/show');
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

