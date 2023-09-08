<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    /**
   * Override fillable property data.
   *
   * @var array
   */


    protected $fillable = [
        'course_id',
        'level_id',
        'unit_id',
        'lesson_id',

        'instruction',
        'conversations',
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
}
