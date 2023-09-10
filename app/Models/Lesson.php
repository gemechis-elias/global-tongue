<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'course_id',
        'level_id',
        'unit_id',

        'lesson_title',
        'lesson_type',
        'lesson_cover',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'id');
    }
    public function user(): object
    {
        return $this->belongsTo(User::class)->select('id', 'name', 'email');
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class)->select('id', 'exercise_type', 'instruction', 'question', 'image', 'voice', 'choices', 'incorrect_hint', 'correct_answer', 'image_url');
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }

    public function tips()
    {
        return $this->hasMany(Tips::class);
    }
}
