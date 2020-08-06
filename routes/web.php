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

//api demo

Route::get('/demo', 'Demo@index');

Route::get('/login', 'User@signIn');
Route::get('register', 'User@signUp');
Route::get('profile', 'User@editProfile');

Route::post('login', 'User@login');
Route::post('register', 'User@register');
Route::post('logout', 'User@logout');
Route::post('profile', 'User@profile');

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
