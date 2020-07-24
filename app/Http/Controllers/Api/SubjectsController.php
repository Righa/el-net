<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Subject;
use DB;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $subjects = Subject::all();
            
        } catch (Exception $e) {
            
            return response([
                'success' => false,
                'message' => 'internal error',
                'errors' => $e
            ]);
        }

        return response([
            'success' => true,
            'subjects' => $subjects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|unique:subjects',
            'description' => 'required|min:11',
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false, 
                'message' => 'input errors encountered',
                'errors'=> $validator->errors()
            ]);
        }

        try {

            $subject = new Subject;

            $subject->name = $request->name;
            $subject->description = $request->description;

            $subject->save();
            
        } catch (Exception $e) {
            
            return response([
                'success' => false,
                'message' => 'internal error',
                'errors' => $e
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'subject was created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        try {

            $subject = Subject::find($id);
            $subject->courses;
            
        } catch (Exception $e) {
            
            return response([
                'success' => false,
                'message' => 'internal error',
                'errors' => $e
            ]);
        }

        return response()->json([
            'success' => true,
            'subject' => $subject
        ]);
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

        $validator = Validator::make($request->all(), [
            'name' => 'min:2|unique:subjects',
            'description' => 'min:11',
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false, 
                'message' => 'input errors encountered',
                'errors'=> $validator->errors()
            ]);
        }

        try {

            $subject = Subject::find($id);

            $changes = 2;
            
            ($request->name) ? $subject->name = $request->name : $changes--;
            ($request->description) ? $subject->description = $request->description : $changes--;
            
        } catch (Exception $e) {
            
            return response([
                'success' => false,
                'message' => 'internal error',
                'errors' => $e
            ]);
            
        }

        return response([
            'success' => true,
            'message' => $changes.' changes have been saved'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            
            $subject = Subject::find($id);

            $courses = $subject->courses;

            foreach ($courses as $course) {
                Storage::delete($course->avatar_url);

                $material = $course->material;

                foreach ($material as $material) {
                    Storage::delete($material->source);
                }
            }

            $subject->delete();

        } catch (Exception $e) {
            
            return response([
                'success' => false,
                'message' => 'internal error',
                'errors' => $e
            ]);
            
        }

        return response()->json([
            'success' => true,
            'message' => 'subject and all its contents were deleted'
        ]);
    }
}
