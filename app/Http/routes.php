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
    Route::get('/company/userlist', 'CompanyController@userlist');
    Route::get('/company/{companyid}/edit','CompanyController@edit');
    Route::put('/company/{companyid}/update','CompanyController@update');
    Route::get('/company/{companyid}/updatenote','CompanyController@updatenote');
    Route::get('/company/exportByIndustry','CompanyController@exportByIndustry');

    Route::get('/course', 'CourseController@index');
    Route::get('/teacher', 'TeacherController@index');
    Route::get('/student', 'StudentController@index');

    Route::get('/company/userlist/log/userlogin/{userid}','LogController@userlogin');
    Route::get('/company/userlist/log/useraction/{userid}','LogController@useraction');

    Route::get('/loginpc/{userid}','LoginpaiController@redirectToPai');
    Route::get('/company/deluser/{userid}','CompanyController@deluser');

    Route::get('/ability/createjob','AbilityJobController@create');
    Route::get('/ability/joblist','AbilityJobController@list');

    Route::resource('ability/model','AbilityModelController',['except' => ['show','destroy']]);
    Route::get('/ability/model/import','AbilityModelController@import');
    Route::post('/ability/model/upload','AbilityModelController@upload');
    Route::get('/ability/model/{id}/destroy','AbilityModelController@destroy');
    Route::get('/ability/model/maxcode/{type}','AbilityModelController@getMaxCode');
    Route::get('/ability/model/getmodelbytype/{type}','AbilityModelController@getModelsByType');
    Route::get('/ability/model/getmodelbyid/{id}','AbilityModelController@getModelById');

    Route::resource('ability/job','AbilityJobController',['except' => ['show','destroy']]);
    Route::get('/ability/job/{id}/destroy','AbilityJobController@destroy');
    Route::get('/ability/job/{id}/publish','AbilityJobController@publish');
    Route::get('/ability/job/{id}/unpublish','AbilityJobController@unpublish');

    Route::get('/ajax/industries/{parent_id}','AjaxController@getIndustriesByParent');

    Route::resource('order','OrderController',['except' => ['show','destroy']]);
    Route::get('/order/{id}/destroy','OrderController@destroy');
    Route::get('/order/{id}/checked','OrderController@checked');
    Route::get('/order/{id}/unchecked','OrderController@unchecked');

    Route::get('/annual/course','AnnualSurveyController@course');
    Route::get('/annual/course/create','AnnualSurveyController@courseCreate');
    Route::post('/annual/course','AnnualSurveyController@courseStore');
    Route::get('/annual/course/import','AnnualSurveyController@courseImport');
    Route::post('/annual/course/upload','AnnualSurveyController@courseUpload');
    Route::get('/annual/course/{id}/edit','AnnualSurveyController@courseEdit');
    Route::patch('/annual/course/{id}','AnnualSurveyController@courseUpdate');
    Route::get('/annual/course/{id}/destroy','AnnualSurveyController@courseDestroy');
    Route::get('/annual/coursetype','AnnualSurveyController@courseType');
    Route::post('/annual/coursetype','AnnualSurveyController@courseTypeStore');
    Route::get('/annual/coursetype/create','AnnualSurveyController@courseTypeCreate');
    Route::get('/annual/coursetype/{id}/edit','AnnualSurveyController@courseTypeEdit');
    Route::patch('/annual/coursetype/{id}','AnnualSurveyController@courseTypeUpdate');
    Route::get('/annual/coursetype/{id}/destroy','AnnualSurveyController@courseTypeDestroy');
    Route::get('/annual/coursetype/{id}/public','AnnualSurveyController@courseTypePublic');
    Route::get('/annual/coursetype/{id}/unpublic','AnnualSurveyController@courseTypeUnpublic');

});
