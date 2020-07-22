<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exam;
use App\ExamAnswer;

class ExamQuestion extends Model
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
        'correct'
    ];


    /**
     * Relationship.
     *
     * @return exam
     */
    public function exam()
    {
        return $this->belongsTo(Exams::class);
    }


    /**
     * Relationship.
     *
     * @return answers
     */
    public function answers()
    {
        return $this->hasMany(ExamAnswer::class);
    }
}
