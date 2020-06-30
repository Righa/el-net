<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\ForumAnswer;

class Forum extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];


    /**
     * Relationship.
     *
     * @return student who opened it
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }


    /**
     * Relationship.
     *
     * @return answers to this forum
     */
    public function forum_answers()
    {
    	return $this->hasMany(ForumAnswer::class);
    }
}
