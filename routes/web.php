<?php


use Illuminate\Support\Facades\Input;

Auth::routes();

Route::get('/', 'MainController@index')->name('main');

Route::get('/home', 'HomeController@index')->name('home');

//did
Route::get('/did', 'DidController@index')->name('did');


Route::group(['middleware' => 'auth'], function () {
    Route::get('main/create', 'MainController@create')->name('createMain');
    Route::post('main/store', 'MainController@store')->name('storeMain');
    Route::get('main/edit', 'MainController@edit')->name('editMain');
    Route::post('main/update', 'MainController@update')->name('updateMain');
    Route::get('did/create', 'DidController@create')->name('createDid');
    Route::post('did/store', 'DidController@store')->name('storeDid');
});