<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Material;
use App\Exam;

class MaterialController extends Controller
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

            $material = new Material;

            if ($request->hasfile('material')) {
                $path = $request->material->store('public/material_repo');
                $material->source = $path;
                $material->type = $request->material->extension();
            } else {
                $material->source = $request->source;
                $material->type = 'exam';
            }

            $material->course_id = $request->course_id;
            $material->name = $request->name;
            $material->topic_id = $request->topic_id;

            $material->save();

        } catch (Exception $e) {
            return response([
                'success' => false,
                'message' => 'internal error',
                'errors' => $e
            ]);
        }
        return response([
            'success' => true,
            'message' => 'material added successfully'
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

            $material = Material::find($id);

            $changes = 2;

            if ($request->hasfile('material')) {
                Storage::delete($material->source);
                $path = $request->material->store('public/material_repo');
                $material->source = $path;
                $material->type = $request->material->extension();

            } else {
                $changes--;
            }
            
            ($request->name) ? $material->name = $request->name : $changes--;

            $material->save();
            
        } catch (Exception $e) {
            
            return response([
                'success' => false,
                'message' => 'internal errors',
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

            $material = Material::find($id);

            if ($material->type == 'exam') {
                Exam::find($material->source)->delete();
            }

            Storage::delete($material->source);

            $material->delete();
            
        } catch (Exception $e) {
            
            return response([
                'success' => false,
                'message' => 'internal errors',
                'errors' => $e
            ]);
            
        }

        return response([
            'success' => true,
            'message' => 'material deleted successfully'
        ]);
    }
}
