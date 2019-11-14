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
    Route::get('/', 'Frontend\PublicView\PublicController@index')->name('home.public.index')->middleware('check.user.login');
    Route::get('/video/{video_id}', 'Frontend\PublicView\PublicController@showVideo')->name('public.video.show')->middleware('check.video.isPublic');
});

// route member
Route::group(['prefix' => 'member/{user_id?}', 'middleware' => 'verified'], function () {
    Route::get('/', 'Frontend\Member\MemberController@index')->name('home.member.index');
    Route::get('/group', 'Frontend\Member\MemberController@getGroup')->name('member.group.all');
    Route::get('/group/{group_id}/video', 'Frontend\Member\MemberController@getVideoOfGroup')->name('member.group.video.all');
    Route::get('/group/{group_id}/video/{video_id}', 'Frontend\Member\MemberController@showVideo    InGroup')->name('member.group.video.show')->middleware('check.user.video.isInGroup');
    Route::get('/video/{video_id}', 'Frontend\Member\MemberController@showVideo')->name('member.video.show')->middleware('check.video.isInGroup');
    Route::get('/info', 'Frontend\Member\MemberController@info')->name('member.info');
    Route::get('/favorite', 'Frontend\Member\MemberController@favorite')->name('member.favorite');
    Route::get('favorite/video', 'Frontend\Member\MemberController@getPaginateVideoFavorite')->name('member.video.favorite.all');
    Route::get('favorite/video/{video_id}', 'Frontend\Member\MemberController@showVideoFavorite')->name('member.video.favorite.show');
});

// route search both public & member
Route::get('/search', 'Backend\Video\VideoController@search')->name('navbar.search');
Route::get('/category/{category_id}', 'Backend\Video\VideoController@getPaginateVideoOfCategory')->name('category.filter');






//ROUTE TEST

//route test
Route::get('test', function (){
    dd(\Illuminate\Support\Facades\Session::get('uploadStatus'));

})->name('test');



