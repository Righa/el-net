<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\ForumAnswer;
use App\Vote;
use DB;

class VotesController extends Controller
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
        try {

            $duplicate = DB::table('votes')->where(['user_id' => Auth::id(), 'forum_answer_id' => $request->forum_answer_id])->get();

            if (count($duplicate) != 0) {
                return response([
                    'success' => false,
                    'message' => 'you have already voted',
                    'dup' => $duplicate
                ]);
            }

            $vote = new Vote;

            $vote->user_id = Auth::id();
            $vote->forum_answer_id = $request->forum_answer_id;
            $vote->value = $request->value;

            $vote->save();

            //register with forum

            $answer = ForumAnswer::find($request->forum_answer_id);

            $answer->total_votes = $answer->total_votes + $request->value;

            $answer->save();

        } catch (Exception $e) {
            
            return response([
                'success' => false,
                'message' => 'internal errors',
                'errors' => $e
            ]);

        }

        return response([
            'success' => true,
            'message' => 'vote has been saved'
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
