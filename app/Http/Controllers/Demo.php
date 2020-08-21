<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Demo extends Controller
{
    public function index()
    {
    	$response = Http::withToken("eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTU5ODAzODIyOSwiZXhwIjoxNTk4MDQxODI5LCJuYmYiOjE1OTgwMzgyMjksImp0aSI6IkJyUkRidDVIVFZ5b2hiTDYiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.gtZMX2edhWc7WJ4c8xqziHB7sGpJofnSIRLW3J160so")->get('http://127.0.0.1:8000/api/courses');
    	$res = $response->json();
    	return view('demo')->with('res', $res);
    }
}
