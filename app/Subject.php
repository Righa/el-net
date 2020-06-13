<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Forum;
use App\Course;

class Subject extends Model
{
    public function course()
    {
    	return $this->hasMany(Course::class);
    }
    public function forum()
    {
    	return $this->hasMany(Forum::class);
    }
}
