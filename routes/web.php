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

//verify email
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

//route admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'AdminController@getLogin');
    Route::post('/login', 'AdminController@postLogin')->name('admin.login');
    Route::get('overview', 'AdminController@overView')->name('admin.over-view');
    Route::resource('users', 'UserController')->except(['create', 'store']);
    Route::resource('videos', 'VideoController');
    Route::resource('groups', 'GroupController');
});

//route group member management
Route::group(['prefix' => 'admin/group/{group_id}'], function () {
    Route::get('/members', 'GroupUserController@index')->name('group.member.index');
    Route::get('/member/{user_id}', 'GroupUserController@removeMember')->name('group.member.remove');
    Route::get('/add-member', 'GroupUserController@addMember')->name('group.member.add');
    Route::get('/show-invitation', 'GroupUserController@showInvitationList')->name('group.member.show-invitation');
    Route::get('/add-invitation/{user_id}', 'GroupUserController@addUserToInvitationList')->name('group.member.add-invitation');
    Route::get('/remove-invitation/{user_id}', 'GroupUserController@removeUserFromInvitationList')->name('group.member.remove-invitation');
    Route::get('/invite/{user_id}', 'GroupUserController@inviteUser')->name('group.member.invite');
});

// route verify invite member
Route::get('/group/invite/verify/{group_id?}/{user_id?}/{token?}', 'GroupUserController@verifyInvitationEmail')->name('group.member.verify');

//route group video management

//test upload
Route::get('/upload', function () {
    return view('testupload');
});
Route::post('/upload', 'UploadController@store')->name('post.file');

// route test
Route::get('test', function () {
    dd(session()->get('invitationList'));
})->name('test');
