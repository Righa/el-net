<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            
            if ($taken > 0) {
                return response([
                    'success' => false,
                    'message' => 'No more attempts allowed'
                ]);
            }

            if ($request->password != $exam->password) {
                return response([
                    'success' => false, 
                    'message'=> 'The password is incorrect'
                ]);
            }
            
            $take = new Take;

            $take->user_id = Auth::id();
            $take->exam_id = $request->exam_id;

            $take->save();

        } catch (Exception $e) {
            
            return response([
                'success' => false,
                'message' => 'internal errors',
                'errors' => $e
            ]);
            
        }

        return response()->json([
            'success' => true,
            'message' => 'Exam registered successfully'
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
            $take->answers;

            $total = 0;

            foreach ($take->answers as $answer) {
                $answer->exam_question;
                $total = $total + $answer->marks;
            }
            
        } catch (Exception $e) {
            
            return response([
                'success' => false,
                'message' => 'internal errors',
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
