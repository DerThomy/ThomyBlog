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

Route::middleware('auth:api,admin-api,superadmin-api')->get('/user', function (Request $request) {
    return $request->user();
});

// PostsAPI Routes

Route::get('posts', 'PostsApiController@index');
Route::get('post/{id}', 'PostsApiController@show');