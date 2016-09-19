<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();
Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'namespace' => 'Admin'], function(){
        Route::resource('user', 'UserController', ['except' => ['show', 'create']]);
        Route::resource('category', 'CategoryController', ['except' => ['show']]);
        Route::resource('word', 'WordController', ['except' => ['show']]);
        Route::resource('anwser', 'AnwserController', ['only' => ['destroy']]);
    });
    Route::resource('user', 'UserController', ['only' => [
        'show', 'edit', 'update'
    ]]);
    Route::resource('category', 'CategoryController', ['only' => ['index']]);
    Route::resource('relationship', 'RelationshipController', ['only' => [
        'store', 'destroy'
    ]]);
    Route::resource('word', 'WordController', ['only' => 'index']);
    Route::get('/user/{user}/following', 'UserController@getFollowing');
    Route::get('/user/{user}/followers', 'UserController@getFollowers');
    Route::resource('lesson', 'LessonController', ['only' => ['store', 'show', 'update', 'index']]);
});

Route::resource('user','UserController');
