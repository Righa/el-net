<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class EnrollmentController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //handled
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::withToken(session('miToken'))->post('http://127.0.0.1:8000/api/enrollment', [
            'course_id' => $request->course_id,
            'password' => $request->password
        ]);

        $res = $response->json();

        if ($res['success']) {

            $request->session()->flash('success', $res['message']);
            return redirect('courses/'.$request->course_id);

        } else {

            $request->session()->flash('errors', $res['message']);
            return redirect('home');
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
        //invalid
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //invalid
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::withToken(session('miToken'))->delete('http://127.0.0.1:8000/api/enrollment/'.$id);

        $res = $response->json();

        if ($res['success']) {

            session()->flash('success', $res['message']);
            return redirect('home');

        } else {
            session()->flash('errors', $res['message']);
            return redirect('courses/'.$id);
        }
    }
}
