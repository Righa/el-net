<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\ExamQuestion;
use App\Exam;
use DB;

class ExamsController extends Controller
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
            'name' => 'required|min:5',
            'takes_allowed' => 'required',
            'duration' => 'required',
            'open' => 'required|date',
            'close' => 'required|date',
            'pasword' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false, 
                'errors'=> $validator->errors()
            ]);
        }

        try {

            $exam = new Exam;
            $exam->course_id = $request->course_id;
            $exam->name = $request->name;
            $exam->takes_allowed = $request->takes_allowed;
            $exam->duration = $request->duration;
            $exam->password = $request->password;
            $exam->open = $request->open;
            $exam->close = $request->close;

            $exam->save();
            
        } catch (Exception $e) {
            return response([
                'success' => false, 
                'errors'=> $e
            ]);            
        }

        return response()->json([
            'success' => true,
            'message' => 'exam has been created'
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
        $exam = Exam::find($id);
        $exam->exam_questions;

        return response()->json([
            'success' => true,
            'exam' => $exam
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
        $affected = DB::table('exams')->where('id', $id)->update([
            'course_id' => $request->course_id,
            'name' => $request->name,
            'takes_allowed' => $request->takes_allowed,
            'duration' => $request->duration,
            'password' => $request->password,
            'open' => $request->open,
            'close' => $request->close
        ]);


        $validator = Validator::make($request->all(), [
            'name' => 'min:5',
            'takes_allowed' => 'integer',
            'duration' => 'integer',
            'password' => 'min:5',
            'open' => 'date',
            'close' => 'date',
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
        DB::table('exams')->where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'exam was deleted'
        ]);
    }





    //new logic here
    
}
