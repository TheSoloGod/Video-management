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

// index
Route::get('/', function () {
    return redirect()->route('home.public.index');
});
Route::get('/home', function () {
    return view('front_end.member.home-new');
})->name('home.new');

//verify email
Auth::routes(['verify' => true]);
Route::group(['verify' => true], function () {
    // Authentication Routes...
    Route::get('login', 'Frontend\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Frontend\Auth\LoginController@login');
    Route::post('logout', 'Frontend\Auth\LoginController@logout')->name('logout');
    // Registration Routes...
    Route::get('register', 'Frontend\Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Frontend\Auth\RegisterController@register');
    // Password Reset Routes...
    Route::get('password/reset', 'Frontend\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Frontend\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Frontend\Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Frontend\Auth\ResetPasswordController@reset')->name('password.update');
    // Email Verification Routes...
    Route::get('email/verify', 'Frontend\Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}', 'Frontend\Auth\VerificationController@verify')->name('verification.verify');
    Route::get('email/resend', 'Frontend\Auth\VerificationController@resend')->name('verification.resend');
});

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
    Route::get('/group/{group_id}/video/{video_id}', 'Frontend\Member\MemberController@showVideoInGroup')->name('member.group.video.show')->middleware('check.user.video.isInGroup');
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
Route::get('test', function () {
   return view('test-vue');
})->name('test');
//route api vuejs
Route::resource('products', 'Backend\Product\ProductController');



