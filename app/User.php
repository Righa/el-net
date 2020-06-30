<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Take;
use App\Course;
use App\Forum;
use App\Vote;
use App\ForumAnswer;
use App\RegisteredCourse;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


    /**
     * Relationship.
     *
     * @todo inner join with course->takes if needed
     *
     * @return all exam attempts
     */
    public function takes()
    {
        return $this->hasMany(Take::class);
    }


    /**
     * Relationship.
     *
     * @return all courses taught by this user
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }


    /**
     * Relationship.
     *
     * @todo make controller function for tracking my forums
     *
     * @return all forums started by this user
     */
    public function forums()
    {
        return $this->hasMany(Forum::class);
    }


    /**
     * Relationship.
     *
     * @todo may be to track answers if needed
     * 
     * @return all answers
     */
    public function forum_answers()
    {
        return $this->hasMany(ForumAnswer::class);
    }


    /**
     * Relationship.
     *
     * @return courses this user is enrolled in
     */
    public function registered_courses()
    {
        return $this->hasMany(RegisteredCourse::class);
    }


    /**
     * Relationship.
     *
     * @return forum votes by this user
     */
    public function forum_votes()
    {
        return $this->hasMany(Vote::class);
    }

}
