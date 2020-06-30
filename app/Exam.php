<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
use App\ExamQuestion;
use App\Take;

class Exam extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];


    /**
     * Relationship.
     *
     * @return related course
     */
    public function course()
    {
    	return $this->belongsTo(Course::class);
    }


    /**
     * Relationship.
     *
     * @return all questions in this exam
     */
    public function exam_questions()
    {
    	return $this->hasMany(ExamQuestion::class);
    }


    /**
     * Relationship.
     *
     * @todo inner join with user->takes if needed
     *
     * @return all attempts in this exam
     */
    public function takes()
    {
    	return $this->hasMany(Take::class);
    }
}
