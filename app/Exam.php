<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
use App\ExamQuestion;
use App\Take;

class Exam extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id', 'name', 'takes_allowed', 'duration', 'open', 'close'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function course()
    {
    	return $this->belongsTo(Course::class);
    }
    public function exam_questions()
    {
    	return $this->hasMany(ExamQuestion::class);
    }
    public function takes()
    {
    	return $this->hasMany(Take::class);
    }
}
