<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
use App\Material;

class Topic extends Model
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
     * @return material under this topic
     */
    public function material()
    {
        return $this->hasMany(Material::class);
    }
}
