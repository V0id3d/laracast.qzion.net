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

/**
 * Index all Threads
 */
Route::prefix('threads')->group(function () {
  Route::get('/', 'ThreadsController@index');
  Route::get('/{thread}', 'ThreadsController@show');
  Route::get('create', 'ThreadsController@create');

  Route::post('/{thread}/replies', 'RepliesController@store');
  Route::post('/', 'ThreadsController@store');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
