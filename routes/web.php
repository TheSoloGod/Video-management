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

//verify email
Auth::routes(['verify' => true]);

// route public
Route::get('/', 'PublicController@index')->name('home.public.index');
Route::group(['prefix' => 'public'], function (){
   Route::get('/video/{video_id}', 'PublicController@showVideo')->name('home.public.show');
});





//route member
Route::get('/home', 'HomeController@index')->name('home');


//route admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'AdminController@getLogin');
    Route::post('/login', 'AdminController@postLogin')->name('admin.login');
    Route::get('overview', 'AdminController@overView')->name('admin.over-view');
    Route::resource('users', 'UserController')->except(['create', 'store']);
    Route::resource('videos', 'VideoController');
    Route::resource('groups', 'GroupController');
    Route::resource('categories', 'CategoryController');
    Route::resource('analytics', 'DateVideoController')->except(['edit', 'update', 'destroy']);
});

//route group member management
Route::group(['prefix' => 'admin/group/{group_id}'], function () {
    Route::get('/members', 'GroupUserController@showAllMember')->name('group.member.all');
    Route::get('/member/invited', 'GroupUserController@showInvitedUser')->name('group.member.invited');
    Route::get('/member/{user_id}', 'GroupUserController@removeMember')->name('group.member.remove');
    Route::get('/add-member', 'GroupUserController@addMember')->name('group.member.add');
    Route::get('/show-invitation', 'GroupUserController@showInvitationList')->name('group.member.show-invitation');
    Route::get('/add-invitation/{user_id}', 'GroupUserController@addUserToInvitationList')->name('group.member.add-invitation');
    Route::get('/remove-invitation/{user_id}', 'GroupUserController@removeUserFromInvitationList')->name('group.member.remove-invitation');
    Route::get('/invite', 'GroupUserController@inviteUser')->name('group.member.invite');
});

//route verify invite member
Route::get('/group/invite/verify/{group_id?}/{user_id?}/{token?}', 'GroupUserController@verifyInvitationEmail')->name('group.member.verify');

//route group video management
Route::group(['prefix' => 'admin/group/{group_id}'], function () {
    Route::get('/videos', 'GroupVideoController@showAllVideo')->name('group.video.all');
    Route::get('/video/{video_id}', 'GroupVideoController@removeVideo')->name('group.video.remove');
    Route::get('/add-video', 'GroupVideoController@addVideo')->name('group.video.add');
    Route::get('/show-addition', 'GroupVideoController@showAdditionVideoList')->name('group.video.show-addition');
    Route::get('/add-addition/{video_id}', 'GroupVideoController@addVideoToAdditionList')->name('group.video.add-addition');
    Route::get('/remove-addition/{video_id}', 'GroupVideoController@removeVideoFromAdditionList')->name('group.video.remove-addition');
    Route::get('/add-confirm', 'GroupVideoController@addVideoConfirm')->name('group.video.add-confirm');
});

//route analytics
Route::group(['prefix' => 'admin/analytics'], function (){
   Route::post('/search/date', 'DateVideoController@searchByDate')->name('analytics.search.date');
   Route::get('/search/date/{date?}', 'DateVideoController@resultSearchByDate')->name('analytics.search.date.result');
});








//route test
Route::get('test', function () {
    dd(session()->get('additionVideoList'));
})->name('test');
