<?php


use Illuminate\Support\Facades\Input;

Auth::routes();

Route::get('/', 'MainController@index')->name('main');

Route::get('/home', 'HomeController@a')->name('home');

//b


Route::get('/mail', 'BController@sendMail')->name('mail');


Route::get('b/{id}', 'BController@show')->name('bDetail')->middleware('accessARand');
Route::get('a/{id}', 'AController@show')->name('aDetail')->middleware('accessBRand');

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
    /*   Route::get('a/create', 'AController@create')->name('createA');
       Route::get('b/create', 'BController@create')->name('createB');*/
    Route::get('aa/create', 'AController@create')->name('createA1');
    Route::get('bb/create', 'BController@create')->name('createB1');

    Route::post('b/store', 'BController@store')->name('storeB');
    Route::get('did2/', 'BController@store')->name('storeB');

    //рандомный контент

    Route::post('a/store', 'AController@store')->name('storeA');
    Route::get('a', 'AController@index')->name('a');
    Route::get('b', 'BController@index')->name('b');
});