<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

            $duplicate = DB::table('votes')->where(['user_id', Auth::id()], ['forum_answer_id', $request->forum_answer_id])->get();

            if (!is_null($duplicate)) {
                return response([
                    'success' => false,
                    'message' => 'you have already voted'
                ]);
            }

            $vote = new Vote;

            $vote->user_id = Auth::id();
            $vote->forum_answer_id = $request->forum_answer_id;
            $vote->value = $request->value;

            $vote->save();

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
