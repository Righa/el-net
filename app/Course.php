<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Subject;
use App\Material;
use App\Exam;
use App\RegisteredCourse;


class Course extends Model
{
    public function subject()
    {
    	return $this->belongsTo(Subject::class);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function material()
    {
    	return $this->hasMany(Material::class);
    }
    public function exam()
    {
        return $this->hasMany(Exam::class);
    }
    public function registered_course()
    {
        return $this->hasMany(RegisteredCourse::class);
    }
}
