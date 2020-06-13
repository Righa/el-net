<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
use App\ExamQuestion;
use App\Take;

class Exam extends Model
{
    public function course()
    {
    	return $this->belongsTo(Course::class);
    }
    public function exam_question()
    {
    	return $this->hasMany(ExamQuestion::class);
    }
    public function take()
    {
    	return $this->hasMany(Take::class);
    }
}
