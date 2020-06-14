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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return response()->json([
            'success' => true,
            'message' => 'create course'
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

        return response()->json($course);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $course = Course::find($id);

        $course->subject_id = $request->subject_id;
        $course->teacher_id = $request->teacher_id;
        $course->name = $request->name;
        $course->description = $request->description;
        $course->password = $request->password;

        $course->save();

        return response()->json([
            'success' => true,
            'message' => 'Course has been updated'
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







   
	public function addTopic()
	{
		# all c
	}
	public function removeTopic()
	{
		# all c
	}
	public function addMaterial()
	{
		# all c
	}
	public function removeMaterial()
	{
		# all c
	}



	public function myCourses()
	{
		# all c
	}
	public function courseView()
	{
		# all c
	}
	public function register()
	{
		# all c
	}
	public function leave()
	{
		# all c
	}
}
