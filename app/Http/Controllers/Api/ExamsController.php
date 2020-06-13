<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamsController extends Controller
{ 
	public function create()
	{
		return response()->json([
            'success' => true,
            'message' => 'create exam'
        ]);
	}
	public function delete()
	{
		# all c
	}
	public function update()
	{
		# all c
	}


	public function examsView()
	{
		# all c
	}
	public function attempt()
	{
		# all c
	}
	public function submit()
	{
		# all c
	}
	public function review()
	{
		# all c
	}
}
