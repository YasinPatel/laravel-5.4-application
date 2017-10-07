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

// For Admin

// admin login page
Route::get('/admin/login','Admin\DefaultController@showLoginForm');
Route::post('/admin/login','Admin\DefaultController@login');
Route::get('/admin/logout','Admin\DefaultController@logout');

//facebook login
Route::get('/admin/login/facebook','Admin\DefaultController@redirectToFacebook')->name('facebook_login');
Route::get('/admin/login/facebook/callback','Admin\DefaultController@handleFacebookCallback');

//google login
Route::get('/admin/login/google','Admin\DefaultController@redirectToGoogle')->name('google_login');
Route::get('/admin/login/google/callback','Admin\DefaultController@handleGoogleCallback');

// forgot password
Route::get('/admin/password/reset','Admin\ForgorPasswordController@showLinkRequestForm')->name('forgot_password');
Route::post('/admin/password/email','Admin\ForgorPasswordController@sendResetLinkEmail');

// reset password
Route::get('/admin/password/reset/{token}','Admin\ResetPasswordController@showResetForm');
Route::post('/admin/password/reset','Admin\ResetPasswordController@reset');


//admin index page
Route::get('/admin','Admin\DefaultController@index')->name('admin_home');

// get user data
Route::get('/admin/getuserdata','Admin\UserController@anyData')->name('getuserdata');


Route::resource('admin/user','Admin\UserController',[
  'parameters'=>[
    'user'=>'id',
  ]
]);

// Website user
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
