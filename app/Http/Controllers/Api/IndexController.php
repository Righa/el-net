<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Course;
use App\RegisteredCourse;
use App\User;
use App\Forum;
use App\Material;
use App\Subject;
use App\Exam;

class IndexController extends Controller
{
    public function index()
    {
    	$user = Auth::user();
        $courses = Course::all();
        $forums = Forum::all();

	        $myCourses = $user->registered_courses;

	        foreach ($myCourses as $reg) {
	        	$reg->course;
	            $reg->course->user;
	            $reg->course->user->avatar_url = Storage::url($reg->course->user->avatar_url);
	            $reg->course->avatar_url = Storage::url($reg->course->avatar_url);
	        }

        //more data for courses

        foreach ($courses as $course) {
            $course->user;
            $course->user->avatar_url = Storage::url($course->user->avatar_url);
            $course->avatar_url = Storage::url($course->avatar_url);
        }

        //more data for forums

        foreach ($forums as $forum) {
            $forum->user;
            $forum->forum_answers;
            $forum->user->avatar_url = Storage::url($forum->user->avatar_url);
        }

        return response()->json([
            'success' => true,
            'courses' => $courses,
            'myCourses' => $myCourses,
            'forums' => $forums
        ]);
    }

    //searches
}
