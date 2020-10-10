<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Material;

class MaterialController extends Controller
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
    public function create(Request $request)
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
        $material = fopen($request->attachment, 'r');
        $response = Http::attach('material', $material)->withToken(session('miToken'))->post('http://127.0.0.1:8000/api/material', [
            'topic_id' => $request->topic_id,
            'course_id' => $request->course_id,
            'name' => $request->name,
        ]);

        $res = $response->json();

        if ($res['success']) {

            $request->session()->flash('success', $res['message']);

        } else {

            $request->session()->flash('errors', $res['message']);
        }

        return redirect('courses/'.$request->course_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        $file = Material::find($id);
        return Storage::download($file->source, $file->name.'.'.$file->type);
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

        if ($request->hasfile('newattachment')) {

            /*
            $response = Http::withToken(session('miToken'))->patch('http://127.0.0.1:8000/api/material/'.$id, [
                'name' => $request->newname,
            ]);*/
            $material = fopen($request->newattachment, 'r');

            $response = Http::attach('material', $material)->withToken(session('miToken'))->put('http://127.0.0.1:8000/api/material/'.$id, [
                'name' => $request->newname,
            ]);

        } else {

            $response = Http::withToken(session('miToken'))->patch('http://127.0.0.1:8000/api/material/'.$id, [
                'name' => $request->newname,
            ]);
        }

        $res = $response->json();

        if ($res['success']) {

            $request->session()->flash('success', $res['message']);

        } else {

            $request->session()->flash('errors', $res['message']);
        }

        return redirect('courses/'.$request->course_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        
        $response = Http::withToken(session('miToken'))->delete('http://127.0.0.1:8000/api/material/'.$id);

        $res = $response->json();

        if ($res['success']) {
            session()->flash('success', $res['message']);

        } else {
            session()->flash('errors', $res['message']);
        }
        return redirect('courses/'.$request->course_id);
    }
}
