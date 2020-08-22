<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Demo extends Controller
{
    public function index()
    {
    	$response = Http::withToken(session('miToken'))->get('http://127.0.0.1:8000/api/courses');
    	$res = $response->json();
    	return view('demo')->with('res', $res);
    }
}
