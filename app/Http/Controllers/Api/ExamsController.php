<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $exams = Exam::all();

        return response()->json($exams);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exam = new Exam;
        $exam->course_id = $request->course_id;
        $exam->name = $request->name;
        $exam->takes_allowed = $request->takes_allowed;
        $exam->duration = $request->duration;
        $exam->password = $request->password;
        $exam->open = $request->open;
        $exam->close = $request->close;

        $exam->save();

        return response()->json([
            'success' => true,
            'message' => 'exam was created'
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
        $questions = $exam->exam_questions;

        return response()->json($exam);
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

        return response()->json([
            'success' => true,
            'message' => $affected.' exam was updated'
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
}
