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

Route::middleware('auth:api')->group(function () {
    //CommentsAPI
    Route::post('post/{post}/comment', 'CommentController@store');
});

// CommentsAPI Routes

Route::get('post/{post}/comments', 'CommentController@index');

// PostsAPI Routes

Route::get('posts', 'PostsApiController@index');
Route::get('post/{id}', 'PostsApiController@show');
