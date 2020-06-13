<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exam;

class ExamQuestion extends Model
{
    public function exam()
    {
    	return $this->belongsTo(Exams::class);
    }
}
