<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Take;
use App\Course;
use App\Forum;
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
        'name', 'email', 'password',
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

    public function takes()
    {
        return $this->hasMany(Take::class);
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function forums()
    {
        return $this->hasMany(Forum::class);
    }
    public function forum_answers()
    {
        return $this->hasMany(ForumAnswer::class);
    }
    public function registered_courses()
    {
        return $this->hasMany(RegisteredCourse::class);
    }

}
