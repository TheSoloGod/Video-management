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
Route::group(['prefix' => 'admin'], function (){
    Route::get('/login', 'AdminController@getLogin');
    Route::post('/login', 'AdminController@postLogin')->name('admin.login');
    Route::get('overview', 'AdminController@overView')->name('admin.over-view');
    Route::resource('users', 'UserController')->except(['create', 'store']);
    Route::resource('videos', 'VideoController');
    Route::resource('groups', 'GroupController');
});

//route group member management
Route::group(['prefix' => 'admin/group/{group_id}'], function (){
    Route::get('/members', 'GroupMemberController@index')->name('group.member.index');
    Route::get('/member/{user_id}', 'GroupMemberController@removeMember')->name('group.member.remove');
    Route::get('/add-member', 'GroupMemberController@addMember')->name('group.member.add');
    Route::get('/add-invitation/{user_id}', 'GroupMemberController@addUserToInvitationList')->name('group.member.add-invitation');
//    Route::get('/invite', 'GroupController@invite')->name('group.member.invite');
});

//route group video management

//test upload
Route::get('/upload', function () {
    return view('testupload');
});
Route::post('/upload', 'UploadController@store')->name('post.file');

//test multiple login

//test send mail background jobs redis
Route::get('/invite', 'HomeController@invite')->name('invite');
