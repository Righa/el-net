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

/*
 Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
 });
*/

# auth routes

Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');
Route::get('logout', 'Api\AuthController@logout');


# other routes

//Route::group(['middleware' => 'jwtAuth'], function() {

	Route::post('profile', 'Api\AuthController@profile');

	Route::apiResources([
		'courses' => 'Api\CoursesController',
		'exams' => 'Api\ExamsController',
		'forums' => 'Api\ForumsController',
		'subjects' => 'Api\SubjectsController',
		'enrollment' => 'Api\EnrollmentController',
		'reviews' => 'Api\ExamAnswerController',
		'contributions' => 'Api\ForumAnswersController',
		'material' => 'Api\MaterialController',
		'questions' => 'Api\QuestionsController',
		'takes' => 'Api\TakesController',
		'topics' => 'Api\TopicsController',
		'votes' => 'Api\VotesController',
	]);
//});

/**
 * All Routes grouped
 *
|
|
| ------------------------------------------------------------------------------------
|
| Verb			URI							Action	Route Name
|
| ------------------------------------------------------------------------------------
| ------------------------------------------------------------------------------------
| GET			api/item					index	item.index
| ------------------------------------------------------------------------------------
| GET			api/item/create				create	item.create		---out of service
| ------------------------------------------------------------------------------------
| POST			api/item					store	item.store
| ------------------------------------------------------------------------------------
| GET			api/item/{id}				show	item.show
| ------------------------------------------------------------------------------------
| GET			api/item/{id}/edit			edit	item.edit 		---out of service
| ------------------------------------------------------------------------------------
| PUT/PATCH		api/item/{id}				update	item.update
| ------------------------------------------------------------------------------------
| DELETE		api/item/{id}				destroy	item.destroy
| ------------------------------------------------------------------------------------
|
*/
