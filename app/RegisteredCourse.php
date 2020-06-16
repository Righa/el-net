<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Course;

class RegisteredCourse extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'course_id'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function course()
    {
    	return $this->belongsTo(Course::class);
    }
}
