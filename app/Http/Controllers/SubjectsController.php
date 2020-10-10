<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SubjectsController extends Controller
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
        $response = Http::withToken(session('miToken'))->post('http://127.0.0.1:8000/api/subjects', [
            'name' => $request->name,
            'description' => $request->description
        ]);

        $res = $response->json();

        if ($res['success']) {
            session()->flash('success', $res['message']);

        } else {
            session()->flash('errors', $res['message']);
        }

        return redirect('home');
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
        $response = Http::withToken(session('miToken'))->put('http://127.0.0.1:8000/api/subjects/'.$id, [
            'name' => $request->name,
            'description' => $request->description
        ]);

        $res = $response->json();

        if ($res['success']) {
            session()->flash('success', $res['message']);

        } else {
            session()->flash('errors', $res['message']);
        }

        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::withToken(session('miToken'))->delete('http://127.0.0.1:8000/api/subjects/'.$id);

        $res = $response->json();

        if ($res['success']) {
            session()->flash('success', $res['message']);

        } else {
            session()->flash('errors', $res['message']);
        }

        return redirect('home');
    }
}
