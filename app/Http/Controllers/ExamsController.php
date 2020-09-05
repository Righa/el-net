<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class ExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('exams');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $response = Http::withToken(session('miToken'))->post('http://127.0.0.1:8000/api/exams', [
            'duration' => $request->duration,
            'course_id' => $request->course_id,
            'topic_id' => $request->topic_id,
            'name' => $request->name,
            'password' => $request->password,
        ]);

        $res = $response->json();

        if ($res['success']) {

            $request->session()->flash('success', $res['message']);

            return redirect('exams/'.$res['exam']);

        } else {

            $request->session()->flash('errors', $res['message']);
            
            return redirect('courses/'.$request->course_id);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::withToken(session('miToken'))->get('http://127.0.0.1:8000/api/exams/'.$id);
        $res = $response->json();
        return view('oneexam')->with('exam', $res['exam']);
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
        $response = Http::withToken(session('miToken'))->put('http://127.0.0.1:8000/api/exams/'.$id, [
            'duration' => $request->duration,
            'name' => $request->name,
            'instructions' => $request->instructions,
        ]);

        $res = $response->json();

        if ($res['success']) {

            $request->session()->flash('success', $res['message']);

        } else {

            $request->session()->flash('errors', $res['message']);
        }
            
        return redirect('exams/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::withToken(session('miToken'))->delete('http://127.0.0.1:8000/api/exams/'.$id);

        $res = $response->json();
        
        if ($res['success']) {
            $request->session()->flash('success', $res['message']);
        } else {
            $request->session()->flash('errors', $res['message']);
        }

        return redirect('exams/'.$id);
    }
}
