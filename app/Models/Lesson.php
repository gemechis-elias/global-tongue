<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'unit_id',
        'course_id',
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
}
