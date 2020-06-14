<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Forum;
use App\ForumAnswer;
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

        return response()->json($forums);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return response()->json([
            'success' => true,
            'message' => 'open forum'
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
        $forum->votes = $request->votes;

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
        $answers = ForumAnswer::all();

        return response()->json([
            'forum' => $forum,
            'answers' => $answers
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $forum = Forum::find($id);

        $forum->student_id = $request->student_id;
        $forum->subject_id = $request->subject_id;
        $forum->question = $request->question;
        $forum->votes = $request->votes;

        $forum->save();

        return response()->json([
            'success' => true,
            'message' => 'forum was updated'
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







	public function close()
	{
		# all c
	}


    /**
     * Add forum answer. might need a separate controller for functions in this section
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

	public function answer(Request $request, $id)
	{
        $answer = new ForumAnswer;

        $answer->user_id = $request->user_id;
        $answer->forum_id = $id;
        $answer->answer = $request->answer;

        $answer->save();

        return response()->json([
            'success' => true,
            'message' => 'forum was answered'
        ]);
	}
	public function vote()
	{
		# all c
	}
}
