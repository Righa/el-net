<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;

class Material extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id', 'topic', 'source'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        ''
    ];

    public function course()
    {
    	return $this->belongsTo(Course::class);
    }
}
