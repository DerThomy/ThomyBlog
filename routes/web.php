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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // Password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});

Route::prefix('superadmin')->group(function() {
    Route::get('/login', 'Auth\SuperAdminLoginController@showLoginForm')->name('superadmin.login');
    Route::post('/login', 'Auth\SuperAdminLoginController@login')->name('superadmin.login.submit');
    Route::get('/', 'SuperAdminController@index')->name('superadmin.dashboard');
    Route::get('/logout', 'Auth\SuperAdminLoginController@logout')->name('superadmin.logout');

    //Password reset routes
    Route::post('/password/email', 'Auth\SuperAdminForgotPasswordController@sendResetLinkEmail')->name('superadmin.password.email');
    Route::get('/password/reset', 'Auth\SuperAdminForgotPasswordController@showLinkRequestForm')->name('superadmin.password.request');
    Route::post('/password/reset', 'Auth\SuperAdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\SuperAdminResetPasswordController@showResetForm')->name('superadmin.password.reset');
});
