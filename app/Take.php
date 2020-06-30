<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Exam;
use App\ExamAnswer;

class Take extends Model
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
     * @return student who attempted
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }


    /**
     * Relationship.
     *
     * @todo do controller function for analysis
     *
     * @return exam attempted
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }


    /**
     * Relationship.
     *
     * @return answers related to this take
     */
    public function answers()
    {
        return $this->hasMany(ExamAnswer::class);
    }
}
