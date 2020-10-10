<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ForumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::withToken(session('miToken'))->get('http://127.0.0.1:8000/api/forums');
        $res = $response->json();
        return view('forums')->with('data', $res);
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
        $response = Http::withToken(session('miToken'))->post('http://127.0.0.1:8000/api/forums', [
            'subject_id' => $request->subject,
            'question' => $request->question
        ]);
        $res = $response->json();

        if ($res['success']) {

            $request->session()->flash('success', $res['message']);
            return redirect('forums/'.$res['forum']);

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
        $response = Http::withToken(session('miToken'))->get('http://127.0.0.1:8000/api/forums/'.$id);
        $res = $response->json();
        return view('oneforum')->with('data', $res);
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
        $response = Http::withToken(session('miToken'))->delete('http://127.0.0.1:8000/api/forums/'.$id);

        $res = $response->json();

        if ($res['success']) {
            session()->flash('success', $res['message']);

        } else {
            session()->flash('errors', $res['message']);
        }
        return redirect('home');
    }
}
