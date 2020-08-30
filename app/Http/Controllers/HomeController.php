<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::withToken(session('miToken'))->get('http://127.0.0.1:8000/api/midata');
        $res = $response->json();
        return view('home')->with('res', $res);
    }
}



        // in takes->exam->individual profile... settings... assessment
