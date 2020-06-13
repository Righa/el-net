<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Exam;

class Take extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function exam()
    {
    	return $this->belongsTo(Exam::class);
    }
}
