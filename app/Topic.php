<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;

class Topic extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        ''
    ];

	public function course()
	{
		belongsTo(Course::class);
	}
}
