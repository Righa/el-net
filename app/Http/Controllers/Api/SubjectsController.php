<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
	public function create()
	{
		return response()->json([
            'success' => true,
            'message' => 'create subject'
        ]);
	}
	public function update()
	{
		# all c
	}
	public function delete()
	{
		# all c
	}


	public function show()
	{
		# all c
	}
}
