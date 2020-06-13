<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForumsController extends Controller
{
	public function open()
	{
		return response()->json([
            'success' => true,
            'message' => 'open forum'
        ]);
	}
	public function close()
	{
		# all c
	}
	public function delete()
	{
		# all c
	}
	public function update()
	{
		# all c
	}


	public function answer()
	{
		# all c
	}
	public function vote()
	{
		# all c
	}
}
