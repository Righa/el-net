<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Course;
use App\User;
use Exception;
use DB;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();

        foreach ($courses as $course) {
            $course->teacher;
        }

        return response()->json([
            'success' => true,
            'courses' => $courses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => 'required',
            'teacher_id' => 'required',
            'name' => 'required|unique:courses',
            'description' => 'required',
            'password' => 'required|min:5',
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false, 
                'message' => 'input errors encountered',
                'errors'=> $validator->errors()
            ]);
        }

        try {

            $course = new Course;

            if ($request->hasfile('avatar')) {
                $path = $r->avatar->store('public/course_avatars');
                $course->avatar_url = $path;
            }

            $course->subject_id = $request->subject_id;
            $course->teacher_id = $request->teacher_id;
            $course->name = $request->name;
            $course->description = $request->description;
            $course->password = $request->password;

            $course->save();
            
        } catch (Exception $e) {
            return response([
                'success' => false, 
                'errors'=> $e
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Course has been created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        $course->teacher;
        $topics = $course->topics;

        foreach ($topics as $topic) {
            $topic->material;
        }

        return response()->json([
            'success' => true,
            'courses' => $course
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'min:5|unique:courses',
            'description' => 'min:5',
            'password' => 'min:5',
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false, 
                'errors'=> $validator->errors()
            ]);
        }

        $course = Course::find($id);

        $changes = 4;

        try {

            if ($request->hasfile('avatar')) {
                Storage::delete($course->avatar_url);
                $path = $r->avatar->store('public/course_avatars');
                $course->avatar_url = $path;
            } else {
                $changes--;
            }
            
            ($request->name) ? $course->name = $request->name : $changes--;
            ($request->description) ? $course->description = $request->description : $changes--;
            ($request->password) ? $course->password = $request->password : $changes--;

        } catch (Exception $e) {
            return response([
                'success' => false, 
                'errors'=> $e
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => $changes.' changes have been saved'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);

        foreach ($course->material as $material) {
            Storage::delete($material->source);
        }

        $course->delete();

        return response()->json([
            'success' => true,
            'message' => 'Course has been deleted'
        ]);
    }
}
