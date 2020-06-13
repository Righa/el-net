<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Course;

class RegisteredCourse extends Model
{
    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function course()
    {
    	return $this->belongsTo(Course::class);
    }
}
