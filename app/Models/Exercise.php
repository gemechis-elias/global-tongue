<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $primaryKey = 'exercise_id';

    

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
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
   

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
    public function user(): object
    {
        return $this->belongsTo(User::class)->select('id', 'name', 'email');
    }
}
