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

//ROUTE FRONT END

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
    Route::get('/video/{video_id}', 'PublicController@showVideo')->name('public.video.show')->middleware('check.video.isPublic');
});

// route member
Route::group(['prefix' => 'member/{user_id?}', 'middleware' => 'verified'], function () {
    Route::get('/', 'MemberController@index')->name('home.member.index');
    Route::get('/group', 'MemberController@getGroup')->name('member.group.all');
    Route::get('/group/{group_id}/video', 'MemberController@getVideoOfGroup')->name('member.group.video.all');
    Route::get('/group/{group_id}/video/{video_id}', 'MemberController@showVideo    InGroup')->name('member.group.video.show')->middleware('check.user.video.isInGroup');
    Route::get('/video/{video_id}', 'MemberController@showVideo')->name('member.video.show')->middleware('check.video.isInGroup');
    Route::get('/info', 'MemberController@info')->name('member.info');
    Route::get('/favorite', 'MemberController@favorite')->name('member.favorite');
    Route::get('favorite/video', 'MemberController@getPaginateVideoFavorite')->name('member.video.favorite.all');
    Route::get('favorite/video/{video_id}', 'MemberController@showVideoFavorite')->name('member.video.favorite.show');
});

// route search both public & member
Route::get('/search', 'VideoController@search')->name('navbar.search');
Route::get('/category/{category_id}', 'VideoController@getPaginateVideoOfCategory')->name('category.filter');






//ROUTE TEST

//route test
//Route::post('test', function (){
//    $data = ['status' => true];
//    return $data;
//})->name('test');



