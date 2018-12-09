<?php


use Illuminate\Support\Facades\Input;

Auth::routes();

Route::get('/', 'MainController@index')->name('main');

Route::get('/home', 'HomeController@rand')->name('home');

//did
Route::get('/did', 'DidController@index')->name('did');

Route::get('/mail', 'DidController@sendMail')->name('mail');

Route::get('rand', 'RandController@index')->name('rand');

//маршруты администратора
Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/', 'AdminController@did')->name('admin');
    Route::get('admin/did/{id}', 'AdminController@showDid')->name('showDid');
    Route::get('admin/rand/{id}', 'AdminController@showRand')->name('showRand');
    Route::get('admin/did/delete/{id}', 'AdminController@deleteDid')->name('deleteDid')->middleware('superAdmin');
    Route::get('admin/rand/delete/{id}', 'AdminController@deleteRand')->name('deleteRand')->middleware('superAdmin');
    Route::get('admin/did', 'AdminController@didIndex')->name('adminDid');
    Route::get('admin/rand', 'AdminController@randIndex')->name('adminRand');
    Route::get('admin/Organizer', 'AdminController@Organizer')->name('makeOrganizer')->middleware('superAdmin');;
    Route::get('admin/getUsers', 'AdminController@getUsers')->name('getUsers');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('main/create', 'MainController@create')->name('createMain');
    Route::post('main/store', 'MainController@store')->name('storeMain');
    Route::get('main/edit', 'MainController@edit')->name('editMain');
    Route::post('main/update', 'MainController@update')->name('updateMain');
    Route::get('did/create', 'DidController@create')->name('createDid');
    Route::post('did/store', 'DidController@store')->name('storeDid');


    //рандомный контент
    Route::get('rand/create', 'RandController@create')->name('createRand');
    Route::post('rand/store', 'RandController@store')->name('storeRand');
});