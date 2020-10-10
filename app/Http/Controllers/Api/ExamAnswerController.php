<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\ExamAnswer;
use App\Exam;
use DB;

class ExamAnswerController extends Controller
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
        try {
                
            $exam = Exam::find($request->exam_id);
            $exam->exam_questions;


            foreach ($exam->exam_questions as $q) {

                $answer = new ExamAnswer;
                $answer->take_id = $request->take_id;
                $answer->exam_question_id = $q->id;
                    
                $qid = $q->id;

                if ($request->$qid) {
                    
                    $answer->choice = $request->$qid;

                    if ($request->$qid == $q->correct) {
                        $answer->marks = $q->marks;
                    } else {
                        $answer->marks = 0;
                    }

                } else {

                    $answer->choice = 'none';
                    $answer->marks = 0;
                }

                $answer->save();

            }

        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'internal errors'
            ]);
            
        }

        return response()->json([
            'success' => true,
            'message' => 'Exam has been submitted'
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
        //
    }
}
