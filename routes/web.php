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

Route::get('/', 'PageController@index')->name('index');
Route::post('/video/{video}/like', 'VideoLikeController@like')->name('likeVideo');
Route::post('/video/{video}/dislike', 'VideoLikeController@dislike')->name('dislikeVideo');
Route::resource('video', 'VideoController');


Route::post('/{channel}/subscribe', 'UserController@subscribe')->name('subscribe');
Route::post('/{channel}/unsubscribe', 'UserController@unsubscribe')->name('unsubscribe');



Route::get('/logout', 'Auth\LoginController@logout');
Auth::routes();


