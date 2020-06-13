<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;

class Material extends Model
{
    public function course()
    {
    	return $this->belongsTo(Course::class);
    }
}
