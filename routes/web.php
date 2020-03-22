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
    return redirect()->route('todo.index');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
	Route::resource('todo', 'TodoController');
	Route::get('todo.search', 'TodoController@search')->name('todo.search');
	Route::resource('folder', 'FolderController');
});