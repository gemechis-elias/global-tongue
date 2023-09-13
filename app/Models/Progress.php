<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;
    
      /**
     * Override fillable property data.
     *
     * @var array
     */
    

    protected $fillable = ['course_id', 'lesson_id','completed','date_completed',];

            /**
     * User
     *
     * Get User 
     *
     * @return object
     */
    public function user(): object
 
    {
        return $this->belongsTo(User::class)->select('id', 'name', 'email');
    }

 

    public function course()
    {
        return $this->belongsTo(Course::class, 'id');
    }
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'id');
    }
   

}
