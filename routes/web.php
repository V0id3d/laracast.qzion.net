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

/*
 * Index all Threads
 */
Route::prefix('threads')->group(function () {
    Route::get('create', 'ThreadsController@create')->name('Thread.Create');
    Route::get('/{channel}/{thread}', 'ThreadsController@show')->name('Thread.Show');
    Route::get('/', 'ThreadsController@index')->name('Thread.Index');

    Route::post('/{channel}/{thread}/replies', 'RepliesController@store')->name('Thread.Reply.Store');
    Route::post('/', 'ThreadsController@store')->name('Thread.Store');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
