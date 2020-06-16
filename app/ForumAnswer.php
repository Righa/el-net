<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Forum;

class ForumAnswer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'forum_id', 'answer'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function forum()
    {
    	return $this->belongsTo(Forum::class);
    }
}
