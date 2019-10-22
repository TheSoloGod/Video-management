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

Route::get('/', function () {
    return view('welcome');
})->middleware('verified');

Auth::routes(['verify' => true]); //test verify email

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/invite', 'HomeController@invite')->name('invite'); //test send mail background jobs redis

//test multiple login


//route admin
Route::group(['prefix' => 'admin'], function (){
    Route::get('/login', 'AdminController@getLogin');
    Route::post('/login', 'AdminController@postLogin')->name('admin.login');
    Route::get('overview', 'AdminController@overView')->name('admin.over-view');
    Route::resource('users', 'UserController');
});

