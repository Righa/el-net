<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\ForumAnswer;

class Forum extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function forum_answer()
    {
    	return $this->hasMany(ForumAnswer::class);
    }
}
