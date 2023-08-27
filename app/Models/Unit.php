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
    protected $fillable = ['unit_name', 'unit_title', 'unit_description', 'unit_image', 'no_of_lessons'];

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
