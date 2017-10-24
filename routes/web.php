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
Route::get('/admin/create_user', 'adminController@getCreateUser')->middleware('system_admin');
Route::get('/admin/post/create_user', 'adminController@postCreateUser')->middleware('system_admin');

Route::get('/admin/create_case','adminController@getCreateCase')->middleware('system_admin');
Route::post('/admin/post/create_case','adminController@postCreateCase')->middleware('system_admin');

Route::get('/auth/{provider}', 'SocialAuthController@redirectToProvider');
Route::get('/auth/{provide}/callback', 'SocialAuthController@handleProviderCallback');

Route::get('/test', 'AnimalController@test');

route::get('/animal/list_image/all','HomeController@getListImageAnimal');
Route::get('/home', 'HomeController@index')->name('home');
route::get('post-list-pet','HomeController@postListAllAnimal');
route::get('/animal/list-in-common-home', 'HomeController@getListInCommonHome');
route::get('/api/animal/list-in-common-home','HomeController@postListInCommonHome');

route::get('/animal/list_ready_to_find_the_owner', 'HomeController@getListReadyToFindTheOwner');
route::get('/api/animal/list_ready_to_find_the_owner','HomeController@postListReadyToFindTheOwner');

route::get('/animal/list_has_owner', 'HomeController@getListHasOwner');
route::get('/api/animal/list_has_owner','HomeController@postListHasOwner');

route::get('/animal/list_die', 'HomeController@getListDie');
route::get('/api/animal/list_die','HomeController@postListDie');

route::get('/animal/detail_info/{animal_id}', 'AnimalController@getAnimalInfo');

route::post('/animal/add_image', 'AnimalController@postAddImage')->middleware('system_admin');
route::post('/animal/edit/edit-create-at/{animal_id}', 'AnimalController@editCreateAt')->middleware('system_admin');
// route::post('/animal/edit/edit-status/{animal_id}', 'AnimalController@editStatus');
route::post('/animal/edit/edit-address/{animal_id}', 'AnimalController@editAddress')->middleware('system_admin');
route::post('/animal/edit/edit-name/{animal_id}', 'AnimalController@editName')->middleware('system_admin');
route::post('/animal/edit/edit-type/{animal_id}', 'AnimalController@editType')->middleware('system_admin');
route::post('/animal/edit/edit-description/{animal_id}', 'AnimalController@editDescription')->middleware('system_admin');

route::get('/animal_image/delete/{imageId}', 'AnimalController@deleteImage');
route::post('/animal_image/change/{imageId}', 'AnimalController@changeImage');


route::get('/hospital/list', 'HospitalController@getListHospital');
route::get('/api/get_list_hospital' , 'HospitalController@postListHospital');
route::get('hospital/detail_info/{hospitalId}', 'HospitalController@detailHospital');


route::get('/volunteer/list', 'VolunteerController@getListVolunteer');
route::get('/api/get_list_volunteer' , 'VolunteerController@postListVolunteer');
route::get('volunteer/info/{user_id}', 'VolunteerController@volunteerInfo');
route::post('volunteer/edit_info/{user_id}', 'VolunteerController@editInfo');


route::get('/api/get_all_status', 'StatusController@getAllStatus');