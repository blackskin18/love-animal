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

Auth::routes();

Route::get('/test', 'PetController@test');
Route::get('/home', 'HomeController@index')->name('home');
route::get('post-list-pet','HomeController@postListPet');
route::get('/list-in-common-home', 'HomeController@getListInCommonHome');
route::get('api/animal/list-in-common-home','HomeController@postListInCommonHome');	