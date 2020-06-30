<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Forum;
use App\Course;

class Subject extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];


    /**
     * Relationship.
     * 
     * @todo incase filter by subject is needed
     *
     * @return courses in this subject
     */
    public function courses()
    {
    	return $this->hasMany(Course::class);
    }


    /**
     * Relationship.
     *
     * @todo incase filter by subject is needed
     *
     * @return forums in this subject
     */
    public function forums()
    {
    	return $this->hasMany(Forum::class);
    }
}
