<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exam;

class ExamQuestion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'exam_id', 'number', 'question', 'choice1', 'choice2', 'choice3', 'choice4'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'correct'
    ];


    public function exam()
    {
    	return $this->belongsTo(Exams::class);
    }
}
