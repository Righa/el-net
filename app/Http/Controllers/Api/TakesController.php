<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Take;
use App\Exam;
use App\ExamAnswer;
use DB;

class TakesController extends Controller
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
        $take = new Take;

        $take->user_id = $request->user_id;
        $take->exam_id = $request->exam_id;

        $take->save();

        return response()->json([
            'success' => true,
            'message' => 'Exam submitted successfully'
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
        $take = Take::find($id);
        $exam = $take->exam;
        $take->answers;

        $questions = $exam->exam_questions;

        return response()->json([
            'success' => true,
            'take' => $take
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
        DB::table('takes')->where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'The item was deleted successfully'
        ]);
    }
}
