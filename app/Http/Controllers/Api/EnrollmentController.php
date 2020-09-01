<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\RegisteredCourse;
use App\Course;
use App\User;
use DB;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false, 
                'message' => 'input errors',
                'errors'=> $validator->errors()
            ]);
        }

        $enrollment = new RegisteredCourse;

        try {

            $course = Course::find($request->course_id);

            if ($request->password != $course->password) {
                return response([
                    'success' => false, 
                    'message'=> 'The password is incorrect'
                ]);
            }

            $enrollment->user_id = Auth::id();
            $enrollment->course_id = $request->course_id;

            $enrollment->save();
            
        } catch (Exception $e) {
            return response()->json([
                'success' => true,
                'message' => $e
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'student enrolled successfully'
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

        $count = $course->students->count();

        for ($i=0; $i < $count; $i++) { 
            $enrollment[$i] = User::find($course->students[$i]->user_id);
        }

        return response()->json([
            'success' => true,
            'students' => $enrollment
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            DB::table('registered_courses')->where(['course_id' => $id, 'user_id' => Auth::id()])->delete();
            
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Student was unenrolled successfully'
        ]);
    }
}
