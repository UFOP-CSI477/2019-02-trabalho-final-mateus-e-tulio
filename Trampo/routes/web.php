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
    Route::resource('feedbacks', 'FeedbackController');
    Route::get('/feedbacks/store/{i_hired}/{id}/{user}', 'FeedbackController@store')->name('feedbacks.store');
    Route::get('/feedbacks/show/{id}', 'FeedbackController@show')->name('feedbacks.show');
    Route::get('/feedbacks/update/{i_hired}/{id}', 'FeedbackController@update')->name('feedbacks.update');
    Route::get('/posts/{hire}/{id}', 'PostController@show')->name('posts.show');
    Route::get('/posts/rate/{hire}/{id}/{user}', 'PostController@rate')->name('posts.rate');
    Route::get('/profile/{id}','UserController@otherProfile')->name('users.other_profile');
    Route::get('/sendMessageTo/{title}/{id}','UserController@sendMessageTo')->name('users.send_message_to');
    Route::get('/posts/interest/remove/{post_id}', 'PostController@removeInterest')->name('posts.remove_interest');
    Route::post('/posts/interest/express','PostController@expressInterest')->name('posts.express_interest');
    Route::post('/posts/dynamic', 'PostController@dynamic')->name('posts.dynamic');
    Route::post('/posts/dcat', 'PostController@dynamicCategories')->name('posts.dcat');

});

// Route::get('/home', function() {
//     return view('home');
// })->name('home')->middleware('auth');

Auth::routes();
