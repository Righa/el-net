<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Courses extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$response = Http::get('http://127.0.0.1:8000/api/courses');
        //$res = $response->json();
        return view('explore');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get('http://127.0.0.1:8000/api/courses');
        $res = $response->json();
        return view('demo')->with('res', $res);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $response = Http::get('http://127.0.0.1:8000/api/courses');
        $res = $response->json();
        return view('demo')->with('res', $res);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get('http://127.0.0.1:8000/api/courses');
        $res = $response->json();
        return view('demo')->with('res', $res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get('http://127.0.0.1:8000/api/courses');
        $res = $response->json();
        return view('demo')->with('res', $res);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        $response = Http::get('http://127.0.0.1:8000/api/courses');
        $res = $response->json();
        return view('demo')->with('res', $res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::get('http://127.0.0.1:8000/api/courses');
        $res = $response->json();
        return view('demo')->with('res', $res);
    }
}
