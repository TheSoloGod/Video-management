<?php

//ROUTE BACK END


//route admin login logout
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Backend\Admin\AdminController@overView');
    Route::get('/login', 'Backend\Admin\AdminController@getLogin')->name('admin');
    Route::post('/login', 'Backend\Admin\AdminController@postLogin')->name('admin.login');
    Route::get('/logout', 'Backend\Admin\AdminController@getLogout')->name('admin.logout');
});

//route resource admin with middleware
Route::group(['prefix' => 'admin', 'middleware' => 'check.admin.login'], function (){
    Route::get('overview', 'Backend\Admin\AdminController@overView')->name('admin.over-view');
    Route::resource('users', 'UserController')->except(['create', 'store']);
    Route::resource('videos', 'VideoController')->except(['store']);
    Route::resource('groups', 'GroupController');
    Route::resource('categories', 'CategoryController');
});

//route upload video
Route::group(['prefix' => 'admin/video'], function (){
    Route::post('/upload', 'VideoController@uploadVideoProgressBar')->name('admin.video.upload');
    Route::post('/store', 'VideoController@storeVideoInfo')->name('admin.video.store');
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
//    Route::get('/add-video/notification', 'GroupVideoController@sendNotificationUser')->name('group.video.add.notification');
});

//route analytics by admin
Route::group(['prefix' => 'admin/analytics', 'middleware' => 'check.admin.login'], function () {
    Route::resource('analytics', 'DateVideoController')->except(['edit', 'update', 'destroy']);
    Route::post('/search/date', 'DateVideoController@searchByDate')->name('analytics.search.date');
    Route::get('/search/date/{date?}', 'DateVideoController@resultSearchByDate')->name('analytics.search.date.result');
    Route::get('/export/{date}', 'DateVideoController@exportToExcel')->name('analytics.export.excel');
});
