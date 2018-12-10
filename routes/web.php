<?php


use Illuminate\Support\Facades\Input;

Auth::routes();

Route::get('/', 'MainController@index')->name('main');

Route::get('/home', 'HomeController@a')->name('home');

//b


Route::get('/mail', 'DidController@sendMail')->name('mail');

Route::get('a', 'RandController@index')->name('a');
Route::get('b', 'DidController@index')->name('b');
Route::get('b/{id}', 'DidController@show')->name('bDetail')->middleware('accessADid');
Route::get('a/{id}', 'RandController@show')->name('aDetail')->middleware('accessBRand');

Route::post('admin/makeB', 'AdminController@makeB')->name('makeB');
Route::post('admin/makeA', 'AdminController@makeA')->name('makeA');

Route::post('admin/deleteB', 'AdminController@deleteUserB')->name('deleteDid');
Route::post('admin/deleteA', 'AdminController@deleteUserA')->name('deleteRand');

//маршруты администратора
Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/', 'AdminController@b')->name('admin');
    Route::get('admin/b/{id}', 'AdminController@showB')->name('showB');
    Route::get('admin/a/{id}', 'AdminController@showA')->name('showA');
    Route::get('admin/b/delete/{id}', 'AdminController@deleteB')->name('deleteB')->middleware('superAdmin');
    Route::get('admin/a/delete/{id}', 'AdminController@deleteA')->name('deleteA')->middleware('superAdmin');
    Route::get('admin/b', 'AdminController@didIndex')->name('adminB');
    Route::get('admin/a', 'AdminController@randIndex')->name('adminA');
    Route::get('admin/Organizer', 'AdminController@Organizer')->name('makeOrganizer')->middleware('superAdmin');;
    Route::get('admin/getUsers', 'AdminController@getUsers')->name('getUsers');

    //  Route::get('admin/makeDid', 'AdminController@makeDid')->name('makeDid2');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('main/create', 'MainController@create')->name('createMain');
    Route::post('main/store', 'MainController@store')->name('storeMain');
    Route::get('main/edit', 'MainController@edit')->name('editMain');
    Route::post('main/update', 'MainController@update')->name('updateMain');

    Route::get('b/create', 'DidController@create')->name('createB');
    Route::post('b/store', 'DidController@store')->name('storeB');
    Route::get('did2/', 'DidController@store')->name('storeB');

    //рандомный контент
    Route::get('a/create', 'RandController@create')->name('createA');
    Route::post('a/store', 'RandController@store')->name('storeA');
});