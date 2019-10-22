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

    $user = Auth::User();
    return view('home', ['user' => $user]);
});

Route::get('/profile', function(){
    return redirect('/profile/show');
})->name('profile');

Route::get('/profile/show', 'ProfileController@show');

Route::get('/profile/change/{field}', function ($field) {

    $changableFields = ['name', 'password'];
    $field = Route::current()->field;

    # Check if the field is acceptable
    if( in_array($field, $changableFields ) ){
        return App::call('App\Http\Controllers\ProfileController@showChangeForm', ['field' => $field]);
    }

    # The field is not acceptable, redirect
    return redirect('profile');
});

Route::post('/profile/change/password', function () {

    # Check if the field is acceptable
    return App::call('App\Http\Controllers\ProfileController@updatePassword');
});

Route::post('/profile/change/name', function () {

    # Check if the field is acceptable
    return App::call('App\Http\Controllers\ProfileController@updateName');
});

Route::get('/developers', function () {
    
    return redirect('/developers/clients/show');
});

Route::get('/developers/clients/show', function () {
    return App::call('App\Http\Controllers\DevelopersController@showClients');
});

Route::get('/developers/clients/create', function () {
    return App::call('App\Http\Controllers\DevelopersController@showNewClientForm');
});

Route::post('/developers/clients/create', function () {
    return App::call('App\Http\Controllers\DevelopersController@createClient');
});