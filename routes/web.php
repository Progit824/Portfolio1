<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

// Auth::routes();
Auth::routes(['verify'=>true]);

Route::middleware(['verified'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/task', 'TaskController');
    Route::get('/home/mylist','HomeController@mylist')->name('mylist');

    Route::middleware(['can:admin'])->group(function(){
        Route::get('/profile/index', 'ProfileController@index')->name('profile.index');
        Route::delete('profile/delete/{user}','ProfileController@delete')->name('profile.delete');
        Route::put('/roles/{user}/attach','RoleController@attach')->name('role.attach');
        Route::put('/roles/{user}]detach','RoleController@detach')->name('role.detach');
    });
    Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');
    Route::put('/profile/{user}', 'ProfileController@update')->name('profile.update');

});



