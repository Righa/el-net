<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Forum;
use DB;

class ForumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forums = Forum::all();

        return response()->json([
            'success' => true,
            'courses' => $forums
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
        $forum = new Forum;

        $forum->student_id = $request->student_id;
        $forum->subject_id = $request->subject_id;
        $forum->question = $request->question;

        $forum->save();

        return response()->json([
            'success' => true,
            'message' => 'forum was created'
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
        $forum = Forum::find($id);
        $answers = $forum->forum_answers;

        return response()->json([
            'success' => true,
            'courses' => $forum
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
        $affected = DB::table('forums')->where('id', $id)->update([
            'student_id' => $request->student_id, 
            'subject_id' => $request->subject_id, 
            'question' => $request->question
        ]);

        return response()->json([
            'success' => true,
            'message' => $affected.' forum was updated'
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
        DB::table('forums')->where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'forum was deleted'
        ]);
    }
}
