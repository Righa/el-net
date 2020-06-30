<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
use App\Topic;

class Material extends Model
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
     * @return parent course
     */
    public function course()
    {
    	return $this->belongsTo(Course::class);
    }


    /**
     * Relationship.
     *
     * @return parent topic
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
