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
        try {

            $taken = DB::table('takes')->where(['user_id', Auth::id()],['exam_id', $request->exam_id])->count();
            $exam = Exam::find($request->exam_id);
            
            if ($taken == $exam->takes_allowed) {
                return response([
                    'success' => false,
                    'message' => 'No more takes allowed'
                ]);
            }
            
            $take = new Take;

            $take->user_id = $request->user_id;
            $take->exam_id = $request->exam_id;

            $take->save();

        } catch (Exception $e) {
            
            return response([
                'success' => false,
                'message' => 'Internal error',
                'errors' => $e
            ]);
            
        }

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
        try {

            $take = Take::find($id);
            $exam = $take->exam;
            $answers = $take->answers;

            $total = 0;

            foreach ($answers as $answer) {
                $total = $total + $answer->marks;
            }

            $questions = $exam->exam_questions;
            
        } catch (Exception $e) {
            
            return response([
                'success' => false,
                'message' => 'Internal error',
                'errors' => $e
            ]);
            
        }

        return response()->json([
            'success' => true,
            'take' => $take,
            'marks' => $total
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

            $take = Take::find($id);

            $take->delete();
            
        } catch (Exception $e) {
            
            return response([
                'success' => false,
                'message' => 'Internal error',
                'errors' => $e
            ]);
            
        }

        return response()->json([
            'success' => true,
            'message' => 'The take was deleted successfully'
        ]);
    }
}
