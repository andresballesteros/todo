<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'Auth\LoginController@showLoginForm')->name('index');
Route::group(['middleware' => 'auth'], function () {
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('respuestas/export/', 'HomeController@export')->name('home.export');

    Route::resource('usuarios', 'UserController');

    Route::resource('todos', 'TodoController');
    Route::get('complete/{todo}', 'TodoController@complete')->name('todo.complete');
    Route::get('incomplete/{todo}', 'TodoController@incomplete')->name('todo.incomplete');

    Route::get('observaciones/{todo}/create', 'ObservacionTodoController@create')->name('observaciones.create');
    Route::post('observaciones/{todo}/store', 'ObservacionTodoController@store')->name('observaciones.store');
    Route::get('observaciones/{observacionTodo}/edit', 'ObservacionTodoController@edit')->name('observaciones.edit');
    Route::put('observaciones/{observacionTodo}', 'ObservacionTodoController@update')->name('observaciones.update');
    Route::delete('observaciones/{observacionTodo}', 'ObservacionTodoController@destroy')->name('observaciones.destroy');


    Route::get('perfil', 'UserController@profile')->name('user.profile');
    Route::put('perfil/{usuario}', 'UserController@updatePassword')->name('user.updatePassword');

    Route::resource('roles', 'RolesController');
});


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');



Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
