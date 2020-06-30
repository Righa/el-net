<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Course;

class RegisteredCourse extends Model
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
     * @return enrolled student
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }


    /**
     * Relationship.
     *
     * @return course enrolled in
     */
    public function course()
    {
    	return $this->belongsTo(Course::class);
    }
}
