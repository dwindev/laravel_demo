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
Route::group(['middleware' => 'auth'], function () {

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'ProfileController@index');
Route::get('/profile/details', 'ProfileController@profileDetails');
Route::put('/profile/update', 'ProfileController@update');
Route::post('/profile/picture', 'ProfileController@updateProfilePicture');
Route::post('/posts', 'PostController@index');
Route::post('/post/create', 'PostController@store');
Route::put('/post/update', 'PostController@update');
Route::delete('/post/delete/{id}', 'PostController@destroy');
Route::post('/comment/create', 'CommentController@store');
Route::put('/comment/update', 'CommentController@update');
Route::delete('/comment/delete/{id}', 'CommentController@destroy');

});

