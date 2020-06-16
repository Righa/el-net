<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Forum;
use App\Course;

class Subject extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    public function courses()
    {
    	return $this->hasMany(Course::class);
    }
    public function forums()
    {
    	return $this->hasMany(Forum::class);
    }
}
