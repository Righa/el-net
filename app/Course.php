<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Subject;
use App\Material;
use App\Exam;
use App\RegisteredCourse;
use App\Topic;


class Course extends Model
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
     * @return one subject
     */
    public function subject()
    {
    	return $this->belongsTo(Subject::class);
    }


    /**
     * Relationship.
     *
     * @return course teacher
     */
    public function teacher()
    {
    	return $this->belongsTo(User::class);
    }


    /**
     * Relationship.
     *
     * @return notes, media interactives and links
     */
    public function material()
    {
    	return $this->hasMany(Material::class);
    }


    /**
     * Relationship.
     *
     * @return all exams and assignments from this course
     */
    public function activities()
    {
        return $this->hasMany(Exam::class);
    }


    /**
     * Relationship.
     *
     * @return all topics in this course
     */
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }


    /**
     * Relationship.
     *
     * @return all students enrolled in this course
     */
    public function students()
    {
        return $this->hasMany(RegisteredCourse::class);
    }
}
