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

// index
Route::get('/', function () {
    return redirect()->route('home.public.index');
});
Route::get('/home', function (){
    return view('home-new');
})->name('home.new');

// route public
Route::group(['prefix' => 'public'], function () {
    Route::get('/', 'PublicController@index')->name('home.public.index')->middleware('check.user.login');
    Route::get('/video/{video_id}', 'PublicController@showVideo')->name('public.video.show');
});

// route member
Route::group(['prefix' => 'member/{user_id?}', 'middleware' => 'verified'], function () {
    Route::get('/', 'MemberController@index')->name('home.member.index');
    Route::get('/group', 'MemberController@getGroup')->name('member.group.all');
    Route::get('/group/{group_id}/video', 'MemberController@getVideoOfGroup')->name('member.group.video.all');
    Route::get('/video/{video_id}', 'MemberController@showVideo')->name('member.video.show');
    Route::get('/info', 'MemberController@info')->name('member.info');
    Route::get('/favorite', 'MemberController@favorite')->name('member.favorite');
    Route::get('favorite/video', 'MemberController@getPaginateVideoFavorite')->name('member.video.favorite.all');
    Route::get('favorite/video/{video_id}', 'MemberController@showVideoFavorite')->name('member.video.favorite.show');
});

// route search both public & member
Route::get('/search', 'VideoController@search')->name('navbar.search');


//route admin login logout
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'AdminController@getLogin')->name('admin');
    Route::post('/login', 'AdminController@postLogin')->name('admin.login');
    Route::get('/logout', 'AdminController@getLogout')->name('admin.logout');
});

//route resource admin with middleware
Route::group(['prefix' => 'admin', 'middleware' => 'check.admin.login'], function (){
    Route::get('overview', 'AdminController@overView')->name('admin.over-view');
    Route::resource('users', 'UserController')->except(['create', 'store']);
    Route::resource('videos', 'VideoController');
    Route::resource('groups', 'GroupController');
    Route::resource('categories', 'CategoryController');
});

//route group member management by admin
Route::group(['prefix' => 'admin/group/{group_id}', 'middleware' => 'check.admin.login'], function () {
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

//route group video management by admin
Route::group(['prefix' => 'admin/group/{group_id}', 'middleware' => 'check.admin.login'], function () {
    Route::get('/videos', 'GroupVideoController@showAllVideo')->name('group.video.all');
    Route::get('/video/{video_id}', 'GroupVideoController@removeVideo')->name('group.video.remove');
    Route::get('/add-video', 'GroupVideoController@addVideo')->name('group.video.add');
    Route::get('/show-addition', 'GroupVideoController@showAdditionVideoList')->name('group.video.show-addition');
    Route::get('/add-addition/{video_id}', 'GroupVideoController@addVideoToAdditionList')->name('group.video.add-addition');
    Route::get('/remove-addition/{video_id}', 'GroupVideoController@removeVideoFromAdditionList')->name('group.video.remove-addition');
    Route::get('/add-confirm', 'GroupVideoController@addVideoConfirm')->name('group.video.add-confirm');
});

//route analytics by admin
Route::group(['prefix' => 'admin/analytics', 'middleware' => 'check.admin.login'], function () {
    Route::resource('analytics', 'DateVideoController')->except(['edit', 'update', 'destroy']);
    Route::post('/search/date', 'DateVideoController@searchByDate')->name('analytics.search.date');
    Route::get('/search/date/{date?}', 'DateVideoController@resultSearchByDate')->name('analytics.search.date.result');
    Route::get('/export/{date}', 'DateVideoController@exportToExcel')->name('analytics.export.excel');
});




//route test
Route::get('test', 'DateVideoController@test')->name('test');
