<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
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

        foreach ($forums as $forum) {
            $user = $forum->user;
            $forum->forum_answers;
            $forum->subject;
        }

        return response()->json([
            'success' => true,
            'forums' => $forums
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
            'question' => 'required|min:11'
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false,
                'message' => 'input errors',
                'errors' => $validator->errors()
            ]);
        }
        
        try {

            $forum = new Forum;

            $forum->user_id = Auth::id();
            $forum->subject_id = $request->subject_id;
            $forum->question = $request->question;

            $forum->save();
            
        } catch (Exception $e) {
            return response([
                'success' => false,
                'message' => 'internal errors',
                'errors' => $e
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'forum was created',
            'forum' => $forum->id
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
        $forum->subject;
        $forum->user;
        if ($forum->user->avatar_url != null) {
            $forum->user->avatar_url = Storage::url($forum->user->avatar_url);
        }
        
        $answers = $forum->forum_answers;

        foreach ($answers as $answer) {
            $answer->user;
            $answer->votes;

            $total = 0;

            foreach ($answer->votes as $vote) {
                $total = $total + $vote->value;
            }

            $answer->total_votes = $total;

            if ($answer->user->avatar_url != null) {
                $answer->user->avatar_url = Storage::url($answer->user->avatar_url);
            }
            
        }

        return response()->json([
            'success' => true,
            'forum' => $forum
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
            'question' => 'required|min:11'
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false,
                'message' => 'input errors',
                'errors' => $validator->errors()
            ]);
        }
        
        try {
            
            $forum = Forum::find($id);

            $forum->question = $request->question;

            $forum->save();

        } catch (Exception $e) {
            
            return response([
                'success' => false,
                'message' => 'internal errors',
                'errors' => $e
            ]);
        }

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






    //new logic here
}
