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
Route::get('/auth/{provider}', 'SocialAuthController@redirectToProvider');
Route::get('/auth/{provide}/callback', 'SocialAuthController@handleProviderCallback');

Route::get('/test', 'AnimalController@test');
Route::get('/home', 'HomeController@index')->name('home');
route::get('post-list-pet','HomeController@postListPet');
route::get('/animal/list-in-common-home', 'HomeController@getListInCommonHome');
route::get('/api/animal/list-in-common-home','HomeController@postListInCommonHome');

route::get('/animal/list_ready_to_find_the_owner', 'HomeController@getListReadyToFindTheOwner');
route::get('/api/animal/list_ready_to_find_the_owner','HomeController@postListReadyToFindTheOwner');

route::get('/animal/list_has_owner', 'HomeController@getListHasOwner');
route::get('/api/animal/list_has_owner','HomeController@postListHasOwner');

route::get('/animal/list_die', 'HomeController@getListDie');
route::get('/api/animal/list_die','HomeController@postListDie');

route::get('/animal/detail_info/{animal_id}', 'AnimalController@animalInfo');

route::get('/hospital/list', 'HospitalController@getListHospital');
route::get('/api/get_list_hospital' , 'HospitalController@postListHospital');

route::get('/volunteer/list', 'VolunteerController@getListVolunteer');
route::get('/api/get_list_volunteer' , 'VolunteerController@postListVolunteer');
route::get('volunteer/info/{user_id}', 'VolunteerController@volunteerInfo');
route::post('volunteer/edit_info/{user_id}', 'VolunteerController@editInfo');
