<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Topic;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'name' => 'required|min:2',
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false, 
                'message' => 'input errors encountered',
                'errors'=> $validator->errors()
            ]);
        }

        try {

            $topic = new Topic;

            $topic->course_id = $request->course_id;
            $topic->name = $request->name;

            $topic->save();
            
        } catch (Exception $e) {

            return response([
                'success' => false, 
                'message' => 'internal errors',
                'errors'=> $e
            ]);
            
        }

        return response()->json([
            'success' => true,
            'message' => 'Topic has been added'
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

        $validator = Validator::make($request->all(), [
            'name' => 'min:2',
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false, 
                'message' => 'input errors encountered',
                'errors'=> $validator->errors()
            ]);
        }

        try {

            $topic = Topic::find($id);

            $changes = 1;

            ($request->name) ? $topic->name = $request->name : $changes--;

            $topic->save();
            
        } catch (Exception $e) {

            return response([
                'success' => false, 
                'message' => 'internal errors',
                'errors'=> $e
            ]);
            
        }

        return response()->json([
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

            $topic = Topic::find($id);

            foreach ($topic->material as $material) {
                Storage::delete($material->source);
            }

            $topic->delete();
            
        } catch (Exception $e) {

            return response([
                'success' => false, 
                'message' => 'internal errors',
                'errors'=> $e
            ]);
            
        }

        return response([
            'success' => true,
            'message' => 'Topic and all its contents have been deleted'
        ]);
    }
}
