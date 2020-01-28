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
    return redirect('profile');
});

/*Route::get('/home', function () {
    #$user = Auth::User();
    #return view('home', ['user' => $user]);

    return redirect('profile');
})->name('home');*/

Route::get('/test', function () {
    /*
    foreach ( Auth::user()->roles()->orderBy('name')->get() as $result ){
        echo $result->name ;
    }
    */

    //Mail::to( config('mail.from.address') )->send(new DeveloperApplication());
});

/*Route::get('mailable', function () {
    //$invoice = App\Invoice::find(1);
    return new App\Mail\DeveloperApplication('caca de la vaca');
});*/



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

    Route::get('/apply', function () {
        return App::call('App\Http\Controllers\DevelopersController@showDeveloperApplyForm');
    });

    Route::post('/apply', function () {

        return App::call('App\Http\Controllers\DevelopersController@createDeveloper');

    });

});



/* 
 *
 *  Routes for developers only forms and actions
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



/* 
 *
 *  Routes for administration
 * 
 */
Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/developers/application/{developer_id}', function ($developer_id) {

        # Show the application view for confirming that developer
        return App::call('App\Http\Controllers\AdminController@showDeveloperApplicationForm', ['developer_id' => $developer_id]);

    })->where('developer_id', '[0-9]+')->name('admin.developers.application');

    Route::post('/developers/application/{developer_id}', function ($developer_id) {

        # Show the application view for confirming that developer
        return App::call('App\Http\Controllers\AdminController@ProcessDeveloperApplication', ['developer_id' => $developer_id]);

    })->where('developer_id', '[0-9]+');




    /*Route::get('/', function(){
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
    });*/

});