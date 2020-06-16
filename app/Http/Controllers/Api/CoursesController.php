<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
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
        return response()->json($courses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course = new Course;
        $course->subject_id = $request->subject_id;
        $course->teacher_id = $request->teacher_id;
        $course->name = $request->name;
        $course->description = $request->description;
        $course->password = $request->password;

        $course->save();

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
        $material = $course->material;

        return response()->json($course);
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
        $affected = DB::table('courses')->where('id', $id)->update([
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
            'name' => $request->name,
            'description' => $request->description,
            'password' => $request->password
        ]);

        return response()->json([
            'success' => true,
            'message' => $affected.' course has been updated'
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
        DB::table('courses')->where('id',$id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Course has been deleted'
        ]);
    }
}
