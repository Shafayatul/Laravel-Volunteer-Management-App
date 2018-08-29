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


Route::group(['middleware' => ['auth']], function() {

    /**
    * only admin
    */
    Route::group(['middleware' => ['role:Admin']], function () {
        Route::post('/admin/assignRole',  'RoleController@assignRole'); 
        Route::resource('/admin/role',  'RoleController');  

        //Teacher Module
        Route::post('/ajax/delete-teacher', 'TeachersController@ajax_delete_teacher');
        Route::get('/datatable/teacher-list', 'TeachersController@teachers_list');
        Route::resource('teachers', 'TeachersController');
        Route::get('/admin/teachers/profile/{id}', 'TeachersController@profile_admin');


        //Volunteer Module
        Route::post('/ajax/delete-volunteer', 'VolunteersController@ajax_delete_volunteer');
        Route::get('/datatable/volunteer-list', 'VolunteersController@volunteers_list');
        Route::resource('volunteers', 'VolunteersController');
        Route::get('/admin/volunteers/profile/{id}', 'VolunteersController@profile_admin');

        //Opportunity Module
        Route::get('/opportunities/all', 'OpportunitiesController@all');
        Route::get('/datatable/opportunity-all-list', 'OpportunitiesController@opportunities_all_list');
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
        
        //pofile
        Route::get('/volunteer/profile', 'VolunteersController@profile');
        
        //Opportunity Module
        Route::post('/opportunities/accept', 'OpportunitiesController@accept');
        Route::get('/opportunities/decision/{id}', 'OpportunitiesController@decision');
        Route::get('/opportunities/new', 'OpportunitiesController@new');
        Route::get('/opportunities/decline', 'OpportunitiesController@decline');
        Route::get('/datatable/opportunity-new-list', 'OpportunitiesController@opportunities_new_list');


    });




    /**
    * only Teacher
    */
    Route::group(['middleware' => ['role:Teacher']], function () {
        Route::get('/teacher/profile', 'TeachersController@profile');
    });


    Route::group(['middleware' => ['role:Admin|Teacher']], function () {
        
        Route::get('/opportunities/commited-volunteer/{id}', 'OpportunitiesController@commited_volunteer');
        Route::get('/datatable/commited-volunteer-list/{id}', 'OpportunitiesController@commited_volunteer_list');

        Route::resource('opportunities', 'OpportunitiesController');
        Route::get('/datatable/opportunity-list', 'OpportunitiesController@opportunities_list');
        Route::resource('tasks', 'TasksController');
    });

});

