<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', function (Request $request)
{
    $categories = \App\Models\Category::where('name', 'like', '%' . $request->get('q') . '%')->get();
    return response()->json($categories);
});

Route::get('/groups', function (Request $request)
{
    $groups = \App\Models\Group::where('name', 'like', '%' . $request->get('q') . '%')->get();
    return response()->json($groups);
});
