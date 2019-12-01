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
    return view('login');
});

Route::group(['middleware' => ['auth']], function(){
    Route::get('/notifications', 'UserController@notifications');
    Route::get('/profile', 'UserController@index');
    Route::get('/publish', 'PostController@publish');
    Route::post('/publish', 'PostController@storePublish');
    Route::get('/services', 'PostController@services');
    Route::get('/freelancers', 'PostController@freelancers');
    Route::get('/profile/settings/general', 'UserController@generalSettings');
    Route::get('/profile/settings/security', 'UserController@securitySettings');
});

// Route::get('/home', function() {
//     return view('home');
// })->name('home')->middleware('auth');

Auth::routes();
