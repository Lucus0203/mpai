<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::auth();

// Authentication Routes...
Route::get('login', 'Admin\AuthController@getLogin');
Route::post('login', 'Admin\AuthController@postLogin');
Route::get('logout', 'Admin\AuthController@getLogout');

Route::group(['middleware'=>['auth']],function(){
    Route::get('/', 'HomeController@index');
    Route::get('/auth/changepass','Admin\ChangepassController@index');
    Route::post('/auth/changepass','Admin\ChangepassController@changepass');
    Route::get('/company/list', 'CompanyController@index');
    Route::get('/company/failusers', 'CompanyController@failusers');
    Route::get('/course', 'CourseController@index');
    Route::get('/teacher', 'TeacherController@index');
    Route::get('/student', 'StudentController@index');
});
