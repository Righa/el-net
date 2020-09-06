<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/admin', function () {
    return view('admin');
});

//api demo

Route::get('demo', 'Demo@index');

Route::get('login', 'AuthController@signIn');
Route::get('register', 'AuthController@signUp');
Route::get('profile', 'AuthController@editProfile');

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::get('logout', 'AuthController@logout');
Route::post('profile', 'AuthController@profile');

Route::group(['middleware' => 'miAuth'], function() {

	Route::resources([
		'home' => 'HomeController',
		'exams' => 'ExamsController',
		'forums' => 'ForumsController',
		'courses' => 'CoursesController',
		'materials' => 'MaterialController',
		'enrollment' => 'EnrollmentController',
		'exam_answers' => 'ExamAnswersController',
		'exam_questions' => 'ExamQuestionController',
		'forum_answers' => 'ForumAnswerController',
		'subjects' => 'SubjectsController',
		'topics' => 'TopicsController',
		'votes' => 'VotesController',
		'takes' => 'TakesController',
		'user' => 'UsersController',
	]);
});

//new course, new forum, new material, new exam, 
//enroll, forum answer, vote forum, new topic, unenroll
