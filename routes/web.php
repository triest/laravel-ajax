<?php


use Illuminate\Support\Facades\Input;

Auth::routes();

Route::get('/', 'MainController@index')->name('main');

Route::get('/home', 'HomeController@rand')->name('home');

//did
Route::get('/did', 'DidController@index')->name('did');

Route::get('/mail', 'DidController@sendMail')->name('mail');

Route::get('rand', 'RandController@rand')->name('rand');

//маршруты администратора
Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/', 'AdminController@index')->name('admin');
    Route::get('admin/did/{id}', 'AdminController@showDid')->name('showDid');
    Route::get('admin/did/delete/{id}', 'AdminController@deleteDid')->name('deleteDid')->middleware('superAdmin');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('main/create', 'MainController@create')->name('createMain');
    Route::post('main/store', 'MainController@store')->name('storeMain');
    Route::get('main/edit', 'MainController@edit')->name('editMain');
    Route::post('main/update', 'MainController@update')->name('updateMain');
    Route::get('did/create', 'DidController@create')->name('createDid');
    Route::post('did/store', 'DidController@store')->name('storeDid');

    //рандомный контент

});