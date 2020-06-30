<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Take;

class ExamAnswer extends Model
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
     * @return parent take
     */
    public function take()
    {
        return $this->belongsTo(Take::class);
    }
}
