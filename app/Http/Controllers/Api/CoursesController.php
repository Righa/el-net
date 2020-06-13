<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
	public function create()
	{
		return response()->json([
            'success' => true,
            'message' => 'create course'
        ]);
	}
	public function delete()
	{
		# all c
	}
	public function addTopic()
	{
		# all c
	}
	public function removeTopic()
	{
		# all c
	}
	public function addMaterial()
	{
		# all c
	}
	public function removeMaterial()
	{
		# all c
	}



	public function myCourses()
	{
		# all c
	}
	public function courseView()
	{
		# all c
	}
	public function register()
	{
		# all c
	}
	public function leave()
	{
		# all c
	}
}
