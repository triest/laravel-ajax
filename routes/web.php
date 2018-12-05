<?php


use Illuminate\Support\Facades\Input;

Auth::routes();

Route::get('/', 'MainController@index')->name('main');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
