<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
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

        'unit_name', 
        'unit_title', 
        'unit_description', 
        'image'];

        /**
     * Unit
     *
     * Get Unit Uploaded By Product
     *
     * @return object
     */
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
