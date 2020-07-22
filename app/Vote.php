<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ForumAnswer;

class Vote extends Model
{
    /**
     * Relationship.
     *
     * @return answer related to this vote
     */
    public function f_answer()
    {
        return $this->belongsTo(ForumAnswer::class);
    }
}
