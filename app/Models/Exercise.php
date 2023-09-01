<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

  
    

    protected $fillable = [
        'unit_id',
        'course_id',
        'lesson_id',
        'exercise_type',
        'instruction',
        'question',
        'image',
        'voice',
        'choices',
        'incorrect_hint',
        'correct_answer',
    ];

        /**
     * User
     *
     * Get User Uploaded By Product
     *
     * @return object
     */
    public function user(): object
 
    {
        return $this->belongsTo(User::class)->select('id', 'name', 'email');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'id');
    }
   

    public function course()
    {
        return $this->belongsTo(Course::class, 'id');
    }
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'id');
    }
   
      // Add New Attribute to get image address
      protected $appends = ['image_url'];

        /**
     * Get Added Image Attribute URL.
     *
     * @return string|null
     */
    public function getImageUrlAttribute(): string | null
    {
        if (is_null($this->image) || $this->image === "") {
            return null;
        }

        return url('') . "/images/exercises/" . $this->image;
    }
}
