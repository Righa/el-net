<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\ExamQuestion;
use App\Material;
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
            'duration' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false,
                'message' => 'input errors',
                'errors'=> $validator->errors()
            ]);
        }

        try {

            $exam = new Exam;
            $exam->course_id = $request->course_id;
            $exam->name = $request->name;
            $exam->duration = $request->duration;
            $exam->password = $request->password;

            $exam->save();

            //create material link

            $material = new Material;

            $material->source = $exam->id;
            $material->type = 'exam';
            $material->course_id = $request->course_id;
            $material->name = $exam->name;
            $material->topic_id = $request->topic_id;

            $material->save();

        } catch (Exception $e) {
            return response([
                'success' => false, 
                'message' => 'internal errors',
                'errors'=> $e
            ]);            
        }

        return response()->json([
            'success' => true,
            'message' => 'exam has been created',
            'exam' => $exam->id
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
        $exam->course->user;
        $exam->exam_questions;

        foreach ($exam->exam_questions as $question) {
            if ($question->attachment != null) {
                $question->attachment = Storage::url($question->attachment);
            }
        }

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

        $validator = Validator::make($request->all(), [
            'name' => 'min:2',
            'duration' => 'integer'
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false, 
                'errors'=> $validator->errors()
            ]);
        }

        try {

            $exam = Exam::find($id);

            $changes = 3;
            
            ($request->name) ? $exam->name = $request->name : $changes--;
            ($request->duration) ? $exam->duration = $request->duration : $changes--;
            ($request->instructions) ? $exam->instructions = $request->instructions : $changes--;

        } catch (Exception $e) {
            return response([
                'success' => false, 
                'message' => 'input errors',
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
        Exam::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'exam was deleted'
        ]);
    }

    
}
