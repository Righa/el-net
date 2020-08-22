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
Route::get('/courses', function () {
    return view('courses');
});
Route::get('/explore', function () {
    return view('explore');
});
Route::get('/assessment', function () {
    return view('assessment');
});
Route::get('/exams', function () {
    return view('exams');
});
Route::get('/forums', function () {
    return view('forums');
});
Route::get('/onecourse', function () {
    return view('onecourse');
});
Route::get('/oneexam', function () {
    return view('oneexam');
});
Route::get('/oneforum', function () {
    return view('oneforum');
});
Route::get('/preferences', function () {
    return view('profile');
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

/*
Route::resources([
	'exams' => 'ExamsController',
	'forums' => 'ForumsController',
	'courses' => 'CoursesController',
	'enrollment' => 'EnrollmentController',
	'exam_answers' => 'ExamAnswersController',
	'forum_answers' => 'ForumAnswersController',
	'materials' => 'MaterialsController',
	'subjects' => 'SubjectsController',
	'takes' => 'TakesController',
	'topics' => 'TopicsController',
	'votes' => 'VotesController',
]);

@todo 	user->upcoming exams
		user->courses
		user->

		*/
