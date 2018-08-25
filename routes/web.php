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
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::post('/teacher/signup', 'TeachersController@signup_store');
Route::get('/teacher/signup', 'TeachersController@signup');

Route::post('/volunteer/signup', 'VolunteersController@signup_store');
Route::get('/volunteer/signup', 'VolunteersController@signup');

/**
* only admin
*/
Route::group(['middleware' => ['role:Admin']], function () {
    Route::post('/admin/assignRole',  'RoleController@assignRole'); 
    Route::get('/admin/datatable/role_assign', 'RoleController@datatable_user_role');
    Route::get('/admin/role/assign',  'RoleController@assign')->name('role.assign'); 
    Route::resource('/admin/role',  'RoleController');  

    //Teacher Module
    Route::post('/ajax/delete-teacher', 'TeachersController@ajax_delete_teacher');
    Route::get('/datatable/teacher-list', 'TeachersController@teachers_list');
    Route::resource('teachers', 'TeachersController');


    //Volunteer Module
    Route::post('/ajax/delete-volunteer', 'VolunteersController@ajax_delete_volunteer');
    Route::get('/datatable/volunteer-list', 'VolunteersController@volunteers_list');
    Route::resource('volunteers', 'VolunteersController');
});


/**
* All
*/
Route::group(['middleware' => ['role:Admin|Teacher|Volunteer']], function () {
    Route::post('/update-password', 'UsersController@update_password');
    Route::get('/update-password', 'UsersController@show_update_password');
});



/**
* only Volunteer
*/
Route::group(['middleware' => ['role:Volunteer']], function () {
    Route::get('/volunteer/profile', 'VolunteersController@profile');
});




/**
* only Teacher
*/
Route::group(['middleware' => ['role:Teacher']], function () {
    Route::get('/teacher/profile', 'TeachersController@profile');
});