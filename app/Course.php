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
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject_id', 'teacher_id', 'name', 'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

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
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
    public function registered_courses()
    {
        return $this->hasMany(RegisteredCourse::class);
    }
}
