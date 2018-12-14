<?php


use Illuminate\Support\Facades\Input;

Auth::routes();

Route::get('/', 'MainController@index')->name('main');

Route::get('/home', 'HomeController@a')->name('home');


Route::get('/mail', 'BController@sendMail')->name('mail');

Route::get('b/{id}', 'BController@show')->name('bDetail')->middleware('accessBRand');
Route::get('a/{id}', 'AController@show')->name('aDetail')->middleware('accessARand');

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
    Route::get('admin/Organizer', 'AdminController@Organizer')->name('makeOrganizer')/*->middleware('superAdmin');*/
    ;
    Route::get('admin/getUsers', 'AdminController@getUsers')->name('getUsers');
});

Route::post('b/store', 'BController@store')->name('storeB');

Route::post('a/store', 'AController@store')->name('storeA');
Route::get('a/store', 'AController@store')->name('storeAget');

Route::group(['middleware' => 'auth'], function () {
    Route::get('main/create', 'MainController@create')->name('createMain')->middleware('superAdmin');
    Route::post('main/store', 'MainController@store')->name('storeMain')->middleware('superAdmin');
    Route::get('main/edit', 'MainController@edit')->name('editMain')->middleware('superAdmin');
    Route::post('main/update', 'MainController@update')->name('updateMain');
    Route::get('aa/create', 'AController@create')->name('createA1');
    Route::get('bb/create', 'BController@create')->name('createB1');

    //рандомный контент
    Route::get('a', 'AController@index')->name('a');
    Route::get('b', 'BController@index')->name('b');
});