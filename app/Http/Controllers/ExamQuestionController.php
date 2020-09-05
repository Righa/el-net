<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class ExamQuestionController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        if ($request->hasfile('attachment')) {

            $photo = fopen($request->attachment, 'r');
            $response = Http::attach('attachment', $photo)->withToken(session('miToken'))->post('http://127.0.0.1:8000/api/exam_questions', [
                'exam_id' => $request->exam_id,
                'number' => $request->number,
                'question' => $request->question,
                'choice1' => $request->choice1,
                'choice2' => $request->choice2,
                'choice3' => $request->choice3,
                'choice4' => $request->choice4,
                'correct' => $request->correct,
                'marks' => $request->marks,
            ]);

        } else {

            $response = Http::withToken(session('miToken'))->post('http://127.0.0.1:8000/api/exam_questions', [
                'exam_id' => $request->exam_id,
                'number' => $request->number,
                'question' => $request->question,
                'choice1' => $request->choice1,
                'choice2' => $request->choice2,
                'choice3' => $request->choice3,
                'choice4' => $request->choice4,
                'correct' => $request->correct,
                'marks' => $request->marks,
            ]);
        }

        $res = $response->json();
        
        if ($res['success']) {
            $request->session()->flash('success', $res['message']);
        } else {
            $request->session()->flash('errors', $res['message']);
        }

        return redirect('exams/'.$request->exam_id);
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
        $response = Http::withToken(session('miToken'))->put('http://127.0.0.1:8000/api/exam_questions/'.$id, [
            'number' => $request->number,
            'question' => $request->question,
            'choice1' => $request->choice1,
            'choice2' => $request->choice2,
            'choice3' => $request->choice3,
            'choice4' => $request->choice4,
            'marks' => $request->marks,
        ]);

        $res = $response->json();
        
        if ($res['success']) {
            $request->session()->flash('success', $res['message']);
        } else {
            $request->session()->flash('errors', $res['message']);
        }

        return redirect('exams/'.$request->exam_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $response = Http::withToken(session('miToken'))->delete('http://127.0.0.1:8000/api/exam_questions/'.$id);

        $res = $response->json();
        
        if ($res['success']) {
            $request->session()->flash('success', $res['message']);
        } else {
            $request->session()->flash('errors', $res['message']);
        }

        return redirect('exams/'.$request->exam_id);
    }
}
