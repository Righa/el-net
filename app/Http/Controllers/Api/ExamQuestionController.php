<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\ExamQuestion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ExamQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //invalid
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
            'number' => 'required',
            'question' => 'required|max:666',
            'choice1' => 'required|max:444',
            'choice2' => 'required|max:444',
            'choice3' => 'required|max:444',
            'choice4' => 'required|max:444',
            'marks' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false,
                'message' => 'input errors',
                'errors'=> $validator->errors()
            ]);
        }
        try {

        	$question = new ExamQuestion;

            if ($request->hasfile('attachment')) {
                $path = $request->attachment->store('public/material_repo');
                $question->attachment = $path;
            }

        	$question->exam_id = $request->exam_id;
        	$question->number = $request->number;
        	$question->question = $request->question;
        	$question->choice1 = $request->choice1;
        	$question->choice2 = $request->choice2;
        	$question->choice3 = $request->choice3;
        	$question->choice4 = $request->choice4;
        	$question->correct = $request->correct;
            $question->marks = $request->marks;

        	$question->save();
        	
        } catch (Exception $e) {
            return response([
                'success' => false, 
                'message' => 'internal errors',
                'errors'=> $e
            ]);
        	
        }

        return response([
            'success' => true,
            'message' => 'Question has been added'
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
        //invalid
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
            'question' => 'max:666',
            'choice1' => 'max:444',
            'choice2' => 'max:444',
            'choice3' => 'max:444',
            'choice4' => 'max:444',
            'marks' => 'integer'
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false,
                'message' => 'input errors',
                'errors'=> $validator->errors()
            ]);
        }
        try {

            $question = ExamQuestion::find($id);

            $changes = 7;

            ($request->number) ? $question->number = $request->number : $changes--;
            ($request->question) ? $question->question = $request->question : $changes--;
            ($request->choice1) ? $question->choice1 = $request->choice1 : $changes--;
            ($request->choice2) ? $question->choice2 = $request->choice2 : $changes--;
            ($request->choice3) ? $question->choice3 = $request->choice3 : $changes--;
            ($request->choice4) ? $question->choice4 = $request->choice4 : $changes--;
            ($request->marks) ? $question->marks = $request->marks : $changes--;

            $question->save();
            
        } catch (Exception $e) {
            return response([
                'success' => false, 
                'message' => 'internal errors',
                'errors'=> $e
            ]);
            
        }

        return response([
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
        ExamQuestion::find($id)->delete();

        return response([
            'success' => true,
            'message' => 'Question has been deleted'
        ]);

    }
}
