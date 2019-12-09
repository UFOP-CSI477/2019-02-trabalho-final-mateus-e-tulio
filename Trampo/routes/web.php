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
    Route::get('/services', 'PostController@services')->name('services');
    Route::get('/freelancers', 'PostController@freelancers')->name('freelancers');
    Route::post('/profile/settings/general', 'UserController@generalSettings');
    Route::post('/profile/settings/security', 'UserController@securitySettings');

    Route::resource('posts', 'PostController');
    Route::get('/posts/{hire}/{id}', 'PostController@show')->name('posts.show');
    Route::post('/posts/dynamic', 'PostController@dynamic')->name('posts.dynamic');
    Route::post('/posts/dcat', 'PostController@dynamicCategories')->name('posts.dcat');

});

// Route::get('/home', function() {
//     return view('home');
// })->name('home')->middleware('auth');

Auth::routes();
