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

Route::get('todo/list', 'TodoController@index')->name('todo.list');
Route::get('todo/create', 'TodoController@create')->name('todo.create');
Route::post('todo/store', 'TodoController@store')->name('todo.store');
Auth::routes();

Route::get('/home', 'HomeController@index');
