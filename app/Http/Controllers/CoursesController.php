<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::withToken(session('miToken'))->get('http://127.0.0.1:8000/api/courses');
        $res = $response->json();
        return view('explore')->with('data', $res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::withToken(session('miToken'))->get('http://127.0.0.1:8000/api/subjects');
        $res = $response->json();
        return view('newcourse')->with('res', $res);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->hasFile('avatar')) {

            $photo = fopen($request->avatar, 'r');
            $response = Http::attach('avatar', $photo)->withToken(session('miToken'))->post('http://127.0.0.1:8000/api/courses', [
                'name' => $request->name,
                'subject_id' => $request->subject_id,
                'description' => $request->description,
                'password' => $request->password
            ]);

        } else {

            $response = Http::withToken(session('miToken'))->post('http://127.0.0.1:8000/api/courses', [
                'name' => $request->name,
                'subject_id' => $request->subject_id,
                'description' => $request->description,
                'password' => $request->password
            ]);
        }
        $res = $response->json();
        
        if ($res['success']) {
            $request->session()->flash('success', $res['message']);
            return redirect('home');
        } else {
            $request->session()->flash('errors', $res['message']);
            return view('newcourse');
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
        $response = Http::withToken(session('miToken'))->get('http://127.0.0.1:8000/api/courses/'.$id);
        $res = $response->json();
        return view('onecourse')->with('data', $res);
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
        $response = Http::withToken(session('miToken'))->delete('http://127.0.0.1:8000/api/courses/'.$id);

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
