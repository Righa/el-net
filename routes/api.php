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


# auth routes

Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');
//Route::post('reauth', 'Api\AuthController@refresh');


	
# authenticated group

Route::group(['middleware' => 'jwtAuth'], function() {

	/**
	 * Edit profile
	 * 
	 * logout
	 */Route::get('midata', 'Api\IndexController@index');

	Route::post('profile', 'Api\AuthController@profile');
	Route::get('logout', 'Api\AuthController@logout');
	Route::get('check_auth', 'Api\AuthController@checkAuth');

	# standard routes group

	Route::apiResources([
		'votes' => 'Api\VotesController',
		'takes' => 'Api\TakesController',
		'exams' => 'Api\ExamsController',
		'topics' => 'Api\TopicsController',
		'forums' => 'Api\ForumsController',
		'courses' => 'Api\CoursesController',
		'subjects' => 'Api\SubjectsController',
		'material' => 'Api\MaterialController',
		//'reviews' => 'Api\ExamAnswerController',
		//'questions' => 'Api\QuestionsController',
		'enrollment' => 'Api\EnrollmentController',
		'contributions' => 'Api\ForumAnswersController',
	]);
});
