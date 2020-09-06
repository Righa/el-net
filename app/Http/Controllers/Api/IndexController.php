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
use DB;

class IndexController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $users = User::all();
        $subjects = Subject::all();
        $courses = Course::all();
        $forums = Forum::all();
        $exams = Exam::all();
        $activity = new UserActivity;

	        $myCourses = $user->registered_courses;

	        foreach ($myCourses as $reg) {
	        	$reg->course;
	            $reg->course->user;

                if ($reg->course->user->avatar_url != null) {
                    $reg->course->user->avatar_url = Storage::url($reg->course->user->avatar_url);
                }
                if ($reg->course->avatar_url != null) {
                    $reg->course->avatar_url = Storage::url($reg->course->avatar_url);
                }
	        }

        //more data for courses

        foreach ($courses as $course) {
            $course->user;

            if ($course->user->avatar_url != null) {
                $course->user->avatar_url = Storage::url($course->user->avatar_url);
            }
            if ($course->avatar_url != null) {
                $course->avatar_url = Storage::url($course->avatar_url);
            }
        }

        //more data for forums

        foreach ($forums as $forum) {
            $forum->user;
            $forum->forum_answers;
            if ($forum->user->avatar_url != null) {
                $forum->user->avatar_url = Storage::url($forum->user->avatar_url);
            }
        }

        if (Auth::user()->role == 'teacher') {
            $activity->online = DB::table('activities')->where('active', true)->count();
        }

        return response()->json([
            'success' => true,
            'courses' => $courses,
            'subjects' => $subjects,
            'myCourses' => $myCourses,
            'forums' => $forums,
            'users' => $users,
            'exams' => $exams,
            'activity' => $activity
        ]);
    }

    //searches
}


/**
 * 
 */
class UserActivity
{

    function __construct()
    {
        $this->online = 0;
        $this->foo = '';
    }
}
