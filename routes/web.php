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


Route::group(['middleware' => ['web','auth']], function () {
    Route::get('/home', 'TodoController@index');
    Route::get('todo/list', 'TodoController@index')->name('todo.list');
    Route::get('todo/create', 'TodoController@create')->name('todo.create');
    Route::post('todo/store', 'TodoController@store')->name('todo.store');
    Route::get('todo/detail/{id}', 'TodoController@show')->name('todo.detail');
    Route::patch('todo/update/{id}', 'TodoController@update')->name('todo.update');
    Route::delete('todo/delete/{id}', 'TodoController@destroy')->name('todo.destroy');
    Route::post('todo/share', 'TodoController@share')->name('todo.share');
});

Route::get('/mail/test', 'MailController@test');
Auth::routes();


