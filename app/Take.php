<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Exam;

class Take extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'exam_id'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function exam()
    {
    	return $this->belongsTo(Exam::class);
    }
}
