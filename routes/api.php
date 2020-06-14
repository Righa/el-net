<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Route::middleware('auth:api')->get('/user', function (Request $request) {
 *    return $request->user();
 * });
 */

Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');
Route::get('logout', 'Api\AuthController@logout');


Route::post('course', 'Api\CoursesController@create')->middleware('jwtAuth');
Route::post('exam', 'Api\ExamsController@create')->middleware('jwtAuth');
Route::post('forum', 'Api\ForumsController@create')->middleware('jwtAuth');
Route::post('subject', 'Api\SubjectsController@create')->middleware('jwtAuth');



Route::get('courses', 'Api\CoursesController@index')->middleware('jwtAuth');
Route::post('newcourse', 'Api\CoursesController@store')->middleware('jwtAuth');
Route::post('editcourse/{id}', 'Api\CoursesController@update')->middleware('jwtAuth');
Route::get('onecourse/{id}', 'Api\CoursesController@show')->middleware('jwtAuth');
Route::get('deletecourse/{id}', 'Api\CoursesController@destroy')->middleware('jwtAuth');


Route::get('exams', 'Api\ExamsController@index')->middleware('jwtAuth');
Route::post('newexam', 'Api\ExamsController@store')->middleware('jwtAuth');
Route::post('editexam/{id}', 'Api\ExamsController@update')->middleware('jwtAuth');
Route::get('oneexam/{id}', 'Api\ExamsController@show')->middleware('jwtAuth');
Route::get('deleteexam/{id}', 'Api\ExamsController@destroy')->middleware('jwtAuth');


Route::get('forums', 'Api\ForumsController@index')->middleware('jwtAuth');
Route::post('newforum', 'Api\ForumsController@store')->middleware('jwtAuth');
Route::post('editforum/{id}', 'Api\ForumsController@update')->middleware('jwtAuth');
Route::get('oneforum/{id}', 'Api\ForumsController@show')->middleware('jwtAuth');
Route::get('deleteforum/{id}', 'Api\ForumsController@destroy')->middleware('jwtAuth');
Route::post('answerforum/{id}', 'Api\ForumsController@answer')->middleware('jwtAuth');


Route::get('subjects', 'Api\SubjectsController@index')->middleware('jwtAuth');
Route::post('newsubject', 'Api\SubjectsController@store')->middleware('jwtAuth');
Route::post('editsubject/{id}', 'Api\SubjectsController@update')->middleware('jwtAuth');
Route::get('onesubject/{id}', 'Api\SubjectsController@show')->middleware('jwtAuth');
Route::get('deletesubject/{id}', 'Api\SubjectsController@destroy')->middleware('jwtAuth');
