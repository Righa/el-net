<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Forum;

class ForumAnswer extends Model
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
     * @return user who ansswered
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }


    /**
     * Relationship.
     *
     * @return question being answered
     */
    public function forum()
    {
    	return $this->belongsTo(Forum::class);
    }



    /**
     * Relationship.
     *
     * @return all votes for this answer
     */
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
