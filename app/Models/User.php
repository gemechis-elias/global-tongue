<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
 
    protected $fillable = [
        'name',
        'email',
        'password',
        'birthdate',
        'level',
        'subscription_type',
        'my_courses',
        'paid_courses',
        'completed_levels',
        'completed_units',
        'completed_lessons',
        'completed_exercises',
        'completed_tips',
        'completed_conversation',
        'date_registered',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(): string
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    /**
     * Products
     *
     * Get All products uploaded by user
     *
     * @return object Eloquent product object
     */
    public function courses()
    {
        return $this->hasMany(Course::class)->orderBy('id', 'desc');
    }
    public function levels()
    {
        return $this->hasMany(Level::class)->orderBy('id', 'desc');
    }

    public function units()
    {
        return $this->hasMany(Unit::class)->orderBy('id', 'desc');
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('id', 'desc');
    }
    public function exercises()
    {
        return $this->hasMany(Exercise::class)->orderBy('id', 'desc');
    }
    public function tips()
    {
        return $this->hasMany(Tips::class)->orderBy('id', 'desc');
    }
    public function conversation()
    {
        return $this->hasMany(Conversation::class)->orderBy('id', 'desc');
    }
    public function payment()
    {
        return $this->hasMany(Payment::class)->orderBy('id', 'desc');
    }
    public function progress()
    {
        return $this->hasMany(Progress::class)->orderBy('id', 'desc');
    }
    
}
